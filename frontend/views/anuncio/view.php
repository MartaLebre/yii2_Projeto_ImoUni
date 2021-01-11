<?php

use yii\helpers\Html;
use common\models\User;
use common\models\Perfil;
use common\models\Casa;
use common\models\Cozinha;
use common\models\Sala;
use common\models\Quarto;
use common\models\Visita;
use common\models\Reserva;

/* @var $this yii\web\View */
/* @var $model common\models\Anuncio */

$this->title = $model['titulo'];

\yii\web\YiiAsset::register($this);

$modelUser = User::findOne($model['id_proprietario']);
$modelPerfil = Perfil::findOne($modelUser['id']);
$modelCasa = Casa::findOne($model['id_casa']);
$modelCozinha = Cozinha::find()->where(['id_casa' => $modelCasa['id']])->one();
$modelSala = Sala::find()->where(['id_casa' => $modelCasa['id']])->one();
$modelQuartos = Quarto::find()->where(['id_casa' => $modelCasa['id']])->asArray()->all();
?>

<div class="anuncio-view">
    <h4 style="font-weight: bold">Disponível a partir de <?= Yii::$app->formatter->asDate($model['data_disponibilidade']) ?></h4>
    <h1><?= $model['titulo'] ?></h1>
    
    <div class="row">
        <div class="col-sm-2" >
            <h4><?= $model['preco'] ?>€ /mês</h4>
        </div>
        <div class="col-sm-3">
            <h4><?php
                if($model['despesas_inc'] == 0){?>
                    Despesas incluidas
                <?php }
                else{ ?>
                    Despesas não incluidas
                <?php }?>
            </h4>
        </div>
        <div class="col-sm-3">
            <h4><?php
                $data_criacao = new DateTime($model->getAttribute('data_criacao'));
                $datetime = new DateTime(date("Y-m-d H:i:s"));
                $diff = $data_criacao->diff($datetime);
                if($diff->days == 0){ ?>
                    Publicado hoje
                <?php }
                else{ 
                    echo $diff->days; ?> dias atrás
                <?php }?>
            </h4>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-8">
            <h3>Descrição</h3>
            <h4><?= $model['descricao'] ?></h4>
        </div>
        <?php
        $_perfil = Perfil::findOne(Yii::$app->user->getId());
        if(($_perfil['tipo'] !== null) && ($_perfil['tipo'] == 1)){ ?>
            <div class="col-sm-4">
                <br><br><br>
                <div class="row" style="text-align: center">
                    <?php
                    $modelVisitas = Visita::find()->where(['id_anuncio' => $model['id']])->asArray()->all();
                    $_visita = false;
                    foreach($modelVisitas as $modelVisita){
                        if($modelVisita['id_estudante'] == Yii::$app->user->getId())
                            $_visita = true;
                    }
                    if(!$_visita){ ?>
                        <div class="col-sm-6">
                            <?= Html::a('Visitar', ['/visita/create', 'id_anuncio' => $model['id']], ['class'=>'btn btn-info']) ?>
                        </div>
                    <?php }
                    
                    $modelReservas = Reserva::find()->where(['id_anuncio' => $model['id']])->asArray()->all();
                    $_reserva = false;
                    foreach($modelReservas as $modelReserva){
                        if($modelReserva['id_estudante'] == Yii::$app->user->getId())
                            $_reserva = true;
                    }
                    if(!$_reserva){ ?>
                        <div class="col-sm-6">
                            <?= Html::a('Reservar', ['/reserva/create', 'id_anuncio' => $model['id']], ['class'=>'btn btn-info']) ?>
                        </div>
                    <?php }?>
                </div>
            </div>
        <?php }?>
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-8">
            
            <div class="row" style="padding-left: 15px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-titulo">Características da propriedade</h3>
                    </div>
                    
                    <div class="panel-body">
                        <div class="col-sm-5">
                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($modelCasa['foto']) . '" style="width: 300px; height: 300px">'; ?>
                        </div>

                        <div class="col-sm-7">
                            <h4 style="font-weight: bold">Capacidade para <span style="font-weight: normal"><?= $modelCasa['capacidade'] ?> pessoas</h4>
                            <h4 style="font-weight: bold">Rua: <span style="text-transform: capitalize; font-weight: normal"><?= $modelCasa['nome_rua'] ?></span></h4>
                            <h4 style="font-weight: bold">Tipo de alojamento: <span style="font-weight: normal"><?= $modelCasa['tipo_alojamento'] ?></h4>
                            <?php
                            if($modelCasa['wifi'] == 1){?>
                                <h4 style="font-weight: bold">Wi-Fi</h4>
                            <?php }?>
                            <h4 style="font-weight: bold">Limpeza: <span style="font-weight: normal"><?= $modelCasa['limpeza'] ?></h4>
                            <h4 style="font-weight: bold"><?= $modelCasa['num_quartos'] ?> Quartos</h4>
                            <h4 style="font-weight: bold"><?= $modelCasa['num_wcs'] ?> WCs</h4>
                            <h4 style="font-weight: bold">Aquecimento de água: <span style="font-weight: normal"><?= $modelCasa['aquecimento_agua'] ?></h4>
                            <?php
                            if($modelCasa['wifi'] == 1){?>
                                <h4 style="font-weight: bold">Área exterior</h4>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="padding-left: 15px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-titulo">Características da cozinha</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-5">
                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($modelCozinha['foto']) . '" style="width: 300px; height: 300px">'; ?>
                        </div>
                        <div class="col-sm-7">
                            <?php
                            if($modelCozinha['lava_loica'] == 1){?>
                                <h4 style="font-weight: bold">Lava-loiça</h4>
                            <?php }
                            if($modelCozinha['maquina_roupa'] == 1){?>
                                <h4 style="font-weight: bold">Máquina de lavar roupa</h4>
                            <?php }
                            if($modelCozinha['maquina_loica'] == 1){?>
                                <h4 style="font-weight: bold">Máquina de lavar loiça</h4>
                            <?php }
                            if($modelCozinha['tostadeira'] == 1){?>
                                <h4 style="font-weight: bold">Torradeira</h4>
                            <?php }
                            if($modelCozinha['torradeira'] == 1){?>
                                <h4 style="font-weight: bold">Torradeira</h4>
                            <?php }
                            if($modelCozinha['mircro_ondas'] == 1){?>
                                <h4 style="font-weight: bold">Micro-ondas</h4>
                            <?php }?>
                            <h4 style="font-weight: bold">Frigorifico <span style="font-weight: normal"><?= $modelCozinha['frigorifico'] ?></h4>
                            <?php
                            if($modelCozinha['arca'] == 1){?>
                                <h4 style="font-weight: bold">Arca</h4>
                            <?php }?>
                            <h4 style="font-weight: bold">Fogão <span style="font-weight: normal"><?= $modelCozinha['fogao'] ?></h4>
                            <?php
                            if($modelCozinha['forno'] == 1){?>
                                <h4 style="font-weight: bold">Forno</h4>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="padding-left: 15px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-titulo">Características da sala</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-5">
                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($modelSala['foto']) . '" style="width: 300px; height: 300px">'; ?>
                        </div>
                        <div class="col-sm-7">
                            <?php
                            if($modelSala['televisao'] == 1){?>
                                <h4 style="font-weight: bold">Televisão</h4>
                            <?php }
                            if($modelSala['sofa'] == 1){?>
                                <h4 style="font-weight: bold">Sofá</h4>
                            <?php }
                            if($modelSala['moveis'] == 1){?>
                                <h4 style="font-weight: bold">Móveis</h4>
                            <?php }
                            if($modelSala['mesa'] == 1){?>
                                <h4 style="font-weight: bold">Mesa</h4>
                            <?php }?>
                            <h4 style="font-weight: bold">Aquecimento: <span style="font-weight: normal"><?= $modelSala['aquecimento'] ?></h4>
                            <?php
                            if($modelSala['ac'] == 1){?>
                                <h4 style="font-weight: bold">AC</h4>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $numQuarto = 0;
            foreach($modelQuartos as $modelQuarto){
                $numQuarto += 1; ?>
                <div class="row" style="padding-left: 15px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-titulo">Características do quarto, número <?= $numQuarto ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-5">
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($modelQuarto['foto']) . '" style="width: 300px; height: 300px">'; ?>
                            </div>
                            <div class="col-sm-7">
                                <h4 style="font-weight: bold">Tamanho: <span style="font-weight: normal"><?= $modelQuarto['tamanho'] ?></h4>
                                <h4 style="font-weight: bold">Tipo da cama: <span style="font-weight: normal"><?= $modelQuarto['tipo_cama'] ?></h4>
                                <?php
                                if($modelQuarto['varanda'] == 1){?>
                                    <h4 style="font-weight: bold">Varanda</h4>
                                <?php }
                                if($modelQuarto['secretaria'] == 1){?>
                                    <h4 style="font-weight: bold">Secretária</h4>
                                <?php }
                                if($modelQuarto['armario'] == 1){?>
                                    <h4 style="font-weight: bold">Armário</h4>
                                <?php }
                                if($modelQuarto['ac'] == 1){?>
                                    <h4 style="font-weight: bold">AC</h4>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        
        <div class="col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-titulo">Informações do proprietário</h4>
                </div>
                <div class="panel-body">
                    <h4 style="text-transform: capitalize; font-weight: bold">Proprietario: <span style="font-weight: normal"><?= $modelPerfil['primeiro_nome'] ?> <?= $modelPerfil['ultimo_nome'] ?></h4>
                    <h4 style="font-weight: bold">Número de telemóvel: <span style="font-weight: normal"><?= $modelPerfil['numero_telemovel'] ?></h4>
                    <h4 style="font-weight: bold">E-mail: <span style="font-weight: normal"><?= $modelUser['email'] ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
