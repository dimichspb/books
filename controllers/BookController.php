<?php

namespace app\controllers;

use app\models\Book;

class BookController extends ApiController
{
    public function actionIndex()
    {
        $dataProvider = $this->getIndex('api/books', 'app\models\Book');

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

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