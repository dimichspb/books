<?php

namespace app\controllers;

/**
 * Class ReaderController
 * @package app\controllers
 */
class ReaderController extends ApiController
{
    /**
     * Renders list of all Readers
     * 
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = $this->getIndex('api/readers', 'app\models\Reader');

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Renders details of particular Reader with his ratings
     * 
     * @param $id
     * @return string
     */
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