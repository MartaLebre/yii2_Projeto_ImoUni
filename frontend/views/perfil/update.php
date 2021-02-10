<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $_user common\models\SignupForm */
/* @var $perfil common\models\Perfil */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update | ImoUni';
?>
<div class="perfil-form">
    <h1>Atualizar dados da conta</h1>
    <br>

    <div class="row">
        <div class="col-lg-3">
            <?php $form = ActiveForm::begin(['id' => 'perfil-update']); ?>
    
            <?= $form->field($_user, 'password')->passwordInput() ?>
            
            <?= $form->field($perfil, 'numero_telemovel')->textInput() ?>
            
            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-block']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>