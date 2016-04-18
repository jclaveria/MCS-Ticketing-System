<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tasksattachment;

/**
 * TasksattachmentSearch represents the model behind the search form about `app\models\Tasksattachment`.
 */
class TasksattachmentSearch extends Tasksattachment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attachment_id', 'tasks_id', 'users_id'], 'integer'],
            [['file_destination', 'file_extension', 'created_date'], 'safe'],
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
        $query = Tasksattachment::find();

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
            'attachment_id' => $this->attachment_id,
            'tasks_id' => $this->tasks_id,
            'created_date' => $this->created_date,
            'users_id' => $this->users_id,
        ]);

        $query->andFilterWhere(['like', 'file_destination', $this->file_destination])
            ->andFilterWhere(['like', 'file_extension', $this->file_extension]);

        return $dataProvider;
    }
}
