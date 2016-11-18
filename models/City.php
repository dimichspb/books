<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bx_city".
 *
 * @property integer $City_ID
 * @property string $Name
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bx_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name'], 'unique'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'City_ID' => 'City  ID',
            'Name' => 'Name',
        ];
    }
}
