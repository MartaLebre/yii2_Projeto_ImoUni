<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Visita */

$this->title = 'Marcar visita |' . Yii::$app->name;?>
<div class="visita-create">
    <div class="row">
        <div class="col-lg-12">
            <h1>Marcar visita</h1>
            <h4>Por favor preencha os seguintes campos</h4>
            <br>

            <div class="visita-form">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->render('_form', ['model' => $model]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
