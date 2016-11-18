<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bx_user_location".
 *
 * @property integer $User_ID
 * @property integer $City_ID
 * @property integer $State_ID
 * @property integer $Country_ID
 *
 * @property City $city
 * @property Country $country
 * @property State $state
 * @property Reader $reader
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bx_user_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['City_ID', 'State_ID', 'Country_ID'], 'integer'],
            [['City_ID'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['City_ID' => 'City_ID']],
            [['Country_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['Country_ID' => 'Country_ID']],
            [['State_ID'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['State_ID' => 'State_ID']],
            [['User_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Reader::className(), 'targetAttribute' => ['User_ID' => 'User_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'User_ID' => 'User  ID',
            'City_ID' => 'City  ID',
            'State_ID' => 'State  ID',
            'Country_ID' => 'Country  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['City_ID' => 'City_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['Country_ID' => 'Country_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['State_ID' => 'State_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReader()
    {
        return $this->hasOne(Reader::className(), ['User_ID' => 'User_ID']);
    }
}
