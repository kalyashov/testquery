<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 02.03.2016
 * Time: 18:37
 */
?>
        <div class="alert alert-info" role="alert"> Текущее соединение:
            <strong>
                <?php
                if($curConnection)
                {
                    echo $curConnection->username . ' ' .
                        $curConnection->host . ' ' .
                        $curConnection->db_name;
                }
                else
                {
                    echo 'Нет';
                }
                ?>
            </strong>
            <button type="button" class="btn btn-default btn-xs">Сменить</button>
        </div>

        <div class="input-group plan-input">
            <span class="input-group-addon" id="basic-addon1">Explain plan for</span>
            <input id="query-input" type="text" class="form-control" placeholder="SQL" aria-describedby="basic-addon1">
            <span class="input-group-addon" id="basic-addon1">
                <button id="getQueryPlan" type="button" class="btn btn-default btn-xs">Получить</button>
            </span>
        </div>

        <table id="plan_table" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>operation</th>
                <th>object_name</th>
                <th>options</th>
                <th>cost</th>
            </tr>
            </thead>
        </table>

<?php
$js_plan = json_encode($plan);
echo "<script> var plan = ". $js_plan . "; </script>";
?>
