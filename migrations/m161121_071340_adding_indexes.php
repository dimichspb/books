<?php

use yii\db\Migration;

class m161121_071340_adding_indexes extends Migration
{
    public function up()
    {
        $this->createIndex('idx_city_name', 'bx_city', 'name');
        $this->createIndex('idx_state_name', 'bx_state', 'name');
        $this->createIndex('idx_country_name', 'bx_country', 'name');
    }

    public function down()
    {
        $this->dropIndex('idx_city_name', 'bx_city');
        $this->dropIndex('idx_state_name', 'bx_state');
        $this->dropIndex('idx_country_name', 'bx_country');
    }
}
