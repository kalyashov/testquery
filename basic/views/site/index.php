<?php

/* @var $this yii\web\View */

$this->title = 'QueryTest';
use yii\bootstrap\Nav;
?>

    <div class="alert alert-info" role="alert">
        Текущее соединение:
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

    <div class="tabbable tabs-left">

        <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Все запросы</a></li>
            <li><a href="#tab2" data-toggle="tab">Получить план</a></li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane fade in active" id="tab1" style="padding: 20px">

                <table id="query_table" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>query</th>
                        <th>cost</th>
                    </tr>
                    </thead>

                </table>


            </div>

            <div class="tab-pane fade" id="tab2" style="padding: 20px">

                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Explain plan for</span>
                    <input type="text" class="form-control" placeholder="SQL" aria-describedby="basic-addon1">
                </div>

                <?php
                print "<table border='1'>\n";
                while ($row = oci_fetch_array($plan, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    print "<tr>\n";
                    foreach ($row as $item) {
                        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
                    }
                    print "</tr>\n";
                }
                print "</table>\n";

                ?>


            </div>
        </div>
    </div>

