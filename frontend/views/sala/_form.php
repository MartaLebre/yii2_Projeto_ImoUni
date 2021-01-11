<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <div class="row">
        <div class="col-lg-4">
            <h3>Caracteristicas da sala</h3>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'televisao')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'sofa')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'moveis')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'mesa')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'aquecimento')->dropDownList([ 'lareira' => 'Lareira', 'salamandras' => 'Salamandras', 'nao' => 'Não', ], ['prompt' => '']) ?>
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
        <?= Html::submitButton('Adicionar sala', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
