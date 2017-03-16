<?php

namespace app\controllers;

use yii\data\ArrayDataProvider;
use yii\httpclient\Client;
use yii\web\Controller;
use yii;

/**
 * Class ApiController contains implementation of Books API access
 * 
 * @package app\controllers
 */
abstract class ApiController extends Controller
{
    /**
     * Get Index from API
     * 
     * @param $url
     * @param $modelClass
     * @return ArrayDataProvider
     */
    protected function getIndex($url, $modelClass)
    {
        if (!is_string($url) || !is_string($modelClass)) {
            throw new \BadMethodCallException('both parameters must be string');
        }

        if (!class_exists($modelClass)) {
            throw new \BadMethodCallException("Class $modelClass doesn't exist");
        }

        $client = new Client(['baseUrl' => 'http://books.dev']);
        $modelsResponse = $client->get($url)->send();

        $models = [];

        if ($modelsResponse->isOk) {
            foreach ($modelsResponse->data as $modelData) {
                $models[] = new $modelClass($modelData);
            }
        } else {
            Yii::$app->session->addFlash('warning', 'API Response: ' . $modelsResponse->toString());
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }

    /**
     * Get View from API
     * 
     * @param $url
     * @param $modelClass
     * @return mixed
     */
    protected function getOne($url, $modelClass)
    {
        if (!is_string($url) || !is_string($modelClass)) {
            throw new \BadMethodCallException('both parameters must be string');
        }

        if (!class_exists($modelClass)) {
            throw new \BadMethodCallException("Class $modelClass doesn't exist");
        }

        $client = new Client(['baseUrl' => 'http://books.dev']);
        $modelResponse = $client->get($url)->send();

        if ($modelResponse->isOk) {
            $model = new $modelClass($modelResponse->data);
        } else {
            Yii::$app->session->addFlash('warning', 'API Response: ' . $modelResponse->toString());
            $model = new $modelClass();
        }

        return $model;
    }
}