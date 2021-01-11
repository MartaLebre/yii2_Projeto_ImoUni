<?php

use common\models\Casa;
use common\models\Quarto;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Quarto */
/* @var $form yii\widgets\ActiveForm */

$session = Yii::$app->session;
$modelCasa = Casa::findOne($session->get('id_casa'));
?>

<div class="quarto-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <div class="row">
        <div class="col-lg-4">
            <h3>Caracteristicas do quarto</h3>
            
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'tamanho')->dropDownList([ 'pequeno' => 'Pequeno', 'medio' => 'Médio', 'grande' => 'Grande', ], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'tipo_cama')->dropDownList([ 'solteiro' => 'Solteiro', 'casal' => 'Casal', ], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'varanda')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'secretaria')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'armario')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'ac')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <h3>Foto</h3>
            <?php echo $form->field($model, 'foto')->fileInput()->label(false); ?>
            <hr>
        </div>
    </div>

    <div class="form-group">
        <?php
        if($modelCasa->num_quartos > Quarto::find()->where(['id_casa' => $modelCasa->id])->count())
            echo Html::submitButton('Adicionar quarto', ['class' => 'btn btn-success']);
        else
            echo Html::submitButton('Finalizar propriedade', ['class' => 'btn btn-success']);
        ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
