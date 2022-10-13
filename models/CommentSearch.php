<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comment;

/**
 * CommentSearch represents the model behind the search form of `app\models\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * @var mixed|null
     */
    public $start_date;
    /**
     * @var mixed|null
     */
    public $end_date;


    /**
     * {@inheritdoc}
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
        $query = Comment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!empty($this->created_at)) {
            [$this->start_date, $this->end_date] = array_map(function($item) {
                return strtotime($item);
            }, explode(' - ', $this->created_at));
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'subject_id' => $this->subject_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['between', 'created_at', $this->start_date, $this->end_date]);

        return $dataProvider;
    }

    /**
     * @return array
     */
    public function rules(): array {
        return [
            [['subject', 'subject_id', 'created_at', 'username', 'status'], 'safe'],
        ];
    }
}
