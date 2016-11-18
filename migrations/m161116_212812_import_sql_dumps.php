<?php

use yii\db\Migration;

class m161116_212812_import_sql_dumps extends Migration
{
    public function up()
    {
        $this->import('BX-Users.sql');
        $this->import('BX-Books.sql');
        $this->import('BX-Book-Ratings.sql');
    }

    public function down()
    {
        $this->dropTable('BX-Book-Ratings');
        $this->dropTable('BX-Books');
        $this->dropTable('BX-Users');
    }

    /**
     * Imports file to DB
     *
     * @param $filename
     * @throws BadMethodCallException if $filename is not a string or $filename doesn't exists
     */
    private function import($filename)
    {
        if (!is_string($filename)) {
            throw new BadMethodCallException('$filename must be a string');
        }

        $filePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($filePath)) {
            throw new BadMethodCallException("$filePath doesn't exist");
        }

        // reading file by separator ";" to save memory
        $fileHandle = fopen($filePath, "r");

        $query = '';
        while(!feof($fileHandle)) {
            $query .= fgets($fileHandle);

            if (substr(rtrim($query), -1) == ';') {
                $query = str_replace('TYPE=', 'ENGINE=', $query);
                $this->execute(utf8_encode($query));
                $query = '';
            }
        }

        fclose($fileHandle);
    }

}