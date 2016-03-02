<?php

namespace app\controllers;

use app\components\managers\ConnectionManager;
use app\components\managers\QueryManager;
use Yii;
use yii\web\Controller;


class QueryController extends Controller
{
    public function actionPlantablejson($q)
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();

            $qm = QueryManager::getInstance(ConnectionManager::getConnection($currentConnection));
            $plan = $qm->getPlanTableFor($q);

            echo json_encode($plan);
        }
    }
}

