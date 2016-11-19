<?php

namespace app\controllers;

use app\models\Book;

/**
 * Class BookController
 * @package app\controllers
 */
class BookController extends ApiController
{
    /**
     * Renders the list of Books
     * 
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = $this->getIndex('api/books', 'app\models\Book');

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Renders details of particular Book with its Ratings
     * 
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->getOne('api/book/' . $id, 'app\models\Book');
        $dataProvider = $this->getIndex('api/ratings?ISBN=' . $id, 'app\models\Rating');

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}