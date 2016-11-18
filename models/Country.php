<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bx_country".
 *
 * @property integer $Country_ID
 * @property string $Name
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bx_country';
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
            'Country_ID' => 'Country  ID',
            'Name' => 'Name',
        ];
    }
}
