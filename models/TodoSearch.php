<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * Class TodoSearch is a search model class for [[Todo]]
 */
class TodoSearch extends Todo
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title'], 'string'],
            [['priority'], 'integer'],
            [['done'], 'boolean'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Todo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'priority' => SORT_DESC,
                ],
            ],
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'priority' => $this->priority,
            'done' => $this->done,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
