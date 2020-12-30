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

    public function actionAnunciobyTitulo($titulo)
    {
        $anunciomodel = Anuncio::find()->where(['like', 'titulo', $titulo])->limit(12)->orderBy(['id' => SORT_DESC])->asArray()->all();
        return ['anuncio' => $anunciomodel];
    }

}
