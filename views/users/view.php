<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">
    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'wenickname',
            'phone',
            'openid',
            [                      // the owner name of the model
                'attribute' => 'type',
                'value' => function($data)
                {
                    return \app\models\Users::$typetext[$data->type];
                }
            ],
            [
                'attribute' => 'addtime',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [                      // the owner name of the model
                'attribute' => 'level',
                'value' => function($data)
                {
                    return \app\models\Users::$leveltext[$data->level];
                }
            ],
            [                      // the owner name of the model
                'attribute' => 'level',
                'value' => function($data)
                {
                    return \app\models\Users::$sextext[$data->level];
                }
            ],
            'idnum',
            'authKey',
            'accessToken',
            [
                'attribute' => 'idimg',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->idimg,['width' => 300]);
                }
            ]
        ],
    ]) ?>

</div>
