<?php

namespace backend\controllers;

use common\models\AnuncioSearch;
use common\models\Casa;
use common\models\Cozinha;
use common\models\Mensagem;
use common\models\Perfil;
use common\models\Quarto;
use common\models\Sala;
use common\models\User;
use common\models\Visita;
use Yii;
use common\models\Anuncio;
use yii\data\ActiveDataProvider;
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
    public function actionIndex()
    {
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
    public function actionView($id){
        $model = $this->findModel($id);
        $modelUser = User::findOne($model['id_proprietario']);
        $modelPerfil = Perfil::findOne($modelUser['id']);
        $modelCasa = Casa::findOne($model['id_casa']);
        $modelCozinha = Cozinha::find()->where(['id_casa' => $modelCasa['id']])->one();
        $modelSala = Sala::find()->where(['id_casa' => $modelCasa['id']])->one();
        $modelQuartos = Quarto::find()->where(['id_casa' => $modelCasa['id']])->asArray()->all();
        $current_perfil = Perfil::findOne(Yii::$app->user->getId());
        $modelVisitas = Visita::find()->where(['id_anuncio' => $model['id']])->asArray()->all();
        $modelMensagens = Mensagem::find()->where(['id_remetente' => Yii::$app->user->getId()])->asArray()->all();
    
        return $this->render('view', [
            'model' => $model,
            'modelUser' => $modelUser,
            'modelPerfil' => $modelPerfil,
            'modelCasa' => $modelCasa,
            'modelCozinha' => $modelCozinha,
            'modelSala' => $modelSala,
            'modelQuartos' => $modelQuartos,
            'current_perfil' => $current_perfil,
            'modelVisitas' => $modelVisitas,
            'modelMensagens' => $modelMensagens,
        ]);
    }

    /**
     * Creates a new Anuncio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anuncio();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
        if (($model = Anuncio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
