<?php

use yii\db\Migration;
use app\models\Reader;

class m161116_231919_filling_city_state_country_columns extends Migration
{
    public function up()
    {
        /** @var Reader[] $readers */
        $readers = Reader::find()->all();

        foreach ($readers as $reader) {
            $reader->addLocation();
        }
    }

    public function down()
    {
        return true;
    }
    
}
