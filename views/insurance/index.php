<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InsuranceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '车险报价';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insurance-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'userid',
                'value' => function($data)
                {
                    $Users=\app\models\Users::findOne($data->userid);
                    return $Users->name;
                }
            ],
            [                      // the owner name of the model
                'attribute' => 'level',
                'value' => function($data)
                {
                    return \app\models\Insurance::$leveltext[$data->level];
                }
            ],
            [
                'attribute' => 'addtime',
                'format' => ['date', 'php:Y-m-d']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
