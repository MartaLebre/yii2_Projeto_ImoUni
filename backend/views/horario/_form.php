<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Horario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_perfil')->textInput() ?>

    <?= $form->field($model, 'hora_comeco')->textInput() ?>

    <?= $form->field($model, 'hora_fim')->textInput() ?>

    <?= $form->field($model, 'dia_semana')->dropDownList([ 'segunda' => 'Segunda', 'terca' => 'Terca', 'quarta' => 'Quarta', 'quinta' => 'Quinta', 'sexta' => 'Sexta', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
