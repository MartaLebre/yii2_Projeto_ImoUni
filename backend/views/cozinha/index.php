<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cozinhas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cozinha-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cozinha', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_casa',
            'lava_loica',
            'maquina_roupa',
            'maquina_loica',
            //'tostadeira',
            //'torradeira',
            //'mircro_ondas',
            //'frigorifico',
            //'arca',
            //'fogao',
            //'forno',
            //'foto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
