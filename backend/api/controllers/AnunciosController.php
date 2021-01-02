<?php

namespace backend\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\Anuncio;


/**
 * AnuncioController implements the CRUD actions for Anuncio model.
 */
class AnunciosController extends ActiveController
{
    public $modelClass = 'common\models\Anuncio';

    public function actionAlterar($id)
    {
        $titulo=\Yii::$app->request->post('titulo');
        $preco=\Yii::$app->request->post('preco');
        $data_disponibilidade=\Yii::$app->request->post('data_disponibilidade');
        $despesas_inc=\Yii::$app->request->post('despesas_inc');
        $descricao=\Yii::$app->request->post('descricao');

        $anunciomodel = new $this->modelClass;

        $rec = $anunciomodel::find()->where("id=".$id)->one();

        if($rec){
            $rec->titulo=$titulo;
            $rec->preco=$preco;
            $rec->data_disponibilidade=$data_disponibilidade;
            $rec->despesas_inc=$despesas_inc;
            $rec->descricao=$descricao;

            $rec->save();

            return['SaveError'=> $rec];
        }
        throw new \yii\web\NotFoundHttpException("Id de anúncio não encontrado");
    }

    public function actionApagar($id){
        $anunciomodel = new $this->modelClass;

        $rec = $anunciomodel->deleteAll("id=".$id);

        if($rec)
            return ['DelError' => $rec];

        throw new \yii\web\NotFoundHttpException("Id de anúncio não encontrado");
    }

    public function actionAdicionar(){

        $id_proprietario=\Yii::$app->request->post('id_proprietario');
        $id_casa=\Yii::$app->request->post('id_casa');
        $titulo=\Yii::$app->request->post('titulo');
        $preco=\Yii::$app->request->post('preco');
        $data_criacao=\Yii::$app->request->post('data_criacao');
        $data_disponibilidade=\Yii::$app->request->post('data_disponibilidade');
        $despesas_inc=\Yii::$app->request->post('despesas_inc');
        $descricao=\Yii::$app->request->post('descricao');

        $anunciomodel = new $this->modelClass;

        $anunciomodel->id_proprietario=$id_proprietario;
        $anunciomodel->id_casa=$id_casa;
        $anunciomodel->titulo=$titulo;
        $anunciomodel->preco=$preco;
        $anunciomodel->data_criacao=$data_criacao;
        $anunciomodel->data_disponibilidade=$data_disponibilidade;
        $anunciomodel->despesas_inc=$despesas_inc;
        $anunciomodel->descricao=$descricao;

        $rec = $anunciomodel->save();
        return ['SaveError' => $rec];
    }
}
