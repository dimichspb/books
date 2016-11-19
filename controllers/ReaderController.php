<?php

namespace app\controllers;

class ReaderController extends ApiController
{
    public function actionIndex()
    {
        $dataProvider = $this->getIndex('api/readers', 'app\models\Reader');

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $model = $this->getOne('api/reader/' . $id, 'app\models\Reader');
        $dataProvider = $this->getIndex('api/ratings?User_ID=' . $id, 'app\models\Rating');

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}