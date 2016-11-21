<?php

use yii\db\Migration;

class m161121_064827_adding_foreign_keys extends Migration
{
    public function up()
    {
        $this->addForeignKey('bx_book_ratings_user_id', 'bx_book_ratings', 'User_ID', 'bx_users', 'User_ID', 'CASCADE', 'CASCADE');

        // TODO: Add foreign key ISBN for bx_book_ratings->bx_books

        //$this->db->createCommand("ALTER TABLE bx_books DROP PRIMARY KEY;")->execute();
        //$this->alterColumn('bx_books', 'ISBN', "VARCHAR(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");

        // $this->db->createCommand("");

        //$this->addPrimaryKey('pk_books_ISBN', 'bx_books', 'ISBN');


        //$this->addForeignKey('bx_book_ratings_ISBN', 'bx_book_ratings', 'ISBN', 'bx_books', 'ISBN', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('bx_books_ratings_user_id', 'bx_book_ratings');
    }

}
