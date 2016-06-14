<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'QueryTest';

?>
<div class="site-landing">
    <div class="body-content">
        <div class="landing-info">
            <h2>Для дальнейшей работы необходима авторизация.</h2>
            <p><?=Html::a('Регистрация',array('site/reg'),['class' => 'btn btn-success btn-lg land-btn'])?></p>
            <p><?=Html::a('Вход',array('site/login'),['class' => 'btn btn-primary btn-lg land-btn'])?></p>
        </div>
    </div>
</div>
