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
            </div>
        </div>
    </div>
