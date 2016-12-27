<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '司机资料';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'userid',
            'driver',
            'city',
            'plates',
            'owner',
            'cartime:datetime',

            // 'starttime',
            // 'addtime',
            // 'licenseimg',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
