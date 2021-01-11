<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */

$this->title = 'Marcar reserva |' . Yii::$app->name;?>
<div class="reserva-create">
    <div class="row">
        <div class="col-lg-12">
            <h1>Marcar reserva</h1>
            <h4>Por favor preencha os seguintes campos</h4>
            <br>

            <div class="reserva-form">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->render('_form', ['model' => $model]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
