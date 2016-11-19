<?php

namespace app\controllers;

use yii\data\ArrayDataProvider;
use yii\httpclient\Client;
use yii\web\Controller;

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
     * @param $model
     * @return ArrayDataProvider
     */
    protected function getIndex($url, $model)
    {
        if (!is_string($url) || !is_string($model)) {
            throw new \BadMethodCallException('both parameters must be string');
        }

        if (!class_exists($model)) {
            throw new \BadMethodCallException("Class $model doesn't exist");
        }

        $client = new Client(['baseUrl' => 'http://books.dev']);
        $modelsResponse = $client->get($url)->send();

        $models = [];

        if ($modelsResponse->isOk) {
            foreach ($modelsResponse->data as $modelData) {
                $models[] = new $model($modelData);
            }
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
     * @param $model
     * @return mixed
     */
    protected function getOne($url, $model)
    {
        if (!is_string($url) || !is_string($model)) {
            throw new \BadMethodCallException('both parameters must be string');
        }

        if (!class_exists($model)) {
            throw new \BadMethodCallException("Class $model doesn't exist");
        }

        $client = new Client(['baseUrl' => 'http://books.dev']);
        $modelResponse = $client->get($url)->send();
        return new $model($modelResponse->data);
    }
}