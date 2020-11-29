<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Visita */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_estudante')->textInput() ?>

    <?= $form->field($model, 'id_anuncio')->textInput() ?>

    <?= $form->field($model, 'hora_visita')->textInput() ?>

    <?= $form->field($model, 'data_visita')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
