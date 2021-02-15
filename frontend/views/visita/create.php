<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Visita */
/* @var $modelHorarios common\models\Horario */

$this->title = 'Marcar visita |' . Yii::$app->name;?>
<div class="visita-create">
    <div class="visita-form">
        <div class="row">
            <div class="col-lg-6">
                <h1>Marcar visita</h1>
                <h4>Por favor preencha os seguintes campos</h4>
                <br>
                
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>

            <div class="col-lg-4 col-lg-offset-1">
                <h1>Horários disponíveis</h1>
                <br>
                
                <div class="row">
                    <div class="col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php
                                $numHorario = 0;
                                foreach($modelHorarios as $modelHorario){
                                    $numHorario += 1;
                                    if($numHorario > 1){?>
                                        <hr>
                                    <?php }?>
                                    <div class="text-center">
                                        <h4 style="font-weight: bold">
                                            Dia da semana: <span style="text-transform: capitalize; font-weight: normal"><?=  $modelHorario['dia_semana'] ?>
                                        </h4>
                                        <h4 style="font-weight: bold">
                                            Horário: <span style="font-weight: normal">
                                                <?= Yii::$app->formatter->asTime($modelHorario['hora_comeco'], 'H:mm') ?> às
                                                <?= Yii::$app->formatter->asTime($modelHorario['hora_fim'], 'H:mm') ?>
                                        </h4>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
