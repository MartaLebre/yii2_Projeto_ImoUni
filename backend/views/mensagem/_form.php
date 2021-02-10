<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensagem-form">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'method' => 'post',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'offset' => 'col-sm-offset-0',
                'wrapper' => 'col-sm-10',
            ],
        ],
    ]);
    
    // Input group
    echo $form->field($model, 'mensagem',
        ['inputTemplate' =>
            '<div class="input-group">
                {input}
                <div class="input-group-btn">
                    <button class="btn btn-success" type="submit" >Enviar</button>
                </div>
            </div>',
        ])->label(false);
    ?>

    <?php ActiveForm::end();?>
</div>
