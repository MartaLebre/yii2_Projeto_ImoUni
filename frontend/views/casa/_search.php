<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CasaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="casa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_proprietario') ?>

    <?= $form->field($model, 'nome_rua') ?>

    <?= $form->field($model, 'localizacao') ?>

    <?= $form->field($model, 'tipo_alojamento') ?>

    <?php // echo $form->field($model, 'wifi') ?>

    <?php // echo $form->field($model, 'limpeza') ?>

    <?php // echo $form->field($model, 'capacidade') ?>

    <?php // echo $form->field($model, 'num_quartos') ?>

    <?php // echo $form->field($model, 'num_wcs') ?>

    <?php // echo $form->field($model, 'aquecimento_agua') ?>

    <?php // echo $form->field($model, 'area_exterior') ?>

    <?php // echo $form->field($model, 'animais') ?>

    <?php // echo $form->field($model, 'fumar') ?>

    <?php // echo $form->field($model, 'visitantes_pernoitar') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
