<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

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
        'brandLabel' => "ProgBlog",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-lg custom-navbar',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav  mr-auto'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О нас', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']]
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        echo HTML::a('Регистрация', Url::to(['site/signup']), ['class' => 'btn']);
        echo HTML::a('Войти', Url::to(['site/login']), ['class' => 'login-btn']);
    } else {
        echo '<div class="dropdown">
                  <a class="link-profile" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ' . FAS::icon('user')->addCssClass('mr-1')->size(FAS::SIZE_EXTRA_SMALL) . Yii::$app->user->identity->username . '
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href=' . Url::to(['']) . '>' . FAS::icon('address-card')->addCssClass('mr-1') . ' Профиль</a>
                    <a class="dropdown-item" href=' . Url::to(['site/logout']) . '>' . FAS::icon('sign-out-alt')->addCssClass('mr-1') . ' Выйти</a>
                  </div>
                </div>';
    }

    NavBar::end();
    ?>

    <div class="container">
        <div class="main-content">

            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ПрогБлог <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
