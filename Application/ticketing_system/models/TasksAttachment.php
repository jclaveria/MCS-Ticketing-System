<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks_attachment".
 *
 * @property integer $attachment_id
 * @property string $file_destination
 * @property string $file_extension
 * @property integer $tasks_id
 * @property string $created_date
 * @property integer $users_id
 *
 * @property Users $users
 * @property Tasks $tasks
 */
class TasksAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks_attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_destination', 'file_extension', 'tasks_id', 'users_id'], 'required'],
            [['tasks_id', 'users_id'], 'integer'],
            [['created_date'], 'safe'],
            [['file_destination'], 'string', 'max' => 1024],
            [['file_extension'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attachment_id' => 'Attachment ID',
            'file_destination' => 'File Destination',
            'file_extension' => 'File Extension',
            'tasks_id' => 'Tasks ID',
            'created_date' => 'Created Date',
            'users_id' => 'Users ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'users_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasOne(Tasks::className(), ['task_id' => 'tasks_id']);
    }

    /**
     * @inheritdoc
     * @return TasksAttachmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksAttachmentQuery(get_called_class());
    }
}
