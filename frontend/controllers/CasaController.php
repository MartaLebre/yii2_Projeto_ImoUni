<?php

namespace frontend\controllers;

use common\models\Cozinha;
use common\models\Sala;
use common\models\Quarto;
use Yii;
use common\models\Casa;
use common\models\CasaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CasaController implements the CRUD actions for Casa model.
 */
class CasaController extends Controller
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
     * Lists all Casa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = Yii::$app->user->getId();
        $models = Casa::find()
            ->where(['id_proprietario' => $id])
            ->orderBy('id')
            ->asArray()
            ->all();
    
        return $this->render('index', [
            'models' => $models,
        ]);
    }

    /**
     * Displays a single Casa model.
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
     * Creates a new Casa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $id_user = Yii::$app->user->getId();
        $model = new Casa();
    
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $file = UploadedFile::getInstance($model,'foto');
            if($file){
                $fp = fopen($file->tempName, 'r');
                $imgUploaded = fread($fp, filesize($file->tempName));
                fclose($fp);
            }
            else
                $imgUploaded = null;
            
            $model->addCasa($id_user, $imgUploaded);
    
            return $this->redirect(['/cozinha/create']);
        }
    
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Casa model.
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
     * Deletes an existing Casa model.
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
     * Finds the Casa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Casa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Casa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
