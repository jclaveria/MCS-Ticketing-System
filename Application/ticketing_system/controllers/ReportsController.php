<?php
namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\Tasks;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ReportsController extends \yii\web\Controller
{
    public function actionIndex($startdate, $enddate, $type)
    {

        if(  !Yii::$app->user->identity->is_admin() ){
            return 'You are not allowed to view this page';
        }

        $this->layout = false;
        
            
            $usertasks = Users::find()
            ->select('*')
            ->all();
            
        if($type == "export"){
            
                header("Pragma: no-cache"); // required
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private", false); // required for certain browsers
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment; filename=\"taskreport-".$startdate."_".$enddate.".doc");
                header("Content-Transfer-Encoding: binary");

        }
                
        return $this->render('index', [
            'usertasks' => $usertasks
        ]);
    }

    public function actionTasklog($task_id, $type)
    {

        if(  !Yii::$app->user->identity->is_admin() ){
            return 'You are not allowed to view this page';
        }

        $this->layout = false;
        
            
        $task = Tasks::findOne(['task_id' => $task_id]);
            
        if($type == "export"){
            
                header("Pragma: no-cache"); // required
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private", false); // required for certain browsers
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment; filename=\"taskreport-".$task->task_id.".doc");
                header("Content-Transfer-Encoding: binary");

        }
                
        return $this->render('tasklog', [
            'task' => $task
        ]);
    }

}
