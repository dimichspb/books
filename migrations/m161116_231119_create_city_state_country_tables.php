<?php

use yii\db\Migration;

class m161116_231119_create_city_state_country_tables extends Migration
{
    public function up()
    {
        $this->createTable('bx_city', [
            'City_ID' => $this->primaryKey(),
            'Name' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('bx_state', [
            'State_ID' => $this->primaryKey(),
            'Name' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('bx_country', [
            'Country_ID' => $this->primaryKey(),
            'Name' => $this->string()->notNull()->unique(),
        ]);
    }

    public function down()
    {
        $this->dropTable('bx_country');
        $this->dropTable('bx_state');
        $this->dropTable('bx_city');
    }
}
