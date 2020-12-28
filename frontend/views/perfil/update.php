<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelUser common\models\User */
/* @var $modelPerfil common\models\Perfil */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Signup | ImoUni';
?>
<div class="perfil-form">
    <h1>Atualizar dados da conta</h1>
    <br>

    <div class="row">
        <div class="col-lg-3">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            
            <?= $form->field($modelUser, 'password')->textInput() ?>
    
            <?= $form->field($modelPerfil, 'numero_telemovel')->textInput() ?>
            
            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>