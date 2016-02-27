<?php

/* @var $this yii\web\View */

$this->title = 'QueryTest';
?>


    <div class="site-index">
        <div class="body-content">
            <div class="row">
                <p>Текущее соединение:
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
                </p>

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
        </div>
    </div>


