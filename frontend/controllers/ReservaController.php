<?php

namespace frontend\controllers;

use Cassandra\Date;
use common\models\Anuncio;
use common\models\Casa;
use common\models\Quarto;
use DateTime;
use Yii;
use common\models\Reserva;
use common\models\ReservaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReservaController implements the CRUD actions for Reserva model.
 */
class ReservaController extends Controller
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
     * Lists all Reserva models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReservaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reserva model.
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
     * Creates a new Reserva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_quarto){
        $model = new Reserva();
        $modelQuarto = Quarto::findOne($id_quarto);
        $modelAnuncio = Anuncio::find()->where(['id_casa' => $modelQuarto['id_casa']])->one();
        $data_disponibilidade = new DateTime($modelAnuncio['data_disponibilidade']);
        
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data_entrada = new DateTime($model['data_entrada']);
            
            if($data_entrada->diff($data_disponibilidade)->invert == 1){
                $model->addReserva(Yii::$app->user->getId(), $id_quarto);
                Yii::$app->session->setFlash('success', 'Reserva marcada com sucesso.');
                
                return $this->redirect(['/anuncio/index']);
            }
            else{
                Yii::$app->session->setFlash('danger', 'Reserva não efetuada, disponivel a partir de ' . $data_disponibilidade->format('Y-m-d') . '.');
                
                return $this->render('create', [
                    'model' => $model,
                    'data_disponibilidade' => $data_disponibilidade->format('Y-m-d'),
                ]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'data_disponibilidade' => $data_disponibilidade->format('Y-m-d'),
        ]);
    }

    /**
     * Updates an existing Reserva model.
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
     * Deletes an existing Reserva model.
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
     * Finds the Reserva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reserva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reserva::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
