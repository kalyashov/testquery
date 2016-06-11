<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Connection */

$this->title = Yii::t('app', 'Изменить подключение: ', [
    'modelClass' => 'Connection',
]) . ' ' . $model->id;

?>
<div class="panel connection-update-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
