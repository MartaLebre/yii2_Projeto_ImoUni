<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

\yii\web\YiiAsset::register($this);
$this->title = 'Horários | ImoUni';
?>
<div class="horario-index">
    <div class="row">
        <div class="col-lg-5">
            <h1>Horários das visitas</h1>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php foreach($models as $model){ ?>
                        <div class="row">
                            <div class="card">
                                <div class="card-content col-sm-6">
                                    <div class="card-body">
                                        <h4 class="card-text" style="font-weight: bold">
                                            Dia da semana: <span style="text-transform: capitalize; font-weight: normal"><?=  $model['dia_semana'] ?>
                                        </h4>
                                        <h4 class="card-text" style="font-weight: bold">
                                            Horário: <span style="font-weight: normal">
                                                <?= Yii::$app->formatter->asTime($model['hora_comeco'], 'H:mm') ?> às
                                                <?= Yii::$app->formatter->asTime($model['hora_fim'], 'H:mm') ?>
                                        </h4>
                                    </div>
                                </div>
                                <div style="text-align: center; padding-top: 10px">
                                    <?= Html::a('Eliminar horário', ['delete', 'id' => $model['id']], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Tem a certeza que deseja eliminar este horário?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <div style="text-align: center; padding-bottom: 10px">
                        <?= Html::a('Adicionar horário', ['/horario/create'], ['class'=>'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>