<?php

namespace app\controllers;

use Yii;
use app\models\Tasks;
use app\models\TasksSearch;
use app\models\UploadForm;
use app\models\Status;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;
use app\models\TasksAttachment;
use yii\helpers\Json;
use app\models\Users;
use app\models\AuditLogs;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
{
     public function beforeAction($action)
    {
           if (Yii::$app->user->isGuest){
                
                if( $action->id == 'viewmobile' ){ return true; }
                if( $action->id == 'fetch' ){ return true; }
                if( $action->id == 'upload' ){ return true; }
                if( $action->id == 'status' ){ return true; }
                $this->redirect( Url::to(['site/login']) );
           }

           return true;

           //something code right here if user valided
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewmobile($id)
    {
		
		$url = Url::to(['comments/remotecomment']);
		
        return $this->render('view-mobile', [
            'model' => $this->findModel($id),
            'postcomment' => $url
        ]);
    }


        /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $url = Url::to(['comments/remotecomment']);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'postcomment' => $url,
            'isAdmin' => Yii::$app->user->identity->is_admin()
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(  !Yii::$app->user->identity->is_admin() ){
            return 'You are not allowed to view this page';
        }

        $model = new Tasks();
        $model->created_date = date('Y-m-d H:i:s');
        $model->updated_date = date('Y-m-d H:i:s');
        $model->created_by = Yii::$app->user->id;
        $model->updated_by = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $audit = new AuditLogs();
            $audit->audit_action = "Created task";
            $audit->audit_task =$model->task_id;
            $audit->audit_user =Yii::$app->user->id;
            $audit->save();

            return $this->redirect(['view', 'id' => $model->task_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $model->updated_date = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        $audit = new AuditLogs();
        $audit->audit_action = "Updated task";
        $audit->audit_task =$model->task_id;
        $audit->audit_user =Yii::$app->user->id;
        $audit->save();

            return $this->redirect(['view', 'id' => $model->task_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(  !Yii::$app->user->identity->is_admin() ){
            return 'You are not allowed to perform this action';
        }

        $model = $this->findModel($id);
        
        /*$audit = new AuditLogs();
        $audit->audit_action = "Deleted task";
        $audit->audit_task =$model->task_id;
        $audit->audit_user =Yii::$app->user->id;
        $audit->save();

        $model->delete();*/

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionUpload()
    {
        $model = new UploadForm();
        $request = Yii::$app->request;
        $model->task_id = $request->get('task_id');

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                 $attachment = new TasksAttachment();
            
				$attachment->file_destination = ( $model->file->baseName );
				$attachment->file_extension = ( $model->file->extension );
				$attachment->users_id = ( Yii::$app->user->id);
				$attachment->tasks_id = ( $model->task_id );
				
				$attachment->save();

                $audit = new AuditLogs();
                $audit->audit_action = "Uploaded file ".$model->file->baseName;
                $audit->audit_task =$model->task_id;
                $audit->audit_user =Yii::$app->user->id;
                $audit->save();

                return $this->redirect( array('tasks/view','id'=>$model->task_id) );
            }
        }

        return $this->renderPartial('upload', ['model' => $model, 'task_id' => $request->get('task_id')]);
    }

    public function actionFetch(){
        
        $request = Yii::$app->request;
        $user_id = $request->get('user_id');

        $getTasks = (new \yii\db\Query())
            ->from('tasks t')
            ->leftJoin('status s', 't.status_id = s.status_id')
            ->where(['t.assignee' => $user_id])
            ->all();

        $resp = array('message' => 'success', 'data' => $getTasks);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Authorization");

        echo Json::encode($resp);
        Yii::$app->end();
        

    }

    public function actionStatus($task_id, $enum_id)
    {

        $status = Status::findOne($enum_id);

        $model = Tasks::findOne($task_id);
        $model->status_id = $enum_id;
        $model->save();

        $audit = new AuditLogs();
        $audit->audit_action = "Updated status in mobile";
        $audit->audit_task =$model->task_id;
        $audit->audit_user =Yii::$app->user->id;
        $audit->save();

        $resp = array('message' => 'success', 'data' => $model);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Authorization");

        echo Json::encode($resp);
        Yii::$app->end();
    }
}
