<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Horario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horario-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'hora_comeco')->widget(DatePicker::className(), ['clientOptions' => ['format' => 'HH:mm']]);?>

    <?= $form->field($model, 'hora_fim')->widget(DatePicker::className(), ['clientOptions' => ['format' => 'HH:mm']]);?>

    <?= $form->field($model, 'dia_semana')->dropDownList([ 'segunda' => 'Segunda', 'terca' => 'Terca', 'quarta' => 'Quarta', 'quinta' => 'Quinta', 'sexta' => 'Sexta', ], ['prompt' => '']) ?>

    <hr>
    <div class="form-group">
        <?= Html::submitButton('Adicionar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
