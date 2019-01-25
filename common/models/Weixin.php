<?php

namespace common\models;

use Yii;
use common\tools\tool;
use common\models\Wxuser;
use yii\base\Security;

/**
 * This is the model class for table "weixin".
 *
 * @property integer $id
 * @property string $appid
 * @property string $appsecret
 * @property string $accessToken
 * @property string $accessToken_expires
 * @property string $token
 * @property string $EncodingAESKey
 */
class Weixin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weixin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appid', 'appsecret', 'accessToken', 'token', 'EncodingAESKey'], 'required'],
            [['accessToken_expires','ticket'], 'safe'],
            [['appid', 'appsecret', 'accessToken'], 'string', 'max' => 255],
            [['token'], 'string', 'max' => 32],
            [['EncodingAESKey'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'appid' => 'Appid',
            'appsecret' => 'Appsecret',
            'accessToken' => 'Access Token',
            'accessToken_expires' => 'Access Token Expires',
            'token' => 'Token',
            'EncodingAESKey' => 'Encoding Aeskey',
        ];
    }
    
    
    /*
     * 设置微信菜单
     */
    public function setMenu()
    {
        $str ='https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s';
        $menu = '{
                    "button": [
                        {
                            "type": "view", 
                            "name": "轻奢品", 
                            "url": "http://zdldc.com/zdl/frontend/web?qsp=1"
                        }, 
                        {
                            "type": "view", 
                            "name": "实惠购", 
                            "url": "http://zdldc.com/zdl/frontend/web"
                        }
                    ]
                }';
        $token = $this->getAccessToken();
        $url = sprintf($str,$token);
        $e = tool::http_curl($url,$menu);
        tool::printVar(0,$e);
    }
    
    /*
     * 回复
     */
    public function response(){
        if(Yii::$app->request->get('echostr')){
            echo Yii::$app->request->get('echostr');
            exit;
        }
		    $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		    libxml_disable_entity_loader ( true );
		    $postObj = simplexml_load_string( $postArr, 'SimpleXMLElement', LIBXML_NOCDATA  );

		    if($postObj->MsgType == 'event'){
		        if(( string )$postObj->Event == 'subscribe'){
		            $this->handl_subscribe($postObj);
		            
		        }
		        if(( string )$postObj->Event == 'unsubscribe'){
		            $this->handl_unsubscribe($postObj);
		            
		        }
		    }
		    
		    
		    if($postObj->MsgType == 'text'){
		        $this->handl_subscribe($postObj);
		    }
	
    }
    
    
    public function handl_unsubscribe($postObj){
        $user = new Wxuser();
        $user->unsubscribe($postObj);
    }
    
    
    public function handl_subscribe($postObj){
//         $fromeuser = $postObj->FromUserName;

        $user = $this->getUserinfo($postObj);
        
        $nickname = $user->nickname;
        $content = "嗨！".$nickname.":\n你好呀！\n 欢迎来到奇妙的世界\n 在这里会有一些奇妙的事情发生\n 请期待哦~~";
//         $content = '欢迎来到奇妙的世界，在这里会有一些奇妙的事情发生，请期待哦';
        $template ='<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>';
        $str = sprintf($template,$user->openid,$postObj->ToUserName,time(),$content);
        echo $str;
    }
    
    public function getUserinfo($postObj){ 
        
        $wxuser = new Wxuser();

        $user = $wxuser->getUser($postObj->FromUserName);

        if($user){
         return $user;
        }else{
            $token = $this->getAccessToken();
            $user = $wxuser->saveNewUser($postObj->FromUserName,$token);
            return $user;            
        }
        
    }
    
    
    
    public function getAccessToken(){
        
        $wx = $this->findOne(['id'=>1]);
        
        if(time()- $wx['accessToken_expires'] > 7200){
            $appid = $wx['appid'];
            $appsecret =  $wx['appsecret'];
            
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
            $res = tool::http_curl($url);
            $arr = json_decode($res, true);
            
            $wx['accessToken'] = $arr['access_token'];
            $wx['accessToken_expires'] = time();
            $wx -> save();
            return $wx['accessToken'];
        }else{
            return $wx['accessToken'];
            
        }

    }
    
    
    public function getJsapiticket(){
        if(time()- $this['accessToken_expires'] > 7200){
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.self::getAccessToken().'&type=jsapi';
            $res = tool::http_curl($url);
            $arr = json_decode($res, true);
            if($arr['errmsg'] == 'ok'){
                $this->ticket = $arr['ticket'];
                $this->save(false);
                return $arr['ticket'];
            }else {
                return $arr['errmsg'];
            }
        }else{
            return $this->ticket;
        }
        
    }
    
    
    
    public function wxSha1(){
        
        $nonce = Yii::$app->getSecurity()->generateRandomString();
        $timestamp = time();
        $token = $this->getAccessToken();
        $ticket = $this->getJsapiticket();
        $url = yii::$app->request->absoluteUrl;
        $string = "jsapi_ticket=".$ticket."&noncestr=".$nonce."&timestamp=".$timestamp."&url=".$url;
        
//         $array = array($encrypt_msg, $token, $timestamp, $nonce);
//         sort($array, SORT_STRING);
//         $str = implode($array);
        return sha1($string);
    }
    
    
    /**
     * oauth2验证第一次握手请求
     *
     * @param $redirect_url 回调地址
     * @param string $state
     *            状态码
     */
    public function webAuthorize($state = "weixin")
    {
        $redriect_url = urlencode(yii::$app->request->absoluteUrl);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."&redirect_uri=".$redriect_url."&response_type=code&scope=snsapi_userinfo&state='.$state.'#wechat_redirect";
        header("location: " . $url, true, 302);
        exit();
    }
    
    
    
    
    /**
     * oauth2验证第二次握手请求
     *
     * @param
     *            $code
     * @return string
     *
     * 微信返回格式
     * {
     "access_token":"ACCESS_TOKEN",
     "expires_in":7200,
     "refresh_token":"REFRESH_TOKEN",
     "openid":"OPENID",
     "scope":"SCOPE"
     }    此函数获取重复的用户《《《《《《《----------------------------------
     */
    public function getWebAccesstoken($code)
    {
        $wx = self::findOne(1);
        if(time()- (int)$wx -> refresh_token_expires > 2591000){
            
            return $this->getWebAccesstokenByCode($code,$wx);
        }
        $arr='';
//         if(time()- (int)$wx -> web_accessToken_expires > 7000){
            $r_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$wx->appid.'&grant_type=refresh_token&refresh_token='.$wx->refresh_token;
            $arr = json_decode(tool::http_curl($r_url),true);
            if(isset($arr['errcode'])){
                return $this->getWebAccesstokenByCode($code,$wx);
            }
            $wx->web_accessToken = $arr['access_token'];
            $wx->refresh_token = $arr['refresh_token'];
            $wx->web_accessToken_expires_in = $arr['expires_in'];
            $wx->web_accessToken_expires = time();
            $wx->save();
            return($arr);
//         }
//         else if(!$arr['access_token'] == $wx->web_accessToken){
//             $r_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$wx->appid.'&grant_type=refresh_token&refresh_token='.$wx->refresh_token;
//             $arr = json_decode(tool::http_curl($r_url),true);
//             $wx->web_accessToken = $arr['access_token'];
//             $wx->refresh_token = $arr['refresh_token'];
//             $wx->web_accessToken_expires_in = $arr['expires_in'];
//             $wx->save();
//             return($arr);
//         }
//         else{
//             return $wx->web_accessToken;
//         }
    }
    
    
    public function getWebAccesstokenByCode($code){
        if(time()-$this->web_accessToken_expires >= $this->web_accessToken_expires_in){
            $arr = $this->refrshWebToken();
            return $arr;
        }
        $wx_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->appid . "&secret=" . $this->appsecret. "&code=" . $code . "&grant_type=authorization_code";
        $arr =json_decode( tool::http_curl($wx_url),true);
//         tool::logit($arr);
        if(!isset($arr['errcode'])){
            $this->web_accessToken = $arr['access_token'];
            $this->refresh_token = $arr['refresh_token'];
            $this->web_accessToken_expires_in = $arr['expires_in'];
            $this->web_accessToken_expires = time();
            $this->save();
            return($arr);
        }else{
            return $arr = $this->refrshWebToken();
        }
    }
    
    
    public function refrshWebToken(){
        $r_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$this->appid.'&grant_type=refresh_token&refresh_token='.$this->refresh_token;
        $arr = json_decode(tool::http_curl($r_url),true);
        if(isset($arr['errcode'])){
            return false;
        }
        $this->web_accessToken = $arr['access_token'];
        $this->refresh_token = $arr['refresh_token'];
        $this->web_accessToken_expires_in = $arr['expires_in'];
        $this->web_accessToken_expires = time();
        $this->save();
        return($arr);
    }
    
    
    
}
