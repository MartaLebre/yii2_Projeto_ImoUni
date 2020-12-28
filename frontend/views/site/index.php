<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::$app->name;
?>

<div class="site-index">
    <div class="jumbotron">
        <h1><?= Yii::$app->name ?></h1>
        <p class="lead">Encontre a sua propriedade hoje!</p>
    </div>

    <div class="anuncio-search">
        <div class="container">
            <?php $form = ActiveForm::begin([
                'action' => ['/anuncio/index'],
                'method' => 'get',
            ]); ?>
            
            <?= $form->field($searchModel, 'titulo')->label('')?>
            
            <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-default', 'name' => 'search-button']) ?>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    
    <div class="body-content jumbotron">
        <h3 class="panel-title" style="font-size: 20px">Escolha uma das</h3>
        <h2 class="panel-title" style="font-size: 30px">Cidades universitárias!</h2>
        <br>
        
        <div class="row">
            <div class="col-lg-3">
                <h2><a class="btn btn-default" href="#url">Lisboa</a></h2>

                img
            </div>
            <div class="col-lg-3">
                <h2><a class="btn btn-default" href="#url">Porto</a></h2>

                img
            </div>
            <div class="col-lg-3">
                <h2><a class="btn btn-default" href="#url">Coimbra</a></h2>

                img
            </div>
            <div class="col-lg-3">
                <h2><a class="btn btn-default" href="#url">Leiria</a></h2>

                img
            </div>
        </div>

    </div>
</div>
