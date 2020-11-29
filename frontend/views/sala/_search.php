<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SalaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_casa') ?>

    <?= $form->field($model, 'televisao') ?>

    <?= $form->field($model, 'sofa') ?>

    <?= $form->field($model, 'moveis') ?>

    <?php // echo $form->field($model, 'mesa') ?>

    <?php // echo $form->field($model, 'aquecimento') ?>

    <?php // echo $form->field($model, 'ac') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
