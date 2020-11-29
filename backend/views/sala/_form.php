<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_casa')->textInput() ?>

    <?= $form->field($model, 'televisao')->textInput() ?>

    <?= $form->field($model, 'sofa')->textInput() ?>

    <?= $form->field($model, 'moveis')->textInput() ?>

    <?= $form->field($model, 'mesa')->textInput() ?>

    <?= $form->field($model, 'aquecimento')->dropDownList([ 'lareira' => 'Lareira', 'salamandras' => 'Salamandras', 'nao' => 'Nao', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'ac')->textInput() ?>

    <?= $form->field($model, 'foto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
