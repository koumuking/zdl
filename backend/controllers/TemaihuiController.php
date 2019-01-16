<?php

namespace backend\controllers;

use Yii;
use common\models\TemaiHui;
use app\models\searchTemaiHui;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Good;
use common\models\Goods;
use backend\models\FileUpForm;
use yii\web\UploadedFile;
use common\tools\tool;
use yii\helpers\BaseVarDumper;
use backend;
use yii\helpers\Html;
use yii\helpers\VarDumper;


/**
 * TemaihuiController implements the CRUD actions for TemaiHui model.
 */
class TemaihuiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                 'only'=>[],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout','index','create','update','delete','view','create-new-good','test'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TemaiHui models.
     * @return mixed
     */
    public function actionIndex()
    {
//         $searchModel = new searchTemaiHui();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//         return $this->render('index', [
//             'searchModel' => $searchModel,
//             'dataProvider' => $dataProvider,
//         ]);
        return  $this->render('index');
    }

    /**
     * Displays a single TemaiHui model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TemaiHui model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TemaiHui();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['create-new-good', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    
    
    
    /**
     * Creates a new goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateNewGood($id='')
    {
//         echo BaseVarDumper::dumpAsString(yii::$container->has('yii\web\Controller'));
//         exit();
        if(!Yii::$app->request->get('id')){
            $this->goBack();
        }
         $model = new FileUpForm();

        if (Yii::$app->request->isPost&&$model->load(Yii::$app->request->post())) {
            
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                $model->updeated = 'ok';
            }
        }

        return $this->render('fileup', ['model' => $model]);
    }
    
    
    /**
     * Test.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTest($id='')
    {
        
         $model = new FileUpForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                $model->updeated = 'ok';
            }
        }

        return $this->render('fileup', ['model' => $model]);
    }
    
    
    /**
     * Updates an existing TemaiHui model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TemaiHui model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TemaiHui model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TemaiHui the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TemaiHui::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
