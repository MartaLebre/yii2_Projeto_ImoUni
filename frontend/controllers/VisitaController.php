<?php

namespace frontend\controllers;

use Yii;
use common\models\Visita;
use common\models\VisitaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VisitaController implements the CRUD actions for Visita model.
 */
class VisitaController extends Controller
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
     * Lists all Visita models.
     * @return mixed
     */
    public function actionIndex($id_anuncio){
        $modelVisitas = Visita::find()->where(['id_anuncio' => $id_anuncio])->asArray()->all();
        
        return $this->render('index', ['modelVisitas' => $modelVisitas]);
    }

    /**
     * Displays a single Visita model.
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
     * Creates a new Visita model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_anuncio)
    {
        $model = new Visita();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    
            $model->addVisita(Yii::$app->user->getId(), $id_anuncio);
            
            Yii::$app->session->setFlash('success', 'Visita marcada com sucesso.');
            return $this->redirect(['/anuncio/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Visita model.
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
     * Deletes an existing Visita model.
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
     * Finds the Visita model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Visita the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visita::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
