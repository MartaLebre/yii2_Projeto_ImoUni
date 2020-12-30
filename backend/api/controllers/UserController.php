<?php

namespace backend\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\User;
use common\models\Perfil;


class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $modelClassPerfil = 'common\models\Perfil';

    public function actionInfo($id){
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

    /*public function actionTotal(){
        $usermodel = new $this->modelClass;
        $id = $usermodel::find()->all;

        return ['total' => count($id)];
    }*/
}