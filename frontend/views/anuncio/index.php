<?php

use common\models\Casa;
use common\models\Perfil;
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
    
    <?php if($modelPerfil['tipo'] == 2){
        foreach($dataProvider->getModels() as $modelAnuncio){
            if($modelAnuncio['id_proprietario'] == Yii::$app->user->getId())
                $anuncioSearch[] = $modelAnuncio;
            else
                $anuncioSearch = null;
        }?>

        <div class="row">
            <div class="col-lg-6">
                <h1>Meus anúncios</h1>
            </div>
            <div class="col-lg-6 text-right">
                <div style="padding-top: 10px">
                    <br>
                    <?= Html::a('Adicionar anúncio', ['/casa/create'], ['class'=>'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    <?php }
    else{
        $anuncioSearch = $dataProvider->getModels(); ?>

        <h4><?= count($anuncioSearch) ?> Resultados</h4>
    <?php }?>
    <hr>
    <div class="row">
        <?php
        if($anuncioSearch == null){?>
            <h3 style="text-align: center">Não existem anúncios registados</h3>
        <?php }
        else{
            foreach($anuncioSearch as $anuncio){?>
                <div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="container card">
                                <div class="card-body">
                                    <a href="<?=Url::to(['/anuncio/view', 'id' => $anuncio['id']]); ?>">
                                        <div class="row">
                                            <div class="card-content">
                                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode(Casa::findOne($anuncio['id_casa'])->getAttribute('foto')) . '" style="width: 230px; height: 230px">'; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card-content">
                                                <h4 class="card-text"><span class="anuncio-titulo"><?= $anuncio['titulo'] ?></span></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card-content te">
                                                <h4 class="card-text"><?= Casa::findOne($anuncio['id_casa'])->getAttribute('num_quartos') ?> Quartos disponíveis</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card-content">
                                                <h4 class="card-text"><?= $anuncio['preco'] ?>€ / mês</h4>
                                            </div>
                                        </div>
                                    </a>
                                    <?php if(($anuncio['id_proprietario'] == Yii::$app->user->getId()) || ($modelPerfil['tipo'] == 3)){ ?>
                                        <div class="row">
                                            <div class="card-content">
                                                <p class="card-text">
                                                    <?= Html::a('Apagar anúncio', ['delete', 'id' => $anuncio['id']], [
                                                        'class' => 'btn btn-danger',
                                                        'data' => [
                                                            'confirm' => 'Tem a certeza que deseja eliminar este anúncio?',
                                                            'method' => 'post',
                                                        ],
                                                    ]) ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        }?>
    </div>
</div>