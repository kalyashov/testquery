<?php

namespace app\controllers;

use app\components\managers\OracleConnectionManager;
use app\components\managers\QueryManager;
use Yii;
use yii\web\Controller;
use app\components\managers\QueryDataManager;

class QueryController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionPlantablejson($q)
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();

            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $plan = $qm->getPlanTableFor($q);

            echo json_encode($plan);
        }
    }

    public function actionLongrunningqueries()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();

            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $queris = $qm->getLongRunningQueries();

            echo json_encode($queris);
        }
    }

    public function actionUsertables()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();
            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $userTables = $qm->getUserTables();

            echo QueryDataManager::QueryDataToJson($userTables);
        }
    }

    public function actionDbinfo()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();
            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $dbInfo = $qm->getDataBaseInfo();

            echo QueryDataManager::QueryDataToJson($dbInfo);
        }
    }
}

