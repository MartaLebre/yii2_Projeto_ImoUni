<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cozinha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cozinha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'id_casa')->textInput() ?>

    <?= $form->field($model, 'lava_loica')->textInput() ?>

    <?= $form->field($model, 'maquina_roupa')->textInput() ?>

    <?= $form->field($model, 'maquina_loica')->textInput() ?>

    <?= $form->field($model, 'tostadeira')->textInput() ?>

    <?= $form->field($model, 'torradeira')->textInput() ?>

    <?= $form->field($model, 'mircro_ondas')->textInput() ?>

    <?= $form->field($model, 'frigorifico')->dropDownList([ 'sem congelador' => 'Sem congelador', 'com congelador' => 'Com congelador', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'arca')->textInput() ?>

    <?= $form->field($model, 'fogao')->dropDownList([ 'gas' => 'Gas', 'eletrico' => 'Eletrico', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'forno')->textInput() ?>

    <?= $form->field($model, 'foto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
