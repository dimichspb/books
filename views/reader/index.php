<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\Reader;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = 'Readers';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-xs-12">
                <h1>Readers listing: </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'User_ID',
                        'Location',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function($url, Reader $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['reader/view/' . $model->User_ID]);
                                }
                            ]
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
