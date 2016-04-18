<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "audit_logs".
 *
 * @property integer $log_id
 * @property string $audit_action
 * @property integer $audit_task
 * @property integer $audit_user
 * @property string $created_date
 *
 * @property Tasks $auditTask
 * @property Users $auditUser
 */
class AuditLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audit_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audit_action', 'audit_user'], 'required'],
            [['audit_task', 'audit_user'], 'integer'],
            [['created_date'], 'safe'],
            [['audit_action'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'audit_action' => 'Audit Action',
            'audit_task' => 'Audit Task',
            'audit_user' => 'Audit User',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditTask()
    {
        return $this->hasOne(Tasks::className(), ['task_id' => 'audit_task']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'audit_user']);
    }

    /**
     * @inheritdoc
     * @return AuditLogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuditLogsQuery(get_called_class());
    }
}
