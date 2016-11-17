<?php

use yii\db\Migration;

class m161116_231439_create_location_table extends Migration
{
    public function up()
    {
        $this->db->createCommand('ALTER TABLE `bx_users` ENGINE=InnoDB;')->execute();
        $this->db->createCommand('ALTER TABLE `bx_books` ENGINE=InnoDB;')->execute();
        $this->db->createCommand('ALTER TABLE `bx_book_ratings` ENGINE=InnoDB;')->execute();

        $this->createTable('bx_user_location', [
            'User_ID' => $this->primaryKey(),
            'City_ID' => $this->integer(11),
            'State_ID' => $this->integer(11),
            'Country_ID' => $this->integer(11),
        ]);

        $this->addForeignKey('fk_user_location_user_id', 'bx_user_location', 'User_ID', 'bx_users', 'User_ID', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_location_city_id', 'bx_user_location', 'City_ID', 'bx_city', 'City_ID', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_user_location_state_id', 'bx_user_location', 'State_ID', 'bx_state', 'State_ID', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_user_location_country_id', 'bx_user_location', 'Country_ID', 'bx_country', 'Country_ID', 'RESTRICT', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('bx_user_location');

        $this->db->createCommand('ALTER TABLE `bx_users` ENGINE=MyISAM;')->execute();
        $this->db->createCommand('ALTER TABLE `bx_books` ENGINE=MyISAM;')->execute();
        $this->db->createCommand('ALTER TABLE `bx_book_ratings` ENGINE=MyISAM;')->execute();
    }
}
