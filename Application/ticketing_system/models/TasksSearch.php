<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tasks;

/**
 * TasksSearch represents the model behind the search form about `app\models\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'assignee', 'status_id', 'client_id', 'created_by', 'updated_by'], 'integer'],
            [['summary', 'description', 'start_date', 'scheduled_date', 'task_category', 'created_date', 'updated_date'], 'safe'],
            [['project_value'], 'number'],
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
        $query = Tasks::find();

        $query->with('taskOwner');

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
            'task_id' => $this->task_id,
            'assignee' => $this->assignee,
            'start_date' => $this->start_date,
            'scheduled_date' => $this->scheduled_date,
            'status_id' => $this->status_id,
            'client_id' => $this->client_id,
            'project_value' => $this->project_value,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'task_category', $this->task_category]);
            

        return $dataProvider;
    }
}
