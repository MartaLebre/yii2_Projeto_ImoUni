<?php

namespace frontend\controllers;

use common\models\Casa;
use common\models\Cozinha;
use common\models\Quarto;
use common\models\Sala;
use Yii;
use common\models\Anuncio;
use common\models\Reserva;
use common\models\Visita;
use common\models\AnuncioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnuncioController implements the CRUD actions for Anuncio model.
 */
class AnuncioController extends Controller
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
     * Lists all Anuncio models.
     * @return mixed
     */
    public function actionIndex(){
        $searchModel = new AnuncioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Anuncio model.
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
     * Creates a new Anuncio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $id_casa = $session->get('id_casa');
        $id_user = Yii::$app->user->getId();
        $model = new Anuncio();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->addAnuncio($id_user, $id_casa);
            
            if($session->has('id_casa'))
                $session->remove('id_casa');
    
            Yii::$app->session->setFlash('success', 'Anúncio registado com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Anuncio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Anuncio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $id_casa = Anuncio::find()
            ->where(['id' => $id])
            ->one()
            ->getAttribute('id_casa');
        
        $modelVisitas = Visita::find()
            ->where(['id_anuncio' => $id])
            ->all();
        
        $modelReservas = Reserva::find()
            ->where(['id_anuncio' => $id])
            ->all();
        
        $modelQuartos = Quarto::find()
            ->where(['id_casa' => $id_casa])
            ->all();
    
        foreach($modelVisitas as $modelVisita)
            $modelVisita->delete();
    
        foreach($modelReservas as $modelReserva)
            $modelReserva->delete();
        
        Anuncio::find()
            ->where(['id' => $id])
            ->one()
            ->delete();
        
        foreach($modelQuartos as $modelQuarto)
            $modelQuarto->delete();
    
        Sala::find()
            ->where(['id_casa' => $id_casa])
            ->one()
            ->delete();
    
        Cozinha::find()
            ->where(['id_casa' => $id_casa])
            ->one()
            ->delete();
    
        Casa::find()
            ->where(['id' => $id_casa])
            ->one()
            ->delete();
    
        Yii::$app->session->setFlash('success', 'Anúncio eliminado com sucesso.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Anuncio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anuncio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(($model = Anuncio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
