<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HorarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Horarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="horario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Horario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_perfil',
            'hora_comeco',
            'hora_fim',
            'dia_semana',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
