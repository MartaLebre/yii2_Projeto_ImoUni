<?php

use common\models\Perfil;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$modelPerfil = Perfil::findOne(Yii::$app->user->getId());
$this->title = Yii::$app->name;
?>

<div class="site-index">
    <div class="bg" style="background: url(<?= Url::to('@web/img/background.jpg') ?>)">
        <div class="bg-blur">
            <div class="jumbotron" style="color: white">
                <h1><?= Yii::$app->name ?></h1>
                <p class="lead">Encontre a sua propriedade hoje!</p>
            </div>
            
            <?php if($modelPerfil['tipo'] !== 2){ ?>
                <div class="anuncio-search col-sm-6 col-sm-offset-3">
                    <?php echo $this->render('/anuncio/_search', ['model' => $searchModel]);?>
                </div>
            <?php }?>
        </div>
    </div>

    <div class="row">
        <br>
        <div class="col-lg-8 col-lg-offset-2 text-center">
            <h1>About</h1>
            <h3>O que é a ImoUni?</h3>
            <h4>A ImoUni é uma plataforma imobiliária dedicada a estudantes, onde estes podem pesquisar e arrendar os quartos de acordo com as suas necessidades.
                <br><br>Visto que atualmente é algo dificil encontrar plataformas imobiliárias só dedicadas a estes, decidimos pôr a ideia em prática e desenvolver esta plataforma.
            </h4>
            <hr>
            <h3>Quem somos?</h3>
            <h4>Somos estudantes da Escola Superior de Tecnologia e Gestão (ESTG) em Leiria e estudamos num Tesp de Programação de Sistemas de Informação.
            </h4>
            <hr>
            <h3>Membros do projeto:</h3>
            <h4>João Pereira<br>
                Lucas Varela<br>
                Marta Lebre</h4>
        </div>
    </div>
</div>
