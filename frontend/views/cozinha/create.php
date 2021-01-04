<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cozinha */

$this->title = 'Adicionar cozinha | ImoUni';
?>
<div class="cozinha-create">
    <div class="row">
        <div class="col-lg-12">
            <h1>Adicionar cozinha</h1>
            <h4>Por favor preencha os seguintes campos:</h4>
            <br>
            <div class="cozinha-form">
                <?= $this->render('_form', [
                        'model' => $model,
                        'id_propriedade' => $id_propriedade,
                ]) ?>
            </div>
        </div>
    </div>
</div>
