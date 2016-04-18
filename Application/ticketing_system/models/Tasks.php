<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $task_id
 * @property string $summary
 * @property string $description
 * @property integer $assignee
 * @property integer $task_owner
 * @property string $start_date
 * @property string $scheduled_date
 * @property string $task_category
 * @property integer $status_id
 * @property integer $client_id
 * @property string $project_value
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property AuditLogs[] $auditLogs
 * @property Comments[] $comments
 * @property Users $taskOwner
 * @property Clients $client
 * @property Status $status
 * @property Users $assignee0
 * @property TasksAttachment[] $tasksAttachments
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['summary', 'description', 'assignee', 'status_id', 'client_id', 'created_by'], 'required'],
            [['assignee', 'task_owner', 'status_id', 'client_id', 'created_by', 'updated_by'], 'integer'],
            [['start_date', 'scheduled_date', 'created_date', 'updated_date'], 'safe'],
            [['project_value'], 'number'],
            [['summary', 'task_category'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 2500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'summary' => 'Summary',
            'description' => 'Description',
            'assignee' => 'Assignee',
            'task_owner' => 'Task Owner',
            'start_date' => 'Start Date',
            'scheduled_date' => 'Scheduled Date',
            'task_category' => 'Task Category',
            'status_id' => 'Status ID',
            'client_id' => 'Client ID',
            'project_value' => 'Project Value',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditLogs()
    {
        return $this->hasMany(AuditLogs::className(), ['audit_task' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskOwner()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'task_owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'task_owner']);
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['client_id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignee0()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'assignee']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksAttachments()
    {
        return $this->hasMany(TasksAttachment::className(), ['tasks_id' => 'task_id']);
    }

    /**
     * @inheritdoc
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksQuery(get_called_class());
    }
}
