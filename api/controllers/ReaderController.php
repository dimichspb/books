<?php

namespace app\api\controllers;

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
 * Reader controller for the `api` module
 */
class ReaderController extends ActiveController
{
    public $modelClass = 'app\models\Reader';


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
}
