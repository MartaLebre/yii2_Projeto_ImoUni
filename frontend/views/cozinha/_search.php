<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CozinhaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cozinha-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_casa') ?>

    <?= $form->field($model, 'lava_loica') ?>

    <?= $form->field($model, 'maquina_roupa') ?>

    <?= $form->field($model, 'maquina_loica') ?>

    <?php // echo $form->field($model, 'tostadeira') ?>

    <?php // echo $form->field($model, 'torradeira') ?>

    <?php // echo $form->field($model, 'mircro_ondas') ?>

    <?php // echo $form->field($model, 'frigorifico') ?>

    <?php // echo $form->field($model, 'arca') ?>

    <?php // echo $form->field($model, 'fogao') ?>

    <?php // echo $form->field($model, 'forno') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
