<?php

    /* @var $this yii\web\View */
    $this->title = 'Панель мониторинга';

   // $this->registerJsFile('/testquery/basic/web/js/dashboard.js');
    $this->registerCssFile('/testquery/basic/web/css/dashboard-styles.css');
?>

<div class="panel db-info-panel">
    <div class="row">
        <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 db-info text-center">
            <h3 class="title"><i class="fa fa-database"></i> Информация о БД</h3>
            <div>Oracle Database 11g Express Edition Release 11.2.0.2.0</div>
            <div>PL/SQL Release 11.2.0.2.0</div>
            <div>CORE 11.2.0.2.0 Production</div>
            <div>TNS for 32-bit Windows: Version 11.2.0.2.0</div>
            <div>64 bit</div>

        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 db-size-diagram text-center">
            <h3>Размер БД (мб)</h3>
            <div class="diagram-container">
                <canvas id="dbSize" width="150" height="150"></canvas>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 connection-info text-center">
            <h3 class="title"><i class="fa fa-compress"></i> Текущее подключение</h3>

            <?php
                if($curConnection)
                {
                    echo
                        '<div>Пользователь: '. $curConnection->username . '</div> ' .
                        '<div>Хост: '. $curConnection->host . '</div>' .
                        '<div>БД: ' . $curConnection->db_name . '</div>';
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

<div class="panel user-tables-panel">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3>Таблицы пользователя  <?php if($curConnection) { echo $curConnection->username; } ?> </h3>
            <table id="user-tables-table" class="table table-bordered table-responsive table-condensed table-striped">
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

<div class="panel user-views-panel">
    <div class="row">
        <div class="col-md-6">
            <h3>Представления</h3>
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                <tr>
                    <td>Имя</td>
                    <td>Размер (мб)</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="panel user-views-panel">
    <div class="row">
        <div class="col-md-6">
            <h3>Функции</h3>
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                <tr>
                    <td>Имя</td>
                    <td>Размер (мб)</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="panel user-views-panel">
    <div class="row">
        <div class="col-md-6">
            <h3>Процедуры</h3>
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                <tr>
                    <td>Имя</td>
                    <td>Размер (мб)</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    var doughnutData = [
        {
            value: 1534.7,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "Занято"
        },
        {
            value: 122,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Свободно"
        }
    ];

    window.onload = function(){
        var ctx = document.getElementById("dbSize").getContext("2d");
        window.myDoughnut = new Chart(ctx).Pie(doughnutData, {responsive : true});
    };
</script>










