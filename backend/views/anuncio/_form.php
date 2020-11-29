<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Anuncio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_proprietario')->textInput() ?>

    <?= $form->field($model, 'id_casa')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <?= $form->field($model, 'data_criacao')->textInput() ?>

    <?= $form->field($model, 'data_disponibilidade')->textInput() ?>

    <?= $form->field($model, 'despesas_inc')->textInput() ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
