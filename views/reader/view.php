<?php

use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\Book;

/* @var $this yii\web\View */
/* @var $model app\models\Reader */
/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = $model->User_ID;
$this->params['breadcrumbs'][] = ['label' => 'Readers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-xs-12">
                <h1>Reader: </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?= DetailView::widget([
                    'model' => $model,
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                ]); ?>
            </div>
        </div>
    </div>
</div>
