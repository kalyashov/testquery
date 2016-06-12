<?php

    /* @var $this yii\web\View */
    $this->title = 'Панель мониторинга';
    $this->registerJsFile('/testquery/basic/web/js/dashboard.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile('/testquery/basic/web/css/dashboard-css.css');
?>

<div class="panel db-info-panel">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 db-info">
            <h2> Информация о БД</h2>
            <div><span class="label label-success">1</span> <?= $dbInfo["data"]["1"]["PRODUCT"]?></div><hr>
            <div><span class="label label-success">2</span> <?= $dbInfo["data"]["1"]["VERSION"]?></div><hr>
            <div><span class="label label-info">3</span> <?= $dbInfo["data"]["2"]["PRODUCT"] . $dbInfo["data"]["2"]["VERSION"] ?></div><hr>
            <div><span class="label label-info">4</span> <?= $dbInfo["data"]["3"]["PRODUCT"] . $dbInfo["data"]["3"]["VERSION"] ?></div><hr>
            <div><span class="label label-default">5</span> <?= $dbInfo["data"]["1"]["STATUS"]  ?></div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 db-size-diagram text-center">
            <h2>Размер БД (мб)</h2>
            <div class="diagram-container">
                <canvas id="dbSize" width="140" height="140"></canvas>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 db-size-diagram text-center">
            <h2>Загрузка ЦП (%)</h2>
            <div class="diagram-container">
                <canvas id="cpuUsed" width="140" height="140"></canvas>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 connection-info">
            <h2> Текущее подключение</h2>

            <?php
                if($curConnection)
                {
                    echo
                        '<div><span class="label label-info">Пользователь:</span> '. '<span class="text-right">' . $curConnection->username . '</span></div><hr> ' .
                        '<div><span class="label label-info">Хост:</span> '. '<span class="text-right">' . $curConnection->host . '</span></div> <hr>' .
                        '<div><span class="label label-info">БД:</span> ' . '<span class="text-right">' . $curConnection->db_name . '</span></div> <hr> ';
                }
            else
            {
                echo 'Нет';
            }
            ?>
            <button type="button" class="btn btn-primary btn-xs">Сменить</button>
        </div>
        <div class=" hidden-xs hidden-sm col-md-1 col-lg-1"></div>
    </div>
</div>

<div class="section user-tables-panel">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h2>Таблицы пользователя  <?php if($curConnection) { echo $curConnection->username; } ?> </h2>
            <table id="user-tables-table" class="table table-bordered table-responsive table-condensed table-striped" width="100%">
                <thead>
                    <tr>
                        <td>TABLE_NAME</td>
                        <td>NUM_ROWS</td>
                        <td>AVG_SPACE</td>
                        <td>MAX_TRANS</td>
                        <td>TABLE_LOCK</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="section">
        <div class="row">
            <div class="col-md-6">
                <h2>Представления пользователя  <?php if($curConnection) { echo $curConnection->username; } ?> </h2>
                <table id="user-views-table" class="table table-bordered table-responsive table-striped" width="100%">
                    <thead>
                    <tr>
                        <td>VIEW_NAME</td>
                        <td>TEXT</td>
                        <td>TEXT_LENGTH</td>
                        <td>VIEW_TYPE</td>
                    </tr>
                    </thead>
                </table>
            </div>

            <div class="col-md-6">
                <h2>Процедуры пользователя  <?php if($curConnection) { echo $curConnection->username; } ?> </h2>
                <table id="user-procedures-table" class="table table-bordered table-responsive table-striped" width="100%">
                    <thead>
                    <tr>
                        <td>OBJECT_NAME</td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="section user-triggers-panel">
    <div class="row">
        <div class="col-md-6">
            <h2>Триггеры пользователя  <?php if($curConnection) { echo $curConnection->username; } ?> </h2>
            <table id="user-triggers-table" class="table table-bordered table-responsive table-striped" width="100%">
                <thead>
                    <tr>
                        <td>TRIGGER_NAME</td>
                        <td>TRIGGER_TYPE</td>
                        <td>TRIGGERING_EVENT</td>
                        <td>TABLE_NAME</td>
                        <td>COLUMN_NAME</td>
                        <td>TRIGGER_BODY</td>
                        <td>ACTION_TYPE</td>
                        <td>STATUS</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    var dbSize = JSON.parse('<?=json_encode($dbSize) ?>'),
        freeSpace = parseFloat(dbSize.data[0].Free).toFixed(2),
        usedSpace = parseFloat(dbSize.data[0].Used).toFixed(2);

    var cpuUsed = JSON.parse('<?=json_encode($cpuUsed) ?>'),
        used = parseFloat(cpuUsed.data[0].CPU).toFixed(2),
        other = 100 - used;

    var dbSizeData = [
        {
            value: usedSpace,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "Занято"
        },
        {
            value: freeSpace,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Свободно"
        }
    ];

    var cpuUsedData = {
        labels: ["",],
        datasets: [
            {
                label: "Загрузка",
                backgroundColor: "#8AC8BB",
                borderColor: "#6DBCCE",
                borderWidth: 1,
                hoverBackgroundColor: "#6DBCCE",
                hoverBorderColor: "#3897C8",
                data: [used, 100],
            }
        ]
    };

    var dbSizeData = {
        labels: [
            "Свободно",
            "Занято",
        ],
        datasets: [
            {
                data: [freeSpace, usedSpace],
                backgroundColor: [
                    "#36A2EB",
                    "#FF6384",
                ],
                hoverBackgroundColor: [
                    "#36A2EB",
                    "#FF6384",
                ]
            }]
    };

    window.onload = function(){
        var ctx = document.getElementById("dbSize").getContext("2d");
        var dbSizeDiagram = new Chart(ctx,{
            type: 'pie',
            data: dbSizeData,
        });

        var ctx2 = document.getElementById("cpuUsed").getContext("2d");

        var cpuUsedDiagram = new Chart(ctx2, {
            type: 'bar',
            data: cpuUsedData,
        });

    };


</script>










