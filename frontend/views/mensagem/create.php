<?php

use common\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */
/* @var $modelAnuncio common\models\Anuncio */
/* @var $modelUser common\models\User */

$this->title = 'Mensagem | ' . Yii::$app->name;
?>
<div class="mensagem-create">
    <div class="row">
        <div class="col-sm-6">
            <h1><?= $modelAnuncio['titulo'] ?></h1>
            <h4><span style="font-weight: bold">Username: </span><?= $modelUser['username'] ?></h4>
            <h4><span style="font-weight: bold">E-mail: </span><?= $modelUser['email'] ?></h4>
            <hr>
            <br>
            
            <div class="mensagem-form">
                <h4>Mensagem:</h4>
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>
