<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Perfil;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-inverse navbar-fixed-top'],
    ]);
    if(Yii::$app->user->isGuest){
        $navLeft[] = ['label' => 'Pesquisar', 'url' => ['/anuncio/index']];
        
        $navRight = [
            ['label' => 'Signup', 'url' => ['/site/signup']],
            ['label' => 'Login', 'url' => ['/site/login']],
        ];
    }
    else{
        if(Perfil::findOne(Yii::$app->user->getId())->getAttribute('tipo') == 2){
            $navLeft = [
                ['label' => 'Pesquisar', 'url' => ['/anuncio/index']],
                ['label' => 'Meus anúncios', 'url' => ['#']],
            ];
    
            $navRight = [
                ['label' => Yii::$app->user->identity->username,
                 'items' => [
                     '<li class="dropdown-header">Informações da conta</li>',
                     ['label' => 'Alterar dados', 'url' => ['/perfil/update?id=' . Yii::$app->user->getId()]],
                     ['label' => 'Horários', 'url' => ['/horario/index']],
                     ['label' => 'Minhas propriedades', 'url' => ['/casa/index']]]],
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton('Logout', ['class' => 'btn btn-link logout'])
                . Html::endForm()
                . '</li>',
            ];
        }
        else{
            $navLeft[] = ['label' => 'Pesquisar', 'url' => ['/anuncio/index']];
    
            $navRight = [
                ['label' => Yii::$app->user->identity->username,
                 'items' => [
                     '<li class="dropdown-header">Informações da conta</li>',
                     ['label' => 'Alterar dados', 'url' => ['/perfil/update?id=' . Yii::$app->user->getId()]]]],
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton('Logout', ['class' => 'btn btn-link logout'])
                . Html::endForm()
                . '</li>',
            ];
        }
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $navLeft,
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navRight,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
