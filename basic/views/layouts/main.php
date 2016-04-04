<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">

                <?php
                    if(!Yii::$app->user->isGuest)
                    {
                        echo '<!-- sidebar -->
                            <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
                                <div class="user-info">
                                    <div class="avatar"></div>'.
                                    '<div class="username">'. Yii::$app->user->identity->username  .'</div>'.
                                '</div>

                                <ul class="nav">
                                    <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
                                </ul>
                                <ul class="nav hidden-xs" id="lg-menu">
                                    <li class="active">'.Html::a('Главная панель',array('site/index')).'</li>'.
                                    '<li>'.Html::a('Тюнинг',array('site/tuning')).'</li>'.
                                    '<li>'.Html::a('Настройки',array('connection/index')).'</li>'.
                                '</ul>

                                <!-- tiny only nav-->
                                <ul class="nav visible-xs" id="xs-menu">
                                    <li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
                                    <li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
                                    <li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
                                    <li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
                                </ul>
                            </div>
                            <!-- /sidebar -->';
                    }
                    else
                    {

                    }

                    echo '<!-- main right col -->
                        <div class="column col-sm-10 col-xs-11" id="main">

                            <!-- top nav -->
                            <div class="navbar navbar-blue navbar-static-top">
                                <div class="navbar-header">
                                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a href="/" class="navbar-brand logo">Query Test</a>
                                </div>
                                <nav class="collapse navbar-collapse" role="navigation">

                                <ul class="nav navbar-nav navbar-right">
                                  <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                                    <ul class="dropdown-menu">
                                      <li><a href="">More</a></li>
                                      <li><a href="">More</a></li>
                                      <li><a href="">More</a></li>
                                      <li><a href="">More</a></li>
                                      <li><a href="">More</a></li>
                                    </ul>
                                  </li>
                                </ul>
                                </nav>
                            </div>
                            <!-- /top nav -->

                        <div class="padding">
                            <div class="full col-sm-9">'.
                            $content.
                            '</div>
                        </div>';
                ?>


           </div>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

