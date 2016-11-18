<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bx_state".
 *
 * @property integer $State_ID
 * @property string $Name
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bx_state';
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
            'State_ID' => 'State  ID',
            'Name' => 'Name',
        ];
    }
}
