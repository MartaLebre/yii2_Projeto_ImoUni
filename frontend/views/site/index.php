<?php

use common\models\Perfil;
use common\models\User;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
$_perfil = Perfil::findOne(Yii::$app->user->getId());
?>

<div class="site-index">
    <?php if($_perfil['tipo'] !== 3){ ?>
        <div class="jumbotron">
            <h1><?= Yii::$app->name ?></h1>
            <p class="lead">Encontre a sua propriedade hoje!</p>
        </div>
        
        <?php if(Yii::$app->user->isGuest || ($_perfil['tipo'] !== 2)){ ?>
            <div class="anuncio-search">
                <?php echo $this->render('/anuncio/_search', ['model' => $searchModel]);?>
            </div>
        <?php }
        else{ ?>
            <div class="row" style="text-align: center">
                <?= Html::a('Meus anúncios', ['/anuncio/index'], ['class'=>'btn btn-info']) ?>
            </div>
            <div class="row" style="text-align: center; padding-top: 10px">
                <?= Html::a('Minhas propriedades', ['/casa/index'], ['class'=>'btn btn-info']) ?>
            </div>
        <?php }
    }
    else{ ?>
    <div class="row">
        <div class="col-lg-6">
            <h1>Utilizadores</h1>
            <br>

            <div class="panel panel-default">
                <div class="panel-body">
                    <?php foreach($modelUsers as $modelUser){ ?>
                        <div class="row">
                            <div class="card">
                                <div class="card-content col-lg-7" style="padding-left: 30px">
                                    <div class="card-body">
                                        <h4 class="card-text" style="font-weight: bold">
                                            Username: <span style="font-weight: normal"><?=  $modelUser['username'] ?></span>
                                        </h4>
                                        <h4 class="card-text" style="font-weight: bold">
                                            E-mail: <span style="font-weight: normal"><?= $modelUser['email'] ?></span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row" style="padding-top: 10px">
                                        <?php if($modelUser['status'] == 10){ ?>
                                            <div style="text-align: center">
                                                <?= Html::a('Bloquear utilizador', ['bloquear', 'id' => $modelUser['id']], ['class' => 'btn btn-danger',]) ?>
                                            </div>
                                        <?php }
                                        else{ ?>
                                            <div style="text-align: center">
                                                <?= Html::a('Desbloquear utilizador', ['desbloquear', 'id' => $modelUser['id']], ['class' => 'btn btn-success',]) ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <h1>Anúncios</h1>
            <br>

            <div class="panel panel-default">
                <div class="panel-body">
                    <?php foreach($modelAnuncios as $modelAnuncio){ ?>
                        <div class="row">
                            <div class="card">
                                <div class="card-content col-lg-7" style="padding-left: 30px">
                                    <div class="card-body">
                                        <h4 class="card-text" style="font-weight: bold">
                                            Título: <span style="font-weight: normal"><?=  $modelAnuncio['titulo'] ?></span>
                                        </h4>
                                        <h4 class="card-text" style="font-weight: bold">
                                            <?php $modelAnuncio_user = User::findOne($modelAnuncio['id_proprietario']) ?>
                                            Proprietário: <span style="font-weight: normal"><?= $modelAnuncio_user['username'] ?></span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row" style="padding-top: 10px">
                                        <div style="text-align: center">
                                            <?= Html::a('Eliminar anúncio', ['eliminar', 'id' => $modelAnuncio['id']], ['class' => 'btn btn-danger',]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>
