<?php

use common\models\Anuncio;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Casa */

\yii\web\YiiAsset::register($this);
$this->title = 'Minhas propriedades |' . Yii::$app->name;
?>

<div class="casa-index">
    <div class="row">
        <div class="col-lg-8">
            <h1>Minhas proriedades</h1>
            <br>
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php foreach($models as $model){ ?>
                        <div class="row">
                            <div class="card">
                                <div class="col-lg-2">
                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($model['foto']) . '" style="width: 100px; height: 100px">'; ?>
                                </div>
                                <div class="card-content col-lg-6" style="padding-left: 30px">
                                    <div class="card-body">
                                        <h4 class="card-text" style="font-weight: bold">
                                            Rua: <span style="text-transform: capitalize; font-weight: normal"><?=  $model['nome_rua'] ?></span>
                                        </h4>
                                        <h4 class="card-text" style="font-weight: bold">
                                            Tipo de alojamento: <span style="text-transform: capitalize; font-weight: normal"><?= $model['tipo_alojamento'] ?></span>
                                        </h4>
                                        <h4 class="card-text" style="font-weight: bold">
                                            Capacidade: <span style="text-transform: capitalize; font-weight: normal"><?=  $model['capacidade'] ?> pessoas
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <?php if(Anuncio::find()->where(['id_casa' => $model['id']])->count() == 0){ ?>
                                        <div class="row" style="padding-top: 10px">
                                            <div style="text-align: center">
                                                <?= Html::a('Criar anúncio', ['/anuncio/create', 'id_casa' => $model['id']], ['class' => 'btn btn-success']) ?>
                                            </div>
                                        </div>
                                    <?php }?>
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
                    <div style="text-align: center; padding-bottom: 10px">
                        <?= Html::a('Adicionar propriedade', ['/casa/create'], ['class'=>'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>