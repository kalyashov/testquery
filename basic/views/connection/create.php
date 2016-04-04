<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Connection */

$this->title = Yii::t('app', 'Создать подключение к БД');
?>
    <div class="panel connection-create-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

