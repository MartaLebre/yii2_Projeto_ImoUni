<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Horários | ImoUni';
?>
<div class="horario-update">
    
    <div class="row">
        <div class="col-lg-5">
            <h1>Horários</h1>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="horario-search">
                        <?php echo $this->render('/horario/_search', ['models' => $models]);?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5" style="padding-left: 50px">
            <h1>Adicionar horário</h1>
            <br>
            <div class="horario-form">
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo $this->render('/horario/_form', ['model' => $new_model]);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>