<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Casa */

$this->title = 'Adicionar propriedade | ' . Yii::$app->name; ?>
<div class="casa-create">
    <div class="row">
        <div class="col-lg-12">
            <h1>Adicionar propriedade</h1>
            <h4>Por favor preencha os seguintes campos</h4>
            <br>
            
            <div class="casa-form">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>
