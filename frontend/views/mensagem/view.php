<?php

use common\models\Perfil;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $mensagemNova common\models\Mensagem */
/* @var $mensagens common\models\Mensagem */
/* @var $remetente common\models\User */
/* @var $destinatario common\models\User */

$this->title = $categoria . ' | ' . Yii::$app->name;
\yii\web\YiiAsset::register($this);
?>
<div class="mensagem-view">
    <div class="row">
        <?php if(Perfil::findOne(Yii::$app->user->getId())->getAttribute('tipo') !== 3){ ?>
            <div class="col-sm-4">
                <h3>Enviar mensagem para:</h3>
                <h4><span style="font-weight: bold">Username: </span><?= $destinatario['username'] ?></h4>
                <h4><span style="font-weight: bold">E-mail: </span><?= $destinatario['email'] ?></h4>
            </div>
            <div class="col-sm-8 text-right">
                <br>
                <h1><?= $categoria ?></h1>
            </div>
        <?php }
        else{?>
            <div class="col-sm-4">
                <h3>Remetente:</h3>
                <h4><span style="font-weight: bold">Username: </span><?= $remetente['username'] ?></h4>
                <h4><span style="font-weight: bold">E-mail: </span><?= $remetente['email'] ?></h4>
            </div>
            <div class="col-sm-4">
                <h3>Destinatario:</h3>
                <h4><span style="font-weight: bold">Username: </span><?= $destinatario['username'] ?></h4>
                <h4><span style="font-weight: bold">E-mail: </span><?= $destinatario['email'] ?></h4>
            </div>
            <div class="col-sm-4 text-right">
                <h1><?= $categoria ?></h1>
            </div>
        <?php }?>
    </div>
    <hr>
    
    <?php foreach($mensagens as $mensagem){
        if(($mensagem['id_remetente'] == Yii::$app->user->getId()) ||
            ($mensagem['id_remetente'] == $remetente['id'])){ ?>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                    <div class="panel panel-primary">
                        <div class="panel-body" style="margin-bottom: -20px">
                            <?= $mensagem['mensagem'] ?>
                            <hr>
                            <div class="row" style="margin-top: -15px">
                                <div class="col-sm-6">
                                    <?php if($mensagem['vista'] == 1){ ?>
                                        <p>Vista</p>
                                    <?php }
                                    else{?>
                                        <p>Por ver</p>
                                    <?php }?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $mensagem['data_envio'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        else{ ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body" style="margin-bottom: -20px">
                            <?= $mensagem['mensagem'] ?>
                            <hr>
                            <div class="row" style="margin-top: -15px">
                                <div class="col-sm-6">
                                    <?php if($mensagem['vista'] == 1){ ?>
                                        <p>Vista</p>
                                    <?php }
                                    else{?>
                                        <p>Por ver</p>
                                    <?php }?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $mensagem['data_envio'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
    if(Perfil::findOne(Yii::$app->user->getId())->getAttribute('tipo') !== 3){?>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-7">
                <div class="mensagem-form">
                    <?= $this->render('_form', ['model' => $mensagemNova]) ?>
                </div>
            </div>
        </div>
    <?php }?>
</div>
