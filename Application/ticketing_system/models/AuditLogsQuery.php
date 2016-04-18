<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AuditLogs]].
 *
 * @see AuditLogs
 */
class AuditLogsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return AuditLogs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AuditLogs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}