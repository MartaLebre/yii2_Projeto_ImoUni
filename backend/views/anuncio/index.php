<?php

use common\models\Casa;
use common\models\Perfil;
use common\models\Quarto;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$modelPerfil = Perfil::findOne(Yii::$app->user->getId());
$this->title = 'Anúncios | ' . Yii::$app->name;
AppAsset::register($this);
?>

<div class="anuncio-index">
    <div class="anuncio-search">
        <?php echo $this->render('_search', ['model' => $searchModel]);?>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h1>Meus anúncios</h1>
        </div>
    </div>
    <?php $anuncioSearch = $dataProvider->getModels(); ?>

    <h4><?= count($anuncioSearch) ?> Resultados</h4>
    <hr>
    <div class="row">
        <?php
        if($anuncioSearch == null){?>
            <h3 style="text-align: center">Não existem anúncios registados</h3>
        <?php }
        else{
            foreach($anuncioSearch as $anuncio){
                $modelQuartos = Quarto::find()->where(['id_casa' => $anuncio['id_casa']])->asArray()->all()?>
                <div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-body" style="margin: 0 15px 0 15px">
                            <a href="<?=Url::to(['/anuncio/view', 'id' => $anuncio['id']]); ?>">
                                <div class="row">
                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode(Casa::findOne($anuncio['id_casa'])->getAttribute('foto')) . '" style="width: 230px; height: 230px">'; ?>
                                </div>
                                <div class="row">
                                    <h4><span class="anuncio-titulo"><?= $anuncio['titulo'] ?></span></h4>
                                </div>
                                <div class="row">
                                    <?php
                                    $numDisponiveis = 0;
                                    foreach($modelQuartos as $modelQuarto){
                                        if($modelQuarto['disponibilidade'] == 1)
                                            $numDisponiveis += 1;
                                    }?>
                                    <h4><?= $numDisponiveis ?>/<?= count($modelQuartos) ?> Quartos disponíveis</h4>
                                </div>
                                <div class="row">
                                    <h4><?= $anuncio['preco'] ?>€ / mês</h4>
                                </div>
                            </a>
                            <?php if(($anuncio['id_proprietario'] == Yii::$app->user->getId()) || ($modelPerfil['tipo'] == 3)){ ?>
                                <div class="row">
                                    <?= Html::a('Apagar anúncio', ['delete', 'id' => $anuncio['id']], [
                                        'class' => 'btn btn-danger btn-block',
                                        'data' => [
                                            'confirm' => 'Tem a certeza que deseja eliminar este anúncio?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }
        }?>
    </div>
</div>