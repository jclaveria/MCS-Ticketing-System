<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuditLogs;

/**
 * AuditLogsSearch represents the model behind the search form about `app\models\AuditLogs`.
 */
class AuditLogsSearch extends AuditLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_id', 'audit_task', 'audit_user'], 'integer'],
            [['audit_action', 'created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AuditLogs::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'log_id' => $this->log_id,
            'audit_task' => $this->audit_task,
            'audit_user' => $this->audit_user,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'audit_action', $this->audit_action]);

        return $dataProvider;
    }
}
