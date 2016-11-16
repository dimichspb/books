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

    public function getReader()
    {
        return $this->hasOne(Reader::className(), ['User_ID' => 'User_ID']);
    }

    public function getBook()
    {
        return $this->hasOne(Book::className(), ['ISBN' => 'ISBN']);
    }

    public static function getRatingsByCountry()
    {
        $country = Yii::$app->request->get('country');

        return self::find()->joinWith('reader');
    }
}
