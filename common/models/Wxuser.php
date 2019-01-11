<?php

namespace common\models;

use Yii;
use common\tools\tool;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "wxuser".
 *
 * @property integer $id
 * @property integer $subscribe
 * @property string $openid
 * @property string $nickname
 * @property integer $sex
 * @property string $city
 * @property string $country
 * @property string $province
 * @property string $language
 * @property string $headimgurl
 * @property integer $subscribe_time
 * @property string $unionid
 * @property string $remark
 * @property string $groupid
 * @property string $tagid_list
 * @property string $subscribe_scene
 * @property string $qr_scene
 * @property string $qr_scene_str
 */
class Wxuser extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wxuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['subscribe', 'sex', 'subscribe_time','groupid','qr_scene'], 'integer'],
            [['qr_scene_str'], 'string'],
            [['openid', 'city', 'country', 'province', 'unionid',  'subscribe_scene'], 'string', 'max' => 32],
            [['nickname'], 'string', 'max' => 128],
            [['language', 'remark', 'tagid_list'], 'string', 'max' => 16],
            [['headimgurl'], 'string', 'max' => 255],
            ['openid', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subscribe' => 'Subscribe',
            'openid' => 'Openid',
            'nickname' => 'Nickname',
            'sex' => 'Sex',
            'city' => 'City',
            'country' => 'Country',
            'province' => 'Province',
            'language' => 'Language',
            'headimgurl' => 'Headimgurl',
            'subscribe_time' => 'Subscribe Time',
            'unionid' => 'Unionid',
            'remark' => 'Remark',
            'groupid' => 'Groupid',
            'tagid_list' => 'Tagid List',
            'subscribe_scene' => 'Subscribe Scene',
            'qr_scene' => 'Qr Scene',
            'qr_scene_str' => 'Qr Scene Str',
        ];
    }
    
    public function getUser($openid){
        return $user = $this->findOne(['openid'=>$openid]);
 
    }
    
    public function saveNewUser($openid,$token){

        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
        $_user = tool::http_curl($url);
        $data = json_decode($_user, true);

        $this->openid=$data['openid'];
        $this->nickname=$data['nickname'];
        $this->subscribe=(int)($data['subscribe']);
        $this->sex=$data['sex'];
        $this->city=$data['city'];
        $this->province=$data['province'];
        $this->language=$data['language'];
        $this->country=$data['country'];
        $this->headimgurl=$data['headimgurl'];
        $this->subscribe_time=$data['subscribe_time'];
        $this->save();
        return $this;
    }
    
    public function unsubscribe($postObj){
        $user = $this->findOne(['openid'=>$postObj->FromUserName]);
        $user->subscribe = 0;
        $user->save();
    }
    
    
    public function getWebUser($token,$openid){
        $url ='https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
        $arr =json_decode( tool::http_curl($wx_url),true);
        
        if(isset($arr['errcode'])){
              tool::printVar(1,$arr);
         }
         
         $this->openid=$arr['openid'];
         $this->nickname=$arr['nickname'];

         $this->sex=$arr['sex'];
         $this->city=$arr['city'];
         $this->province=$arr['province'];
         $this->language=$arr['language'];
         $this->country=$arr['country'];
         $this->headimgurl=$arr['headimgurl'];
         $this->subscribe_time=$arr['subscribe_time'];
         $this->privilege=$arr['privilege'];
         $this->save();
         return $arr;
    }
    
    
    public function zhuceGly($id){
        return Yii::$app->user->login(static::findIdentity($id), 600 * 24 * 30 );
//                Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
//        return static::findIdentity($id);
    }
    
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
    
        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }
    
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
    
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
