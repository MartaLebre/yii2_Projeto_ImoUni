<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cozinha */

$this->title = 'Adicionar sala | ' . Yii::$app->name;?>
<div class="sala-create">
    <div class="row">
        <div class="col-lg-12">
            <h1>Adicionar sala</h1>
            <h4>Por favor preencha os seguintes campos</h4>
            <br>

            <div class="sala-form">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>
