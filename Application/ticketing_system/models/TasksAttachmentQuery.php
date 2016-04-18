<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tasksattachment]].
 *
 * @see Tasksattachment
 */
class TasksattachmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Tasksattachment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tasksattachment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}