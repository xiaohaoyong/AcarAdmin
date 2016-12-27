<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '路线';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加路线', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'price',
//            'bprice5',
//            'bprice7',
//            'bprice9',
             'saddr',
             'saddrname',
            // 'slat',
            // 'slng',
             'eaddr',
             'eaddrname',
            // 'elng',
            // 'elat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
