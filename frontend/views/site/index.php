<?php

use common\models\Perfil;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Estatistica;

/* @var $this yii\web\View */

$modelPerfil = Perfil::findOne(Yii::$app->user->getId());
if($modelPerfil['tipo'] == 3)
    $this->title = 'Administrador | ' . Yii::$app->name;
else
    $this->title = Yii::$app->name;
?>

<div class="site-index">
    <?php if($modelPerfil['tipo'] !== 3){ ?>
        <div class="jumbotron">
            <h1><?= Yii::$app->name ?></h1>
            <p class="lead">Encontre a sua propriedade hoje!</p>
        </div>
        
        <?php if($modelPerfil['tipo'] !== 2){ ?>
            <div class="anuncio-search">
                <?php echo $this->render('/anuncio/_search', ['model' => $searchModel]);?>
            </div>
        <?php }
        else{ ?>
            <div class="row" style="text-align: center">
                <?= Html::a('Meus anúncios', ['/anuncio/index'], ['class'=>'btn btn-info']) ?>
            </div>
        <?php }
    }
    else{ ?>
        <div class="row">
            <div class="col-lg-6">
                <h1>Estatísticas</h1>

                <table class="table" style="font-size: 22px">
                    <tbody>
                    <tr>
                        <td>N.º de utilizadores</td>
                        <td><?= $estatisticas['num_users'] ?></td>
                    </tr>
                    <tr>
                        <td>N.º de gênero masculino</td>
                        <td><?= $estatisticas['num_genero_mas'] ?></td>
                    </tr>
                    <tr>
                        <td>N.º de gênero feminino</td>
                        <td><?= $estatisticas['num_genero_fem'] ?></td>
                    </tr>
                    <tr>
                        <td>Idade média dos utilizadores</td>
                        <td><?= $estatisticas['idade_media'] ?> anos</td>
                    </tr>
                    <tr>
                        <td>N.º total de anúncios</td>
                        <td><?= $estatisticas['total_anuncios'] ?></td>
                    </tr>
                    <tr>
                        <td>Preço médio dos anúncios</td>
                        <td><?= $estatisticas['preco_medio'] ?>€</td>
                    </tr>
                    <tr>
                        <td>N.º total de reservas</td>
                        <td><?= $estatisticas['total_reservas'] ?></td>
                    </tr>
                    <tr>
                        <td>N.º total de visitas</td>
                        <td><?= $estatisticas['total_visitas'] ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php }?>
</div>
