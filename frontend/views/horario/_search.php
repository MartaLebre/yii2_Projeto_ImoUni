<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $_model common\models\Horario */
/* @var $models common\models\Horario */
?>

<div class="horario-search">
    <?php foreach($models as $model){ ?>
        <div class="row">
            <div class="card">
                <div class="card-content col-sm-6">
                    <div class="card-body">
                        <a href="<?=Url::to(['/horario/view', 'id' => $model['id']]); ?>">
                            <p class="card-text">Dia da semana: <?= $model['dia_semana'] ?></p>
                            <p class="card-text">Horário: <?= $model['hora_comeco']?> às <?= $model['hora_fim']?></p>
                        </a>
                    </div>
                </div>
                <div style="text-align: center; padding-top: 10px">
                    <?= Html::a('Eliminar', ['delete', 'id' => $model['id']], [
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
</div>
