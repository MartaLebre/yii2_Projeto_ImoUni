<?php

namespace frontend\controllers;

use common\models\Casa;
use common\models\Cozinha;
use Yii;
use common\models\Quarto;
use common\models\QuartoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * QuartoController implements the CRUD actions for Quarto model.
 */
class QuartoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Quarto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuartoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Quarto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Quarto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Quarto();
        $session = Yii::$app->session;
        $id_casa = $session->get('id_casa');
        $modelCasa = Casa::findOne($id_casa);
    
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $file = UploadedFile::getInstance($model,'foto');
            if($file){
                $fp = fopen($file->tempName, 'r');
                $imgUploaded = fread($fp, filesize($file->tempName));
                fclose($fp);
            }
            else
                $imgUploaded = null;
            
            $model->addQuarto($id_casa, $imgUploaded);
            
            if($modelCasa->num_quartos <= Quarto::find()->where(['id_casa' => $id_casa])->count())
                return $this->redirect(['/anuncio/create']);
            else{
                $model = new Quarto();
    
                return $this->redirect(['create', ['model' => $model]]);
            }
        }
    
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Quarto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Quarto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Quarto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quarto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quarto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
