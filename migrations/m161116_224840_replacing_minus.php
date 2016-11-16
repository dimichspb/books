<?php

use yii\db\Migration;

class m161116_224840_replacing_minus extends Migration
{
    public function up()
    {
        $this->renameTable('bx-users', 'bx_users');
        $this->renameTable('bx-books', 'bx_books');
        $this->renameTable('bx-book-ratings', 'bx_book_ratings');

        $this->renameColumn('bx_users', 'User-ID', 'User_ID');

        $this->renameColumn('bx_books', 'Book-Title', 'Book_Title');
        $this->renameColumn('bx_books', 'Book-Author', 'Book_Author');
        $this->renameColumn('bx_books', 'Year-Of-Publication', 'Year_Of_Publication');
        $this->renameColumn('bx_books', 'Image-URL-S', 'Image_URL_S');
        $this->renameColumn('bx_books', 'Image-URL-M', 'Image_URL_M');
        $this->renameColumn('bx_books', 'Image-URL-L', 'Image_URL_L');

        $this->renameColumn('bx_book_ratings', 'User-ID', 'User_ID');
        $this->renameColumn('bx_book_ratings', 'Book-Rating', 'Book_Rating');
    }

    public function down()
    {
        $this->renameTable('bx_users', 'bx-users');
        $this->renameTable('bx_books', 'bx-books');
        $this->renameTable('bx_book_ratings', 'bx-book-ratings');

        $this->renameColumn('bx-users', 'User_ID', 'User-ID');

        $this->renameColumn('bx-books', 'Book_Title', 'Book-Title');
        $this->renameColumn('bx-books', 'Book_Author', 'Book-Author');
        $this->renameColumn('bx-books', 'Year_Of_Publication', 'Year-Of-Publication');
        $this->renameColumn('bx-books', 'Image_URL_S', 'Image-URL-S');
        $this->renameColumn('bx-books', 'Image_URL_M', 'Image-URL-M');
        $this->renameColumn('bx-books', 'Image_URL_L', 'Image-URL-L');

        $this->renameColumn('bx-book-ratings', 'User_ID', 'User-ID');
        $this->renameColumn('bx-book-ratings', 'Book_Rating', 'Book-Rating');
    }

}
