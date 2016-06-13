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

    // TODO implement before action
    // to get instance of QueryManager
    // and check users rigths

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

    public function actionExecutionPlan($sql = null, $sql_id = null)
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();

            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $planData = $qm->getExecutionPlan($sql, $sql_id);

            $planFields = QueryDataManager::QueryDataToArray($planData['data']);
            $plan['data'] = $planFields['data'];
            $plan['src'] = $planData['src'];

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

    public function actionUserprocedures()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();
            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $userTables = $qm->getUserProcedures();

            echo QueryDataManager::QueryDataToJson($userTables);
        }
    }

    public function actionUserviews()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();
            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $userTables = $qm->getUserViews();

            echo QueryDataManager::QueryDataToJson($userTables);
        }
    }

    public function actionUsertriggers()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();
            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $userTables = $qm->getUserTriggers();

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

