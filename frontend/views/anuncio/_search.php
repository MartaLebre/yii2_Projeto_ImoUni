<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AnuncioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_proprietario') ?>

    <?= $form->field($model, 'id_casa') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'preco') ?>

    <?php // echo $form->field($model, 'data_criacao') ?>

    <?php // echo $form->field($model, 'data_disponibilidade') ?>

    <?php // echo $form->field($model, 'despesas_inc') ?>

    <?php // echo $form->field($model, 'descricao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
