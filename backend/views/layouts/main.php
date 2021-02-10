<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

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
        $navRight = ['label' => 'Login', 'url' => ['/site/login']];
    }
    else{
        $navLeft = [
            ['label' => 'Utilizadores', 'url' => ['/user/index']],
            ['label' => 'Anúncios', 'url' => ['/anuncio/index']],
            ['label' => 'Mensagens', 'url' => ['/mensagem/index']],
        ];
    
        $navRight = [
            ['label' => Yii::$app->user->identity->username],
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton('Logout', ['class' => 'btn btn-link logout'])
            . Html::endForm()
            . '</li>',
        ];
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
