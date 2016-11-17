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

    public function addLocation()
    {
        if (empty($this->Location)) {
            return false;
        }

        $locationItems = explode(',', $this->Location);

        if (isset($locationItems[0])) {
            $this->fillCity(trim($locationItems[0]));
        }

        if (isset($locationItems[1])) {
            $this->fillState(trim($locationItems[1]));
        }

        if (isset($locationItems[2])) {
            $this->fillCountry(trim($locationItems[2]));
        }

        return true;
    }

    private function fillCity($cityName)
    {
        $this->fillLocationItem('app\models\City', 'City_ID', $cityName);
    }

    private function fillState($stateName)
    {
        $this->fillLocationItem('app\models\State', 'State_ID', $stateName);
    }

    private function fillCountry($countryName)
    {
        $this->fillLocationItem('app\models\Country', 'Country_ID', $countryName);
    }

    private function fillLocationItem($modelClass, $attributeName, $name)
    {
        if (!class_exists($modelClass)) {
            throw new \BadMethodCallException("$modelClass class doesn't exist");
        }

        

        if (!$model = $modelClass::findOne(['Name' => $name])) {
            $model = new $modelClass();
            $model->Name = $name;
            $model->save();
        }
        $this->$attributeName = $model->$attributeName;
        $this->update(false, [$attributeName]);

    }
}
