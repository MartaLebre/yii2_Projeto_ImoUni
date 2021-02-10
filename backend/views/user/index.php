<?php

use common\models\Perfil;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores | ' . Yii::$app->name;
?>
<div class="user-index">
    <div class="user-search">
        <?php echo $this->render('_search', ['model' => $searchModel]);
        
        foreach($dataProvider->getModels() as $modelUser){
            $modelPerfil = Perfil::find()->where(['id_user' => $modelUser['id']])->one();
            
            if($modelUser !== null){
                if($modelPerfil['tipo'] !== 3)
                    $userSearch[] = $modelUser;
            }
            else
                $userSearch = null;
        }?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1>Utilizadores</h1>
            
            <?php if($userSearch == null){?>
                <hr>
                <h3 style="text-align: center">Não existem utilizadores registados</h3>
            <?php }
            else{ ?>
                <table class="table" style="font-size: 22px">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Tipo de utilizador</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($userSearch as $user){
                        $perfil = Perfil::find()->where(['id_user' => $user['id']])->one();?>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <?php if($perfil['tipo'] == 1){ ?>
                                <td> Estudante </td>
                            <?php }
                            else{ ?>
                                <td> Proprietário </td>
                            <?php } ?>
                            <?php if($user['status'] == 10){ ?>
                                <td style="text-align: right;"><?= Html::a('Bloquear utilizador', ['bloquear', 'id' => $user['id']], ['class' => 'btn btn-danger']) ?></td>
                            <?php }
                            else{ ?>
                                <td style="text-align: right;"><?= Html::a('Desbloquear utilizador', ['desbloquear', 'id' => $user['id']], ['class' => 'btn btn-success']) ?></td>
                            <?php } ?>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>

