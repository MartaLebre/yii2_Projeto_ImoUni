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
            <h1>Horários</h1>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php foreach($models as $model){ ?>
                        <div class="row">
                            <div class="card">
                                <div class="card-content col-sm-6">
                                    <div class="card-body">
                                        <p class="card-text">Dia da semana: <?=  $model['dia_semana'] ?></p>
                                        <p class="card-text">Horário:
                                            <?= Yii::$app->formatter->asTime($model['hora_comeco'], 'H:mm') ?> às
                                            <?= Yii::$app->formatter->asTime($model['hora_fim'], 'H:mm') ?></p>
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
                    <div style="text-align: center">
                        <?= Html::a('Adicionar horário', ['/horario/create'], ['class'=>'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>