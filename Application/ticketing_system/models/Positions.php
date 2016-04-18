<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "positions".
 *
 * @property integer $position_id
 * @property string $name
 * @property integer $level
 *
 * @property Users[] $users
 */
class Positions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'positions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'level'], 'required'],
            [['level'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => 'Position ID',
            'name' => 'Name',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['position_id' => 'position_id']);
    }

    /**
     * @inheritdoc
     * @return PositionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PositionsQuery(get_called_class());
    }
}
