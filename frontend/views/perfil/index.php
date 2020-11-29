<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PerfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perfils';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Perfil', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_user',
            'email:email',
            'password',
            'tipo',
            'data_nascimento',
            //'data_criacao',
            //'numero_telemovel',
            //'primeiro_nome',
            //'ultimo_nome',
            //'genero',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
