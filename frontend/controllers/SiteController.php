<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Weixin;
use common\models\Wxuser;
use common\models\User;
use common\tools\tool;
use yii\helpers\Url;
use common\models\TemaiHui;
use frontend\models\UserOrder;
use common\models\Goods;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = FALSE;
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','editgood'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'zdl';
        $wx = Weixin::findOne(1);
        $arr = '';
        $req = yii::$app->request;
        if($req->get('code')){
            
            $session = yii::$app->session;
            if(!$session->has('temp_user')){
                
                $arr = $wx->getWebAccesstokenByCode(yii::$app->request->get('code'));
                if(!$arr){
                    return $this->renderContent('getWebAccesstokenByCode 稍等一下，<a class="btn btn-info" href="'.Url::to(['site/index']).'">点击此处再试试~~</a>');
                }
                $user = Wxuser::findOne(['openid'=> $arr['openid']])->toArray();
                if(!$user){
                    $user = $user->getWebUser($arr['access_token'],$arr['openid']);
                    if(!$user){
                        return $this->renderContent('getWebUser 稍等一下，刷新试试~~');
                    }
                }
                
                $session->set('temp_user', $user);
            
            }else{
                $user = $session->get('temp_user');
            }
            
            $gly  = '';
            $gly1 = Wxuser::findOne(['openid' => 'osFMi1diNjHcfIOB3f9VOxaGoADM']);
            $gly2 = Wxuser::findOne(['openid' => 'osFMi1ZOfIQqjJPQj6cGEFe6QKvY']);
            if($req->get('qsp')){
                $tmh=TemaiHui::getQsp();
            }elseif($req->get('tmhid')){
                $tmh = TemaiHui::find()->where(['id'=>$req->get('tmhid')])->with('goods.good')->all();
            }else{
                $tmh=TemaiHui::getShg();
            }
            
//             $tmh = TemaiHui::findOne()->where(['id'=>14])->with('goods.good')->all();
//             tool::printVar(1,$tmh);
            if(($gly1['openid'] == $user['openid']) || ($gly2['openid'] == $user['openid'])){
                User::zhuceGly(2);
                return $this->render('index',['user' => $user,'gly' => $user,'tmh'=>$tmh]);
            }else{
                return $this->render('index',['user' => $user,'gly' => $gly2,'tmh'=>$tmh]);
            }

        }else{
            $wx->webAuthorize();
            
        }
    }
    
    
    
   public function actionEditgood($id=''){
       if(yii::$app->request->get('queren') == 1){
           $goods = Goods::findOne(yii::$app->request->get('id'));
           $goods->delete();
           $this->goBack();
       }else{
          return $this->render('editgood'); 
       }
       
   }

    
    
    
    /**
     * 接受来自AJAX post.
     *
     * @return mixed
     */
    public function actionAjaxpost()
    {
        
        $model = new UserOrder();
        
        
        $request = Yii::$app->request;
        $model->load($request->post());
        if ( $model->validate() && $model->save() ) {
            echo 'every thing OK';
        }else {
            echo 'error';
        }
    }
    
    
    
    
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        
        echo yii::getAlias('@backendweb');
        exit();
        
        $tmh = TemaiHui::find()->where(['id'=>13])->with('goods.good')->all();
//         $tmh1 = new UserOrder();
        
//         foreach ($tmh as $arr){
//             tool::printVar(false,$arr);
//         }
//         tool::printVar(1,$tmh1->attributes());
        return $this->render('about',['tmh'=>$tmh]);
    }
    
    
    
    
    
    
    
    /**
     * 微信jssdk 验证tocken.
     *
     * @return mixed
     */
    public function actionJssdk()
    {
        
        $wx = new Weixin();
        echo $wx->wxSha1();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
