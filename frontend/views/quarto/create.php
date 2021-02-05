<?php

use common\models\Casa;
use common\models\Quarto;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Quarto */

$session = Yii::$app->session;
$modelCasa = Casa::findOne($session->get('id_casa'));

$this->title = 'Adicionar quarto | ' . Yii::$app->name;?>
<div class="quarto-create">
    <div class="row">
        <div class="col-lg-12">
            <h1>Adicionar quarto
                (<?= Quarto::find()->where(['id_casa' => $modelCasa->id])->count() + 1 ?>/<?= $modelCasa->num_quartos ?>)</h1>
            <h4>Por favor preencha os seguintes campos</h4>
            <br>

            <div class="quarto-form">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>
