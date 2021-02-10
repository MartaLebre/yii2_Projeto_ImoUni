<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AnuncioSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="anuncio-search">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'method' => 'get',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'offset' => 'col-sm-offset-3',
                'wrapper' => 'col-sm-6',
            ],
        ],
    ]);
    
    // Input group
    echo $form->field($model, 'titulo',
        ['inputTemplate' =>
            '<div class="input-group">
                {input}
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="search-button">Pesquisar</button>
                </div>
            </div>',
        ])->label(false);
    ?>
    
    <?php ActiveForm::end(); ?>
</div>
