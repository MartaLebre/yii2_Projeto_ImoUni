<?php

namespace frontend\controllers;

use common\models\Anuncio;
use common\models\Horario;
use DateTime;
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
    public function actionCreate($id_anuncio){
        $model = new Visita();
        $modelAnuncio = Anuncio::findOne($id_anuncio);
        $modelHorarios = Horario::find()->where(['id_perfil' => $modelAnuncio['id_proprietario']])->asArray()->all();
        $current_date = new DateTime();
        $hora_validate = false;
        $data_validate = false;

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $hora_visita = new DateTime($model->hora_visita);
            $data_visita = new DateTime($model->data_visita);
            
            foreach($modelHorarios as $modelHorario){
                $hora_comeco = new DateTime($modelHorario['hora_comeco']);
                $hora_fim = new DateTime($modelHorario['hora_fim']);
                $dia_semana = $modelHorario['dia_semana'];
                
                if(($hora_visita >= $hora_comeco) && ($hora_visita <= $hora_fim))
                    $hora_validate = true;
                
                switch($data_visita->format('l')){
                    case 'Monday':
                        if($dia_semana == 'segunda')
                            $data_validate = true;
                        break;
                    case 'Tuesday':
                        if($dia_semana == 'terca')
                            $data_validate = true;
                        break;
                    case 'Wednesday':
                        if($dia_semana == 'quarta')
                            $data_validate = true;
                        break;
                    case 'Thursday':
                        if($dia_semana == 'quinta')
                            $data_validate = true;
                        break;
                    case 'Friday':
                        if($dia_semana == 'sexta')
                            $data_validate = true;
                        break;
                }
    
                if($data_visita->diff($current_date)->invert == 0)
                    $data_validate = false;
                    
            }
            
            if($hora_validate && $data_validate){
                $model->addVisita(Yii::$app->user->getId(), $id_anuncio);
    
                Yii::$app->session->setFlash('success', 'Visita marcada com sucesso.');
                return $this->redirect(['/anuncio/index']);
            }
            else{
                Yii::$app->session->setFlash('danger', 'O Horário pretendido não está disponível.');
                
                $model = new Visita();
                return $this->render('create', [
                    'model' => $model,
                    'modelHorarios' => $modelHorarios,
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelHorarios' => $modelHorarios,
        ]);
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
