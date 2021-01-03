<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Adicionar horários | ImoUni';
?>
<div class="horario-create">
    <div class="row">
        <div class="col-lg-5">
            <h1>Adicionar horário</h1>
            <br>
            <div class="horario-form">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->render('_form', ['model' => $model]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
