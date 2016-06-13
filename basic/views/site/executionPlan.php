<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 13.06.2016
 * Time: 13:35
 */
use yii\widgets\Breadcrumbs;

$this->title = 'Получить план выполнения';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/testquery/basic/web/js/execPlan.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/testquery/basic/web/css/executionPlan.css');

?>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

<div class="section-full">
    <h2>Получить план выполнения запроса <i id="editorInfo" class="fa fa-question-circle fa-pull-right" aria-hidden="true"></i></h2>
    <div class = "form-group">
        <textarea id="sqlCode" name="sql-code" class="form-control" rows="4" placeholder="SQL"></textarea>
        <button id="getPlanBtn"><i class="fa fa-play" aria-hidden="true"></i></button>
    </div>

    <table id="planTable" class="table table-hover" cellspacing="0" width="100%">
        <caption id="planInfo">
        </caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>OPERATION</th>
                <th>OBJECT_NAME</th>
                <th>OPTIONS</th>
                <th>CARDINALITY</th>
                <th class="cost">COST</th>
            </tr>
        </thead>
    </table>

</div>
