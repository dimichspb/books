<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

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

    /**
     * Returns Location of the Rating's Reader
     *
     * @return ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['User_ID' => 'User_ID'])->via('reader');
    }

    /**
     * Returns City of the Reader's Location
     *
     * @return ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['City_ID' => 'City_ID'])->via('location');
    }

    /**
     * Returns State of the Reader's Location
     *
     * @return ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['State_ID' => 'State_ID'])->via('location');
    }

    /**
     * Returns Country of the Reader's Location
     *
     * @return ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['Country_ID' => 'Country_ID'])->via('location');
    }

    /**
     * Returns Reader of this Rating
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReader()
    {
        return $this->hasOne(Reader::className(), ['User_ID' => 'User_ID']);
    }

    /**
     * Returns Book of this Rating
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['ISBN' => 'ISBN']);
    }
}
