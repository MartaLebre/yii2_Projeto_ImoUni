<?php

namespace backend\controllers;

use common\models\Anuncio;
use common\models\Perfil;
use common\models\User;
use Yii;
use common\models\Mensagem;
use common\models\MensagemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MensagemController implements the CRUD actions for Mensagem model.
 */
class MensagemController extends Controller
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
     * Lists all Mensagem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MensagemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mensagem model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        $mensagemNova = new Mensagem();
        $model = Mensagem::findOne($id);
        $mensagens = Mensagem::find()
            ->where(['id_remetente' => $model['id_remetente']] AND ['id_destinatario' => $model['id_destinatario']])
            ->orWhere(['id_destinatario' => $model['id_remetente']] AND ['id_remetente' => $model['id_destinatario']])
            ->andWhere(['categoria' => $model['categoria']])
            ->all();
        
        $remetente = User::findOne($model['id_remetente']);
        $destinatario = User::findOne($model['id_destinatario']);
        
        foreach($mensagens as $mensagem){
            if($mensagem['id_destinatario'] == Yii::$app->user->getId()){
                $mensagem->setAttribute('vista', 1);
                $mensagem->update();
            }
        }
        
        if($mensagemNova->load(Yii::$app->request->post()) && $mensagemNova->sendMsg($destinatario['id'], $model['categoria']))
            return $this->redirect(['view', 'id' => $model['id']]);
        
        return $this->render('view', [
            'categoria' => $model['categoria'],
            'mensagemNova' => $mensagemNova,
            'mensagens' => $mensagens,
            'remetente' => $remetente,
            'destinatario' => $destinatario,
        ]);
    }

    /**
     * Creates a new Mensagem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_anuncio){
        $model = new Mensagem();
        $modelAnuncio = Anuncio::findOne($id_anuncio);
        $modelUser = User::findOne($modelAnuncio->getAttribute('id_proprietario'));

        if ($model->load(Yii::$app->request->post()) && $model->createMsg($modelAnuncio)) {
            Yii::$app->session->setFlash('success', 'Mensagem enviada com sucesso.');
            return $this->redirect(['/anuncio/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'modelAnuncio' => $modelAnuncio,
            'modelUser' => $modelUser,
        ]);
    }

    /**
     * Updates an existing Mensagem model.
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
     * Deletes an existing Mensagem model.
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
     * Finds the Mensagem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mensagem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mensagem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
