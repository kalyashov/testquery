<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 02.03.2016
 * Time: 18:37
 */
?>
    <div class="panel user-queries">
        <h3>Sql-запросы</h3>
        <table id="query-table" class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>sql</th>
                <th>cost</th>
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
<?php
$js_plan = json_encode($plan);
echo "<script> var plan = ". $js_plan . "; </script>";
?>
