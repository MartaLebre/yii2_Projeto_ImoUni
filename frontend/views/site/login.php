<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login | ImoUni';
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-5">
            <h1>Login</h1>
            <p>Por favor preencha os seguintes campos</p>
            <br>
            <div class="horario-form">
                <div class="row">
                    <div class="col-lg-6">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    
                        <?= $form->field($model, 'username')->textInput()->label('Nome de Utilizador') ?>
    
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        
                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
    
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
