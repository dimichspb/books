<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\Book;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-xs-12">
                <h1>Books listing: </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'ISBN',
                        'Book_Title',
                        'Book_Author',
                        'Year_Of_Publication',
                        'Publisher',
                        [
                            'attribute' => 'Image_URL_S',
                            'value' => function (Book $model) {
                                return Html::img($model->Image_URL_S);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function($url, Book $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['book/view/' . $model->ISBN]);
                                }
                            ]
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
