<?php

use yii\helpers\Html;
use common\models\User;

/* @var $this yii\web\View */

$this->title = 'Visitas | ' . Yii::$app->name;
?>
<div class="visita-index">
    <div class="row">
        <div class="col-lg-12">
            <h1>Visitas</h1>
            
            <?php if($modelVisitas == null){?>
                <hr>
                <h3 style="text-align: center">Não existem visitas marcadas</h3>
            <?php }
            else{ ?>
                <table class="table" style="font-size: 22px">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Hora</th>
                        <th>Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($modelVisitas as $visita){
                        $username = User::findOne($visita['id_estudante'])->getAttribute('username');
                        $email = User::findOne($visita['id_estudante'])->getAttribute('email');
                        $hora_visita = new DateTime($visita['hora_visita']);
                        ?>
                        <tr>
                            <td><?= $username ?></td>
                            <td><?= $email ?></td>
                            <td><?= $hora_visita->format('H:m') ?></td>
                            <td><?= $visita['data_visita'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }?>
        </div>
    </div>
</div>
