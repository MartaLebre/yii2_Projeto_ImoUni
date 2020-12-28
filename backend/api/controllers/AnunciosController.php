<?php

namespace backend\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\Anuncio;
use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

/**
 * AnuncioController implements the CRUD actions for Anuncio model.
 */
class AnunciosController extends ActiveController
{
    public $modelClass = 'common\models\Anuncio';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['index', 'view', 'productsbyname'],
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

    public function checkAccess($action, $model = null, $params = [])
    {
        // check if the user can access $action and $model
        // throw ForbiddenHttpException if access should be denied
        if ($action === 'create' || $action === 'update' || $action === 'delete') {
            if(\Yii::$app->user->isGuest)
                throw new \yii\web\ForbiddenHttpException('Your request was made with invalid credentials.');
        }
    }

    public function actionAnunciobyTitulo($titulo)
    {
        $anunciomodel = Anuncio::find()->where(['like', 'titulo', $titulo])->limit(12)->orderBy(['id' => SORT_DESC])->asArray()->all();
        return ['anuncio' => $anunciomodel];
    }

}
