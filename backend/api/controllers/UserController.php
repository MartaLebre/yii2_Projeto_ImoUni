<?php

namespace backend\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\User;
use common\models\Perfil;
use common\models\Visita;
use common\models\Reserva;


class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $modelClassPerfil = 'common\models\Perfil';

    public function actionDetalhes($id){
        $user = User::findOne(['id' => $id]);
        $perfil = Perfil::findOne(['id_user' => $id]);

        if($user != null && $perfil != null){

            return ['Utilizador' => [
                'ID_User' => $perfil->id_user,
                'Username' => $user->username,
                'Email' => $user->email,
                'Primeiro Nome' => $perfil->primeiro_nome,
                'Ultimo Nome' => $perfil->ultimo_nome,
                'Data_Nascimento' => $perfil->data_nascimento,
                'Genero' => $perfil->genero,
                'Numero_Telemovel' => $perfil->numero_telemovel,
            ]];
        } else {
            throw new \yii\web\NotFoundHttpException("O utilizador não foi encontrado");
        }
    }

    public function actionTotal(){
        $usermodel = new $this->modelClass;
        $soma = $usermodel::find()->all();

        return ['total_users' => count($soma)];
    }

    public function actionEmail($id){
        $usermodel = new $this->modelClass;
        $rec = $usermodel::find()->where("id=".$id)->one();

        if($rec)
            return ['id' => $id, 'Email' => $rec->email];

        return ['id' => $id, 'Email' => "null"];
    }

    public function actionVisita($id){

        $visita = Visita::findOne(['id' => $id]);

        return $visita;
    }

    public function actionReserva($id){

        $reserva = Reserva::findOne(['id' => $id]);

        return $reserva;
    }
}