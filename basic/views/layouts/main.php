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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
    ];

    if(Yii::$app->user->isGuest):
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/reg']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
    else:
        $menuItems[] =
            [
                'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
    endif;

    NavBar::begin([
        'brandLabel' => 'Query Test',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'upper-menu navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container" style="width: 100%">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>


        <?php
            if(!Yii::$app->user->isGuest)
            {
                echo '<div class="row">
                        <div class="col-md-2">
                            <div id="sidebar-wrapper">
                                <ul class="sidebar-nav">
                                    <li>'.
                                        Html::a('Главная панель',array('site/index')) .
                                    '</li>
                                    <li>'.
                                        Html::a('Получить план',array('site/queryplan')) .
                                    '</li>
                                    <li>'.
                                        Html::a('Настройки',array('connection/index')) .
                                    '</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-10">' .
                            $content .
                        '</div>';
            }
            else
            {
                echo $content;
            }
        ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

