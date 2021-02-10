<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Anuncio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncio-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
    
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'preco')->textInput() ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'despesas_inc')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>
    
            <?= $form->field($model, 'data_disponibilidade')->widget(DatePicker::className(), ['clientOptions' => ['format' => 'Y-M-D']]);?>
    
            <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>
    
            <?= $form->field($model, 'numero_telemovel') ?>
            
            <div class="form-group">
                <?= Html::submitButton('Adicionar anúncio', ['class' => 'btn btn-success btn-block']) ?>
            </div
        </div>
    </div>>
    
    <?php ActiveForm::end(); ?>
</div>
