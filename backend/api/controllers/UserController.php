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


    public function actionRegisto()
    {
        $user = new User();
        $userProfile = new Perfil();

        $user->username = \Yii::$app->request->post('username');;
        $user->email = \Yii::$app->request->post('email');;
        $user->setPassword(\Yii::$app->request->post('password'));
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $userProfile->primeiro_nome = \Yii::$app->request->post('primeiro_nome');
        $userProfile->ultimo_nome = \Yii::$app->request->post('ultimo_nome');
        $userProfile->numero_telemovel = \Yii::$app->request->post('numero_telemovel');
        $userProfile->genero = \Yii::$app->request->post('genero');
        $userProfile->data_nascimento = \Yii::$app->request->post('data_nascimento');
        $userProfile->tipo = \Yii::$app->request->post('tipo');

        $user->save(false);
        $userProfile->id_user = $user->getId();

        $userProfile->save(false);

        if ($user->save() == true && $userProfile->save() == true) {
            return true;
        } else {
            return false;
        }


    }
}