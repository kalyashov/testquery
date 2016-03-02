<?php

/* @var $this yii\web\View */

$this->title = 'Главная панель';

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

        <table id="query_table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>query</th>
                    <th>cost</th>
                </tr>
            </thead>
        </table>










