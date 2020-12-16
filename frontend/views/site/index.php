<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AnuncioSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'ImoUni';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>ImoUni</h1>
        <p class="lead">Encontre a sua propriedade hoje!</p>

        <div class="anuncio-search">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>
        
            <?php //$form->field($model, 'titulo')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-default', 'name' => 'search-button']) ?>
            </div>
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
