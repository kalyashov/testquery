<?php
/**
 * Created by PhpStorm.
 * User: Grigory
 * Date: 12.06.2016
 * Time: 16:51
 */

namespace app\controllers;

use app\components\managers\OracleConnectionManager;
use app\components\managers\QueryManager;
use Yii;
use yii\web\Controller;
use app\components\managers\QueryDataManager;

/**
 * Class SqlStatsController
 * Выводит JSON запросов для получения статистики по SQL-запросам
 * @package app\controllers
 */
class SqlStatsController extends Controller
{
    private $queryManager;

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

    /**
     * В Yii2 по-умолчанию нельзя использовать CamelCase (SEO friendly URL),
     * функция переопределена, для того, чтобы в названиях действий можно
     * было использовать CamelCase
     * @param string $id
     * @return null|object|\yii\base\InlineAction
     * @throws \yii\base\InvalidConfigException
     */
    public function createAction($id)
    {
        if ($id === '') {
            $id = $this->defaultAction;
        }
        $actionMap = $this->actions();
        if (isset($actionMap[$id])) {
            return Yii::createObject($actionMap[$id], [$id, $this]);
        } elseif (preg_match('/^[a-zA-Z0-9\\-_]+$/', $id) && strpos($id, '--') === false && trim($id, '-') === $id) {
            $methodName = 'action' . str_replace(' ', '', ucwords(implode(' ', explode('-', $id))));
            if (method_exists($this, $methodName)) {
                $method = new \ReflectionMethod($this, $methodName);
                if ($method->isPublic() && $method->getName() === $methodName) {
                    return new \yii\base\InlineAction($id, $this, $methodName);
                }
            }
        }
        return null;
    }

    /**
     * Выполняется перед любым действием для получения экземпляра QueryManager
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $currentConnection = ConnectionController::getSelectedConnection();
        $this->queryManager = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));

        return parent::beforeAction($action);
    }

    public function actionSqlByElapsedTime()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $queryData = $this->queryManager->getQueriesByElapsedTime();
            echo QueryDataManager::QueryDataWithLobToJson($queryData, array('SQL_FULLTEXT'));
        }
    }

    public function actionSqlByCpuTime()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $queryData = $this->queryManager->getQueriesByCpuTime();
            echo QueryDataManager::QueryDataWithLobToJson($queryData, array('SQL_FULLTEXT'));
        }
    }

    public function actionSqlByBufferGets()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $queryData = $this->queryManager->getQueriesByBufferGets();
            echo QueryDataManager::QueryDataWithLobToJson($queryData, array('SQL_FULLTEXT'));
        }
    }

    public function actionSqlByDiskReads()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $queryData = $this->queryManager->getQueriesByDiskReads();
            echo QueryDataManager::QueryDataWithLobToJson($queryData, array('SQL_FULLTEXT'));
        }
    }

    public function actionSqlByExecutions()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $queryData = $this->queryManager->getQueriesByExecutions();
            echo QueryDataManager::QueryDataWithLobToJson($queryData, array('SQL_FULLTEXT'));
        }
    }

    public function actionSqlByParseCalls()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $queryData = $this->queryManager->getQueriesByParseCalls();
            echo QueryDataManager::QueryDataWithLobToJson($queryData, array('SQL_FULLTEXT'));
        }
    }
}