<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cozinha */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cozinha-form">
    <div class="row">
        <div class="col-lg-4">
            <h3>Caracteristicas da cozinha</h3>
            
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'lava_loica')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'maquina_roupa')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'maquina_loica')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'tostadeira')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'torradeira')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'mircro_ondas')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'frigorifico')->dropDownList([ 'sem congelador' => 'Sem congelador', 'com congelador' => 'Com congelador'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'arca')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'fogao')->dropDownList([ 'gas' => 'Gás', 'eletrico' => 'Elétrico'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'forno')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>
            
            <h3>Foto</h3>
            <?php echo $form->field($model, 'foto')->fileInput()->label(false); ?>
            <hr>
        </div>
        <div class="col-lg-4">
            <?= var_dump($id_propriedade)?>
            <?= var_dump($model)?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Adicionar cozinha', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
