<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Casa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="casa-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-4">
            <h3>Caracteristicas da propriedade</h3>
            
            <?= $form->field($model, 'nome_rua')->textInput() ?>
            
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'tipo_alojamento')->dropDownList([ 'apartamento' => 'Apartamento', 'moradia' => 'Moradia'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'limpeza')->dropDownList([ 'quinzenal' => 'Quinzenal', 'mensal' => 'Mensal', 'nao' => 'Nao'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'capacidade')->textInput() ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'num_quartos')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'num_wcs')->textInput() ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'aquecimento_agua')->dropDownList([ 'termoacumulador' => 'Termoacumulador', 'esquentador' => 'Esquentador'], ['prompt' => '']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'wifi')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'area_exterior')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
                </div>
            </div>

            <h3>Foto</h3>
            <?php echo $form->field($model, 'foto')->fileInput()->label(false); ?>
            
            <hr>
        </div>
        
        <div class="col-lg-2" style="padding-left: 50px">
            <h3>Regras</h3>
            <div>
                <?= $form->field($model, 'animais')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
        
                <?= $form->field($model, 'fumar')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
        
                <?= $form->field($model, 'visitantes_pernoitar')->dropDownList([ '0' => 'Não', '1' => 'Sim'], ['prompt' => '']) ?>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Adicionar propriedade', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
