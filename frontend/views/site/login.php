<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login | ImoUni';
?>
<div class="site-login">
    <h1>Login</h1>
    <p>Por favor preencha os seguintes campos</p>
    <br>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Nome de Utilizador') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Lembrar-me') ?>

            <div style="color:#999;margin:1em 0">
                <?= Html::a('Esqueceu a sua password?', ['site/request-password-reset']) ?>
                <br>
                <?= Html::a('Reenviar verificação de email', ['site/resend-verification-email']) ?>
            </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
