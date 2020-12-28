<?php

namespace backend\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\User;
use common\models\Perfil;
use frontend\models\SignupForm;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;


class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['create'],
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        $user = User::findByUsername($username);
                        if ($user && $user->validatePassword($password)) {
                            return $user;
                        }
                    }
                ],
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['view']);
        unset($actions['update']);
        return $actions;
    }

    public function actionLogin()
    {
        $userData = User::find()->where(['id' => Yii::$app->user->getId()])->select([
            "id",
            "username",
            "auth_key",
            "email"
        ])->asArray()->one();
        $profile = Perfil::find()->where(['id_user' => Yii::$app->user->getId()])->select([
            "tipo",
            "data_nascimento",
            "numero_telemovel",
            "primeiro_nome",
            "ultimo_nome",
            "genero",
        ])->asArray()->one();

        return array_merge($userData, $profile);
    }


    public function actionView($id)
    {
        $user = User::find()->where(['id' => $id])->select([
            "id",
            "username",
            "auth_key",
            "email"
        ])->asArray()->one();
        $profile = Perfil::find()->where(['id_user' => $id])->select([
            "tipo",
            "data_nascimento",
            "numero_telemovel",
            "primeiro_nome",
            "ultimo_nome",
            "genero",
        ])->asArray()->one();

        return array_merge($user, $profile);
    }

    public function actionCreate()
    {
        $model = new SignupForm();
        $params = Yii::$app->request->post();
        $model->username = $params['username'];
        $model->email = $params['email'];
        $model->password = $params['password'];

        $model->tipo = $params['tipo'];
        $model->data_nascimento = $params['data_nascimento'];
        $model->numero_telemovel = $params['numero_telemovel'];
        $model->primeiro_nome = $params['primeiro_nome'];
        $model->ultimo_nome = $params['ultimo_nome'];
        $model->genero = $params['genero'];

        if ($model->signup()) {
            $response['isSuccess'] = 201;
            $response['message'] = 'Utilizador registado com sucesso!';
            return $response;
        } else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
            return $response;
        }

    }


    public function actionUpdate($id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException("The user was not found.");
        }

        $profile = Perfil::findOne($user->id);
        if (!$profile) {
            throw new \yii\web\NotFoundHttpException("The user has no profile.");
        }

        $username = \Yii::$app->request->post('username');
        $email = \Yii::$app->request->post('email');
        $tipo = \Yii::$app->request->post('tipo');
        $data_nascimento = \Yii::$app->request->post('data_nascimento');
        $numero_telemovel = \Yii::$app->request->post('numero_telemovel');
        $primeiro_nome = \Yii::$app->request->post('primeiro_nome');
        $ultimo_nome = \Yii::$app->request->post('ultimo_nome');
        $genero = \Yii::$app->request->post('genero');

        $user->username = $username;
        $user->email = $email;
        $profile->tipo = $tipo;
        $profile->data_nascimento = $data_nascimento;
        $profile->numero_telemovel = $numero_telemovel;
        $profile->primeiro_nome = $primeiro_nome;
        $profile->ultimo_nome = $ultimo_nome;
        $profile->genero = $genero;

        if ($user->validate() && $profile->validate()) {
            $profile->save();
            $user->save();

            $user = User::find()->where(['id' => $id])->select([
                "id",
                "username",
                "auth_key",
                "email"
            ])->asArray()->one();
            $profile = Perfil::find()->where(['id_user' => $id])->select([
                "tipo",
                "data_nascimento",
                "numero_telemovel",
                "primeiro_nome",
                "ultimo_nome",
                "genero",
            ])->asArray()->one();

            return array_merge($user, $profile);
        } else {
            throw new \yii\web\BadRequestHttpException("The request could not be understood by the server due to malformed syntax.");
        }
    }
}