<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Clients]].
 *
 * @see Clients
 */
class ClientsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Clients[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Clients|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}