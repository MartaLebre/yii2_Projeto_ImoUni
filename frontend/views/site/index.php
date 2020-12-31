<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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
                'layout' => 'horizontal',
                'action' => ['/anuncio/index'],
                'method' => 'get',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'offset' => 'col-sm-offset-3',
                        'wrapper' => 'col-sm-6',
                    ],
                ],
            ]);

            // Input group
            echo $form->field($searchModel, 'titulo',
            ['inputTemplate' =>
            '<div class="input-group">
                <input type="text" class="form-control">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="search-button">Pesquisar</button>
                </div>
            </div>',
            ])->label(false);
            ?>
            
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
