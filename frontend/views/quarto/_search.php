<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuartoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quarto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_casa') ?>

    <?= $form->field($model, 'disponibilidade') ?>

    <?= $form->field($model, 'tamanho') ?>

    <?= $form->field($model, 'tipo_cama') ?>

    <?php // echo $form->field($model, 'varanda') ?>

    <?php // echo $form->field($model, 'secretaria') ?>

    <?php // echo $form->field($model, 'armario') ?>

    <?php // echo $form->field($model, 'ac') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
