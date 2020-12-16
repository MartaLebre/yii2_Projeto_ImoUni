<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use nex\datepicker\DatePicker;

$this->title = 'Signup | ImoUni';
?>
<div class="site-signup">
    <h1>Registar nova conta</h1>
    <p>Por favor preencha os seguintes campos:</p>
    <br>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'primeiro_nome')->label('Nome') ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'ultimo_nome')->label('Apelido') ?>
                </div>
            </div>
            
            <?= $form->field($model, 'username')->label('Nome de Utilizador') ?>
            
            <?= $form->field($model, 'email')->label('E-mail') ?>
            
            <?= $form->field($model, 'password')->passwordInput() ?>
            
            <?= $form->field($model, 'numero_telemovel')->label('Telemovel') ?>
    
            <?= $form->field($model, 'genero')->dropDownList(['masculino' => 'Masculino', 'femenino' => 'Femenino'])->label('Genero') ?>
            
            <?= $form->field($model, 'data_nascimento')->widget(DatePicker::className(), ['clientOptions' => ['format' => 'd-M-yyyy',]]);?>
            
            <?= $form->field($model, 'tipo')->dropDownList(['1' => 'Estudante', '2' => 'Proprietario'])->label('Tipo de utilizador') ?>
            
            <div class="form-group">
                <?= Html::submitButton('Registar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
