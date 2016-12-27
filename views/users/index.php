<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'phone',
            //'openid',
            'type',
            'addtime',
             'level',
            // 'sex',
            // 'idnum',
            // 'idimg',
            // 'authKey',
            // 'accessToken',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
