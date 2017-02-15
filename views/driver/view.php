<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$userid=\Yii::$app->request->get('id',0);
$Users=\app\models\Users::findOne($userid);
$this->title = $Users->name;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-view">


    <p>
        <?= Html::a('修改', ['update', 'id' => $model->userid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->userid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'userid',
                'value' => function($data)
                {
                    $Users=\app\models\Users::findOne($data->userid);
                    return $Users->name;
                }
            ],
            [
                'attribute'=>"userphone",
                'value' => function($data)
                {
                    $Users=\app\models\Users::findOne($data->userid);
                    return $Users->phone;
                }
            ],
            [
                'attribute' => 'addtime',
                'value' => function($data)
                {
                    $route=\app\models\City::findOne($data->city);
                    return $route->city;
                }
            ],
            'plates',
            'owner',
            [
                'attribute' => 'addtime',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute' => 'starttime',
                'format' => ['date', 'php:Y-m-d']
            ],
            'Bnumber',
            'Baccount',
            [
                'attribute' => 'licenseimg',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->licenseimg,['width' => 300]);
                }
            ],
            [
                'attribute' => 'licenseimgb',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->licenseimgb,['width' => 300]);
                }
            ],
            [
                'attribute' => 'idimg',
                'format' => 'raw',

                'value' => function($data)
                {
                    $user=\app\models\Users::findOne($data->userid);
                    return Html::img(ACAR_IMGURL.$user->idimg,['width' => 300]);
                }
            ],
            [
                'attribute' => 'idimgb',
                'format' => 'raw',

                'value' => function($data)
                {
                    $user=\app\models\Users::findOne($data->userid);
                    return Html::img(ACAR_IMGURL.$user->idimgb,['width' => 300]);
                }
            ],
        ],
    ]) ?>

</div>
