<?php
namespace backend\controllers;

use common\models\AnuncioSearch;
use common\models\Estatistica;
use common\models\Perfil;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(){
        Estatistica::deleteAll();
        $estatisticas = new Estatistica();
        $estatisticas->getEstatisticas();
        $estatisticas->save();
        
        return $this->render('index', ['estatisticas' => $estatisticas]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin(){
        if(!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user = User::find()->where(['username' => $model->username])->one();
            $perfilTipo = Perfil::findOne($user['id'])->getAttribute('tipo');
            
            if($perfilTipo == 3){
                $model->login();
                return $this->goHome();
            }
            else{
                Yii::$app->session->setFlash('danger', 'Login apenas para admins.');
                
                $model->password = '';
                return $this->render('login', ['model' => $model]);
            }
        }
        else{
            $model->password = '';
            return $this->render('login', ['model' => $model]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
