<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rating;

/**
 * RatingSearch represents the model behind the search form about `app\models\Rating`.
 * 
 * @var $County_Name string
 */
class RatingSearch extends Rating
{
    public $Country_Name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['User_ID', 'Book_Rating'], 'integer'],
            [['Country_Name'], 'string'],
            [['ISBN'], 'safe'],
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
        $query = Rating::find();
        $query->joinWith('country');
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bx_book_ratings.User_ID' => $this->User_ID,
            'bx_book_ratings.ISBN' => $this->ISBN,
        ]);

        $query->andFilterWhere(['like', 'bx_country.Name', $this->Country_Name]);

        return $dataProvider;
    }
}
