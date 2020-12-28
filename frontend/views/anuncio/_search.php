<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AnuncioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncio-search">
    <div class="container">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
        
        <?= $form->field($model, 'titulo')->label('')?>
        
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-default', 'name' => 'search-button']) ?>
        
        <?php ActiveForm::end(); ?>
    </div>
</div>
