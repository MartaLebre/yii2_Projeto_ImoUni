<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Casa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="casa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_proprietario')->textInput() ?>

    <?= $form->field($model, 'nome_rua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localizacao')->textInput() ?>

    <?= $form->field($model, 'tipo_alojamento')->dropDownList([ 'apartamento' => 'Apartamento', 'moradia' => 'Moradia', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'wifi')->textInput() ?>

    <?= $form->field($model, 'limpeza')->dropDownList([ 'quinzenal' => 'Quinzenal', 'mensal' => 'Mensal', 'nao' => 'Nao', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'capacidade')->textInput() ?>

    <?= $form->field($model, 'num_quartos')->textInput() ?>

    <?= $form->field($model, 'num_wcs')->textInput() ?>

    <?= $form->field($model, 'aquecimento_agua')->dropDownList([ 'termoacumulador' => 'Termoacumulador', 'esquentador' => 'Esquentador', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'area_exterior')->textInput() ?>

    <?= $form->field($model, 'animais')->textInput() ?>

    <?= $form->field($model, 'fumar')->textInput() ?>

    <?= $form->field($model, 'visitantes_pernoitar')->textInput() ?>

    <?= $form->field($model, 'foto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
