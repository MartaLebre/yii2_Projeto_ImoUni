<?php

use nex\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserva-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'data_entrada')->textInput()->widget(DatePicker::className(), ['clientOptions' => ['format' => 'Y-M-D']]); ?>
            <hr>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Marcar', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
