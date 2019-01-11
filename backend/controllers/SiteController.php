<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use common\models\Weixin;
use common\tools\tool;
use yii\base\Application;
use yii\base\Security;
/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'index','weixin','wxmenu','test'],
                        'allow' => true,
//                         'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//         User::zhuceGly(2);
        return $this->render('index');
    }
    
    public function actionWeixin()
    {
        $model = new Weixin();
        $model->response();
        
        
    }
    
    /**
     * 设置微信菜单
     *
     * @return string
     */
    public function actionWxmenu()
    {
        $model = new Weixin();
        $model->setMenu();
    
    }
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTest()
    {
//         $authKey = Yii::$app->security->generateRandomString();
//         tool::printVar(1,$identity = Yii::$app->user->getisGuest());
        $info = '';
        if(Yii::$app->user->getisGuest()){
            User::zhuceGly(2);
            $info = '新登录进来';
            
        }
        else{
            $info = '老用户，直接进';
        }
        
        
        return $this->renderContent($info);
    }
    
    

    /**
     * Login action.
     *
     * @return string
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
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
