<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 12.06.2016
 * Time: 18:19
 */
use yii\widgets\Breadcrumbs;
use yii\web\View;

$this->title = Yii::t('app', 'Статистика по SQL-запросам');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/testquery/basic/web/js/sql-stats.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/testquery/basic/web/css/sql-stats.css');
?>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

<div class="panel">
    <h2>SQL ORDERED BY ELAPSED_TIME</h2>
    <table id="sqlByElapsedTime" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ELAPSED_TIME</th>
            <th>EXECUTIONS</th>
            <th>CPU TIME</th>
            <th>DISK_READS</th>
            <th>SQL_ID</th>
            <th>MODULE</th>
            <th>SQL_FULLTEXT</th>
        </tr>
        </thead>
    </table>
</div>

<div class="panel">
    <h2>SQL ORDERED BY CPU_TIME</h2>
    <table id="sqlByCpuTime" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>CPU TIME</th>
            <th>EXECUTIONS</th>
            <th>ELAPSED_TIME</th>
            <th>DISK_READS</th>
            <th>SQL_ID</th>
            <th>MODULE</th>
            <th>SQL_FULLTEXT</th>
        </tr>
        </thead>
    </table>
</div>

<div class="panel">
    <h2>SQL ORDERED BY BUFFER_GETS</h2>
    <table id="sqlByBufferGets" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>BUFFER_GETS</th>
            <th>CPU TIME</th>
            <th>EXECUTIONS</th>
            <th>ELAPSED_TIME</th>
            <th>DISK_READS</th>
            <th>SQL_ID</th>
            <th>MODULE</th>
            <th>SQL_FULLTEXT</th>
        </tr>
        </thead>
    </table>
</div>

<div class="panel">
    <h2>SQL ORDERED BY DISK_READS</h2>
    <table id="sqlByDiskReads" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>DISK_READS</th>
            <th>CPU TIME</th>
            <th>EXECUTIONS</th>
            <th>ELAPSED_TIME</th>
            <th>SQL_ID</th>
            <th>MODULE</th>
            <th>SQL_FULLTEXT</th>
        </tr>
        </thead>
    </table>
</div>

<div class="panel">
    <h2>SQL ORDERED BY EXECUTIONS</h2>
    <table id="sqlByExecutions" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>EXECUTIONS</th>
            <th>ROWS_PROCESSED</th>
            <th>CPU TIME</th>
            <th>ELAPSED_TIME</th>
            <th>DISK_READS</th>
            <th>SQL_ID</th>
            <th>MODULE</th>
            <th>SQL_FULLTEXT</th>
        </tr>
        </thead>
    </table>
</div>

<div class="panel">
    <h2>SQL ORDERED BY PARSE_CALLS</h2>
    <table id="sqlByParseCalls" class="table table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>PARSE_CALLS</th>
            <th>EXECUTIONS</th>
            <th>SQL_ID</th>
            <th>MODULE</th>
            <th>SQL_FULLTEXT</th>
        </tr>
        </thead>
    </table>
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
                            <pre>
                                <code class="sql hljs">
                                    Информация недоступна!
                                </code>
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

