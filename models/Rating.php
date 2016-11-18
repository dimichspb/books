<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bxbookratings".
 *
 * @property integer $User_ID
 * @property string $ISBN
 * @property integer $Book_Rating
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bx_book_ratings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['User_ID', 'ISBN'], 'required'],
            [['User_ID', 'Book_Rating'], 'integer'],
            [['ISBN'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'User_ID' => 'User  ID',
            'ISBN' => 'Isbn',
            'Book_Rating' => 'Book  Rating',
        ];
    }
    
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['User_ID' => 'User_ID'])->via('reader');
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['City_ID' => 'City_ID'])->via('location');
    }

    public function getState()
    {
        return $this->hasOne(State::className(), ['State_ID' => 'State_ID'])->via('location');
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['Country_ID' => 'Country_ID'])->via('location');
    }

    public function getReader()
    {
        return $this->hasOne(Reader::className(), ['User_ID' => 'User_ID']);
    }

    public function getBook()
    {
        return $this->hasOne(Book::className(), ['ISBN' => 'ISBN']);
    }

    public static function getRatingsByParams()
    {
        $params = [
            'RatingSearch' => Yii::$app->request->queryParams
        ];

        $searchModel = new RatingSearch();
        $dataProvider = $searchModel->search($params);
        
        return $dataProvider;
    }
}
