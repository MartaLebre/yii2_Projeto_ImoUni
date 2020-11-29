<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Quarto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quarto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_casa')->textInput() ?>

    <?= $form->field($model, 'disponibilidade')->textInput() ?>

    <?= $form->field($model, 'tamanho')->dropDownList([ 'pequeno' => 'Pequeno', 'medio' => 'Medio', 'grande' => 'Grande', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tipo_cama')->dropDownList([ 'solteiro' => 'Solteiro', 'casal' => 'Casal', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'varanda')->textInput() ?>

    <?= $form->field($model, 'secretaria')->textInput() ?>

    <?= $form->field($model, 'armario')->textInput() ?>

    <?= $form->field($model, 'ac')->textInput() ?>

    <?= $form->field($model, 'foto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
