<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Anuncios | ' . Yii::$app->name;?>

<div class="anuncio-search">
    <?php echo $this->render('_search', ['model' => $searchModel]);?>
</div>
<?php $anuncioSearch = $dataProvider->getModels();?>

<div class="body-content">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php foreach($anuncioSearch as $anuncio){ ?>
                    <div class="card col-sm-6 col-md-3">
                        <div class="card-content">
                            <a href="<?=Url::to(['/anuncio/view', 'id' => $anuncio["id"]]); ?>">
                                <div class="card-body">
                                    <h5 class="card-title">Titulo: <?= $anuncio['titulo']?></h5>
                                    <p class="card-text description">Preço: <?= $anuncio['preco']?></p>
                                    <p class="card-text description">Descrição: <?= $anuncio['descricao']?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
