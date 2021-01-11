<?php

use common\models\Perfil;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>

<div class="site-index">
    <div class="jumbotron">
        <h1><?= Yii::$app->name ?></h1>
        <p class="lead">Encontre a sua propriedade hoje!</p>
    </div>
    
    <?php if(Yii::$app->user->isGuest || (Perfil::findOne(Yii::$app->user->getId())->getAttribute('tipo') !== 2)){ ?>
        <div class="anuncio-search">
            <?php echo $this->render('/anuncio/_search', ['model' => $searchModel]);?>
        </div>
    <?php }
    else{ ?>
        <div class="row" style="text-align: center">
            <?= Html::a('Meus anúncios', ['/anuncio/index'], ['class'=>'btn btn-info']) ?>
        </div>
        <div class="row" style="text-align: center; padding-top: 10px">
            <?= Html::a('Minhas propriedades', ['/casa/index'], ['class'=>'btn btn-info']) ?>
        </div>
    <?php }?>
</div>
