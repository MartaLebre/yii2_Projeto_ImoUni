<?php

use yii\helpers\Html;
use common\models\Perfil;

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
    <?php if($userSearch == null){?>
        <h3>Não existem utilizadores registados</h3>
    <?php }
    else{ ?>
    <div class="row">
        <div class="col-lg-10">
            <h1>Utilizadores</h1>
            
            <table class="table" style="font-size: 22px">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($userSearch as $user){ ?>
                    <tr>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <?php if($user['status'] == 10){ ?>
                            <td style="text-align: right;"><?= Html::a('Bloquear utilizador', ['bloquear', 'id' => $user['id']], ['class' => 'btn btn-danger',]) ?></td>
                        <?php }
                        else{ ?>
                            <td style="text-align: right;"><?= Html::a('Desbloquear utilizador', ['desbloquear', 'id' => $user['id']], ['class' => 'btn btn-success',]) ?></td>
                        <?php } ?>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</div>
