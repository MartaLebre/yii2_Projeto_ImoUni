<?php

use common\models\Perfil;
use common\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MensagemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensagem | ' . Yii::$app->name;
?>

<div class="mensagem-index">
    <div class="mensagem-search">
        <?php
        echo $this->render('_search', ['model' => $searchModel]);

        $mensagemList = null;
        
        foreach($dataProvider->getModels() as $modelMensagem){
            if(($modelMensagem['id_remetente'] == Yii::$app->user->getId()) ||
                ($modelMensagem['id_destinatario'] == Yii::$app->user->getId())){
                if($mensagemList){
                    foreach($mensagemList as $_modelMensagem){
                        if($modelMensagem['categoria'] == $_modelMensagem['categoria'])
                            $mensagemList_hasMensagem = true;
                        else
                            $mensagemList_hasMensagem = false;
                    }
                    if(!$mensagemList_hasMensagem)
                        $mensagemList[] = $modelMensagem;
                }
                else
                    $mensagemList[] = $modelMensagem;
            }
        }?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1>Mensagens</h1>
            
            <?php if(!$mensagemList){?>
                <hr>
                <h3 style="text-align: center">Não existem mensagens</h3>
            <?php }
            else{ ?>
                <table class="table" style="font-size: 22px">
                    <thead>
                    <tr>
                        <th>Assunto</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($mensagemList as $mensagem){ ?>
                        <tr>
                            <td><?= $mensagem['categoria'] ?></td>
                            <td style="text-align: right"><?= Html::a('Mensagens', ['view', 'id' => $mensagem['id']], ['class' => 'btn btn-success']) ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>
