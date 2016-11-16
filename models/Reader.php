<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bxusers".
 *
 * @property integer $User_ID
 * @property string $Location
 * @property integer $Age
 */
class Reader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bx_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['User_ID'], 'required'],
            [['User_ID', 'Age'], 'integer'],
            [['Location'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'User_ID' => 'User  ID',
            'Location' => 'Location',
            'Age' => 'Age',
        ];
    }
}
