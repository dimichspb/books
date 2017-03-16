<?php

namespace app\api\controllers;

use app\models\RatingSearch;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * Rating controller for the `api` module
 */
class RatingController extends ActiveController
{
    public $modelClass = 'app\models\Rating';


    /**
     * Controller behaviors description
     * 
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON; //setting JSON as default reply
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['index','view'],
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];

        return $behaviors;
    }

    /**
     * Change default controller's actions
     * 
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'getRatingsByQueryParams']; // replacing default DataProvider
        return $actions;
    }

    /**
     * Search Rating by params
     *
     * @param \yii\rest\Action $action
     * @return \yii\data\ActiveDataProvider
     */
    public static function getRatingsByQueryParams($action)
    {
        $params = [
            'RatingSearch' => Yii::$app->request->queryParams
        ];

        $searchModel = new RatingSearch();
        $dataProvider = $searchModel->search($params);

        return $dataProvider;
    }

}
