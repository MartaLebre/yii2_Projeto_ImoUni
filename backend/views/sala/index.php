<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sala', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_casa',
            'televisao',
            'sofa',
            'moveis',
            //'mesa',
            //'aquecimento',
            //'ac',
            //'foto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
