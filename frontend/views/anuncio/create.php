<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Anuncio */

$this->title = 'Adicionar anúncio | ImoUni';
?>
<div class="anuncio-create">
    <div class="row">
        <div class="col-lg-12">
            <h1>Adicionar anúncio</h1>
            <h4>Por favor preencha os seguintes campos</h4>
            <br>

            <div class="anuncio-form">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>
