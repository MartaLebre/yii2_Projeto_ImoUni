<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CasaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Casas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Casa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_proprietario',
            'nome_rua',
            'localizacao',
            'tipo_alojamento',
            //'wifi',
            //'limpeza',
            //'capacidade',
            //'num_quartos',
            //'num_wcs',
            //'aquecimento_agua',
            //'area_exterior',
            //'animais',
            //'fumar',
            //'visitantes_pernoitar',
            //'foto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
