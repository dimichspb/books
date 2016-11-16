<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bxbooks".
 *
 * @property string $ISBN
 * @property string $Book_Title
 * @property string $Book_Author
 * @property string $Year_Of_Publication
 * @property string $Publisher
 * @property string $Image_URL_S
 * @property string $Image_URL_M
 * @property string $Image_URL_L
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bx_books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ISBN'], 'required'],
            [['Year_Of_Publication'], 'integer'],
            [['ISBN'], 'string', 'max' => 13],
            [['Book_Title', 'Book_Author', 'Publisher', 'Image_URL_S', 'Image_URL_M', 'Image_URL_L'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ISBN' => 'Isbn',
            'Book_Title' => 'Book  Title',
            'Book_Author' => 'Book  Author',
            'Year_Of_Publication' => 'Year  Of  Publication',
            'Publisher' => 'Publisher',
            'Image_URL_S' => 'Image  Url  S',
            'Image_URL_M' => 'Image  Url  M',
            'Image_URL_L' => 'Image  Url  L',
        ];
    }
}
