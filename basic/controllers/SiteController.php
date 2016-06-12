<?php

namespace app\controllers;

use app\components\managers\QueryDataManager;
use app\models\RegForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\components\managers\OracleConnectionManager;
use app\components\managers\QueryManager;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();
            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $dbInfo = $qm->getDataBaseInfo();
            $dbSize = $qm->getDataBaseSize();
            $cpuUsed = $qm->getCpuUsed();

            return $this->render('dashboard',[
                'curConnection' => $currentConnection,
                'dbInfo' => QueryDataManager::QueryDataToArray($dbInfo),
                'dbSize' => QueryDataManager::QueryDataToArray($dbSize),
                'cpuUsed' => QueryDataManager::QueryDataToArray($cpuUsed),
            ]);
        }

        return $this->render('landing');
    }

    public function actionTuning()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();

            return $this->render('tuning',[
                'curConnection' => $currentConnection,
            ]);
        }
    }

    public function actionLong()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();

            $qm = QueryManager::getInstance(OracleConnectionManager::getConnection($currentConnection));
            $queris = $qm->getLongRunningQueries();

            $resArray['data'] = array();
            while ($row = oci_fetch_array($queris, OCI_ASSOC+OCI_RETURN_NULLS))
            {
                array_push($resArray['data'], $row);
            }

            foreach($resArray['data'] as &$row)
            {
                $row['SQL_FULLTEXT'] = $row['SQL_FULLTEXT']->read($row['SQL_FULLTEXT']->size());
            }
            unset($row);

            echo json_encode($resArray);
        }
    }



    public function actionReg()
    {
        $model = new RegForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()):
            if($user = $model->reg()):
                if($user->status === User::STATUS_ACTIVE):
                    if(Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                endif;
            else:
                Yii::$app->session->setFlash('error','Возникла ошибка при регистрации.');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            endif;
        endif;

        return $this->render(
            'reg',
            [
                'model' => $model
            ]
        );

    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSqlStats()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $currentConnection = ConnectionController::getSelectedConnection();

            return $this->render('sqlStats',[
                'curConnection' => $currentConnection,
            ]);
        }
    }
}
