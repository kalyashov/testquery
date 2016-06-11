<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 02.03.2016
 * Time: 18:37
 */

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('app', 'Тюнинг');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

    <div class="panel user-queries">
        <h3>Sql-запросы</h3>
        <table id="long-running-queries" class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>SQL_ID</th>
                <th>SQL_FULLTEXT</th>
                <th>ELAPSED_TIME</th>
                <th>CPU TIME</th>
                <th>DISK_READS</th>
                <th>EXECUTIONS</th>
                <th>CHILD_NUMBER</th>
                <th>FIRST_LOAD_TIME</th>
                <th>LAST_LOAD_TIME</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="panel plan-info">
        <h3>Получить план запроса</h3>
        <div class="plan-input row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="input-group plan-input">
                    <span class="input-group-addon" id="basic-addon1">Explain plan for</span>
                    <input id="query-input" type="text" class="form-control" placeholder="SQL" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                <button id="getQueryPlan" type="button" class="btn btn-primary btn-sm">Получить</button>
            </div>
        </div>

        <table id="plan_table" class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Id</th>
                <th>Operation</th>
                <th>Object_name</th>
                <th>Options</th>
                <th>Cardinality</th>
                <th class="cost">Cost</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="panel">
        <h3>Выполнить запрос</h3>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-9 col-lg-6">
                <div class="input-group query-input">
                    <input id="query-input" type="text" class="form-control" placeholder="SQL" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                <button id="executeQuery" type="button" class="btn btn-primary btn-sm">Выполнить</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="queryInfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Текст и план запроса</h4>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#sqlText" aria-controls="sqlText" role="tab" data-toggle="tab">Текст запроса</a></li>
                        <li role="presentation"><a href="#sqlPlan" aria-controls="sqlPlan" role="tab" data-toggle="tab">План запроса</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane  in active" id="sqlText">
                            <pre class="content">
                            Информация недоступна!
                            </pre>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="sqlPlan">
                            <table id="sqlPlanTable" class="table table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Operation</th>
                                        <th>Object_name</th>
                                        <th>Options</th>
                                        <th>Cardinality</th>
                                        <th>Cost</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
<?php
$js_plan = json_encode($plan);
echo "<script> var plan = ". $js_plan . "; </script>";
?>
