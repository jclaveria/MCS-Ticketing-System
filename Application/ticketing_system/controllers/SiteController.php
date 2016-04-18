<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Tasks;
use app\models\Users;
use app\models\AuditLogs;
use yii\helpers\Json;

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

		if(Yii::$app->user->isGuest){
			return $this->render('index');

		}else if( Yii::$app->user->identity->is_admin() ){

         $tasksOfUser = Tasks::find()
         ->all();

		 return $this->render('dashboard-admin', array('tasksOfUser' => $tasksOfUser, 'fullName' => Yii::$app->user->identity->getFullName()));

		}else{

        $tasksOfUser = Tasks::find()
         ->where(['assignee' => Yii::$app->user->id])
         ->all();

         return $this->render('dashboard', array('tasksOfUser' => $tasksOfUser, 'fullName' => Yii::$app->user->identity->getFullName()));

        }

		
		
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $audit = new AuditLogs();
            $audit->audit_action = "Logged in";
            $audit->audit_user = Yii::$app->user->id;
            $audit->save();
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        
        $audit = new AuditLogs();
        $audit->audit_action = "Logged out";
        $audit->audit_user = Yii::$app->user->id;
        $audit->save();
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    /*MCS Dashboard methods*/
    
    public function actionDashboard(){
		
        $tasksOfUser = Tasks::find()
        ->where(['assignee' => Yii::$app->user->id])
        ->all();

		if( Yii::$app->user->identity->is_admin() ){
			return $this->render('dashboard-admin', array('tasksOfUser' => $tasksOfUser));
		}


		
		
		
	}

    public function actionLoginmobile($username, $password)
    {   
        $resp = array('message' => 'error', 'data' => 'Invalid Username or Password');
        
        if (Users::checkLogin($username, $password)) {
            $identity = Users::findOne(['username' => $username, 'password' => $password]);
            
            //query check for doctor or patient
            
            if($identity){
                $resp = array('message' => 'success', 'data' => $identity);
            }else{
                 $resp = array('message' => 'fail', 'data' => false);
            }

        }
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Authorization");

        echo Json::encode($resp);
        Yii::$app->end();      
    }
    
    
}
