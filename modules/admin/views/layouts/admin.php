<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\ltAppAsset;

AppAsset::register($this);
ltAppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <?php
        //        $this->registerJsFile('js/html5shiv.js', ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lte IE9']);
        //        $this->registerJsFile('js/respond.min.js', ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lte IE9']);
        ?>

        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->

    <body>
    <div>
        <?php $this->beginBody() ?>
        <header id="header"><!--header-->

            <div class="header-middle"><!--header-middle-->
                <div class="container ">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="<?= \yii\helpers\Url::home()?>"><?= Html::img('@web/images/home/manstore_logo.jpg', ['alt' => 'E-SHOPPER'])?></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <?php if(!Yii::$app->user->isGuest): ?>
                                        <li><a href="<?=\yii\helpers\Url::to(['/site/logout'])?>">
                                                <i class="fa fa-user"></i> <?=Yii::$app->user->identity['username']?>(Выход)</a></li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="<?=\yii\helpers\Url::to(['/admin']) ?>" class="active">Главная</a></li>
                                    <li class="dropdown"><a href="#">Категории<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="<?=\yii\helpers\Url::to(['category/index']) ?>">Список категорий</a></li>
                                            <li><a href="<?=\yii\helpers\Url::to(['category/create']) ?>">Добавить категорию</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Товары<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="<?=\yii\helpers\Url::to(['product/index']) ?>">Список товаров</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="search_box pull-right">
                                <form method="get" action="<?= \yii\helpers\Url::to(['category/search'])?>">
                                    <input type="text" placeholder="Search" name="q">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->
        <div class="container">
            <?= $content ?>
        </div>
        <footer id="footer"><!--Footer-->

            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <p class="pull-left">Copyright © 2017 MAN-STORE Inc. All rights reserved.</p>
                    </div>
                </div>
            </div>

        </footer><!--/Footer-->

        <?php
        \yii\bootstrap\Modal::begin([
            'header' => '<h2>Корзина</h2>',
            'id' => 'cart',
            'size' => 'modal-lg',
            'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
        <a href="' .\yii\helpers\Url::to(['cart/view']) . '" class="btn btn-success">Оформить заказ</a>
        <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>'
        ]);

        \yii\bootstrap\Modal::end();
        ?>

        <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>