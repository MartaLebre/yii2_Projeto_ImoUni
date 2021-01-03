<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Casa */

\yii\web\YiiAsset::register($this);
$this->title = 'Minhas propriedades | ImoUni';
?>
<div class="casa-index">
    <div class="row">
        <div class="col-lg-6">
            <h1>Minhas proriedades</h1>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php foreach($models as $model){ ?>
                        <div class="row">
                            <div class="card">
                                <div class="card-content col-lg-6">
                                    <div class="card-body">
                                        <p class="card-text">Rua: <?=  $model['nome_rua'] ?></p>
                                        <p class="card-text">Tipo de alojamento: <?= $model['tipo_alojamento'] ?></p>
                                        <p class="card-text">Capacidade: <?=  $model['capacidade'] ?> pessoas</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row" style="padding-top: 10px">
                                        <div style="text-align: center">
                                            <?= Html::a('Criar anúncio', ['/casa/create'], ['class'=>'btn btn-success']) ?>
                                        </div>

                                    </div>
                                    <div class="row" style="padding-top: 10px">
                                        <div style="text-align: center">
                                            <?= Html::a('Eliminar propriedade', ['delete', 'id' => $model['id']], [
                                                'class' => 'btn btn-danger',
                                                'data' => [
                                                    'confirm' => 'Tem a certeza que deseja eliminar esta propriedade?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                    <div style="text-align: center">
                        <?= Html::a('Adicionar propriedade', ['/casa/create'], ['class'=>'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>