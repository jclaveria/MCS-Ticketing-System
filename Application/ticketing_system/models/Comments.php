<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $comment_id
 * @property integer $user_id
 * @property string $text
 * @property string $created_date
 * @property integer $task_id
 *
 * @property Tasks $task
 * @property Users $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id'], 'required'],
            [['user_id', 'task_id'], 'integer'],
            [['created_date'], 'safe'],
            [['text'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'created_date' => 'Created Date',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskfk()
    {
        return $this->hasOne(Tasks::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserfk()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }
}
