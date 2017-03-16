<?php

use yii\db\Migration;

class m161121_064827_adding_foreign_keys extends Migration
{
    public function up()
    {
        $statement =
<<<SQL
CREATE TABLE IF NOT EXISTS bx_books_new LIKE bx_books;
ALTER TABLE bx_books_new ADD PRIMARY KEY (ISBN);
INSERT IGNORE INTO bx_books_new SELECT * FROM bx_books;
DROP TABLE bx_books;
RENAME TABLE bx_books_new TO bx_books;
SQL;
        $this->db->createCommand($statement)->execute();

        $statement =
<<<SQL
DROP TABLE IF EXISTS bx_books_new;
SQL;
        $this->db->createCommand($statement)->execute();

        $statement =
<<<SQL
DELETE bx_book_ratings FROM bx_book_ratings
  LEFT JOIN bx_books ON bx_books.ISBN = bx_book_ratings.ISBN
      WHERE bx_books.Book_Title IS NULL;
SQL;

        $transaction = $this->db->beginTransaction();
        try {
            $this->db->createCommand($statement)->execute();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        //$this->addForeignKey('bx_book_ratings_user_id', 'bx_book_ratings', 'User_ID', 'bx_users', 'User_ID', 'CASCADE', 'CASCADE');
        $this->addForeignKey('bx_book_ratings_ISBN', 'bx_book_ratings', 'ISBN', 'bx_books', 'ISBN', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('bx_book_ratings_user_id', 'bx_book_ratings');
        $this->dropForeignKey('bx_book_ratings_ISBN', 'bx_book_ratings');
    }

}
