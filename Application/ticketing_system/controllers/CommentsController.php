<?php

namespace app\controllers;

use Yii;
use app\models\Comments;
use app\models\Tasks;
use app\models\AuditLogs;
use app\models\CommentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * CommentsController implements the CRUD actions for Comments model.
 */
class CommentsController extends Controller
{
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
     * Lists all Comments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comments model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        $audit = new AuditLogs();
        $audit->audit_action = "Added comment: " + $commentText;
        $audit->audit_task = $model->task_id;
        $audit->audit_user = Yii::$app->user->id;
        $audit->save();

            return $this->redirect(['view', 'id' => $model->comment_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Comments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->comment_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Comments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionRemotecomment()
    {
		$request = Yii::$app->request;
		$commentText = $request->post('comment');

        $uid = 0;
        $prep = "";

        if( $request->post('is_mobile_src') ){
            $uid = $request->post('user_id');
            $prep = "in mobile: ";
        }else{
            $uid = Yii::$app->user->id;
        }
		
		$comment = new Comments();
		$comment->user_id = $uid;
		$comment->text = ( $commentText );
		$comment->task_id = ( $request->post('task_id') );
            		
		$comment->save();
	
        $audit = new AuditLogs();
        $audit->audit_action = "Added comment " . $prep . $commentText;
        $audit->audit_task = $request->post('task_id');
        $audit->audit_user = $uid;
        $audit->save();


        if( $request->post('is_mobile_src') ){
            $url = Url::to(['tasks/viewmobile', 'user_id' => $request->post('user_id') , 'id' => $request->post('task_id')]);
        }else{
            $url = Url::to(['tasks/view','user_id' => $request->post('user_id') , 'id' => $request->post('task_id')]);
        }
		
		
		return $this->redirect( $url );
    }
    
    public function beforeAction($action) {
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}
}