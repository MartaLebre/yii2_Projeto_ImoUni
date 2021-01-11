<?php

use common\models\Casa;
use common\models\Perfil;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Anúncios | ' . Yii::$app->name;
AppAsset::register($this);
?>

<div class="anuncio-index">
    <?php if(Yii::$app->user->isGuest || (Perfil::findOne(Yii::$app->user->getId())->getAttribute('tipo') !== 2)){ ?>
        <div class="anuncio-search">
            <?php echo $this->render('_search', ['model' => $searchModel]);?>
        </div>
        
        <?php $anuncioSearch = $dataProvider->getModels();?>

        <h4>Resultados da pesquisa: <?= count($anuncioSearch) ?></h4>
        <hr>
        
        <div class="row">
            <?php foreach($anuncioSearch as $anuncio){ ?>
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
                                            <div class="card-content">
                                                <h4 class="card-text"><span style="text-transform: capitalize"><?= Casa::findOne($anuncio['id_casa'])->getAttribute('num_quartos') ?></span> Quartos disponíveis</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card-content">
                                                <h4 class="card-text"><span style="text-transform: capitalize"><?= $anuncio['preco'] ?></span>€ / mês</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php }
    else{ ?>
    <h1>Meus anúncios</h1>
    <br>

    <div class="row">
        <?php foreach($anuncioList as $anuncio){ ?>
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
                                        <div class="card-content">
                                            <h4 class="card-text"><span style="text-transform: capitalize"><?= Casa::findOne($anuncio['id_casa'])->getAttribute('num_quartos') ?></span> Quartos disponíveis</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card-content">
                                            <h4 class="card-text"><span style="text-transform: capitalize"><?= $anuncio['preco'] ?></span>€ / mês</h4>
                                        </div>
                                    </div>
                                </a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        <?php } ?>
    </div>
    <?php } ?>
</div>
