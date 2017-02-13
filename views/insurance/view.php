<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Insurance */

$this->title ="车险报价";
$this->params['breadcrumbs'][] = ['label' => 'Insurances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insurance-view">
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
            'phone',
            'offer',
            [
                'attribute' => 'addtime',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute' => 'starttime',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute' => 'wufa',
                'value' => function($data)
                {
                    return $data->wufa?"已选":"未选";
                }
            ],
            [
                'attribute' => 'lossdanger',
                'value' => function($data)
                {
                    return $data->islossdanger?"不计免赔":"未选";
                }
            ],
            [
                'attribute' => 'liability',
                'value' => function($data)
                {
                    $str=$data->isliability?"已选":"未选";
                    $str.="|".\app\models\Insurance::$liability[$data->liability];
                    return $str;
                }
            ],
            [
                'attribute' => 'daoqiang',
                'value' => function($data)
                {
                    return $data->isdaoqiang?"已选":"未选";
                }
            ],
            [
                'attribute' => 'dseat',
                'value' => function($data)
                {
                    $str=$data->isdseat?"已选":"未选";
                    $str.="|".\app\models\Insurance::$dseat[$data->dseat];
                    return $str;
                }
            ],
            [
                'attribute' => 'cseat',
                'value' => function($data)
                {
                    $str=$data->iscseat?"已选":"未选";
                    $str.="|".\app\models\Insurance::$dseat[$data->cseat];
                    return $str;
                }
            ],
            [
                'attribute' => 'boli',
                'value' => function($data)
                {
                    return \app\models\Insurance::$boli[$data->boli];
                }
            ],
            [
                'attribute' => 'huahen',
                'value' => function($data)
                {
                    $str=$data->ishuahen?"不计免赔":"未选";
                    $str.="|".\app\models\Insurance::$huahen[$data->huahen];
                    return $str;
                }
            ],
            [
                'attribute' => 'ziran',
                'value' => function($data)
                {
                    return $data->isziran?"不计免赔":"未选";
                }
            ],
            [
                'attribute' => 'sheshui',
                'value' => function($data)
                {
                    return $data->issheshui?"不计免赔":"未选";
                }
            ],
            [
                'attribute' => 'xiulichanga',
                'value' => function($data)
                {
                    $str=\app\models\Insurance::$xiulichangb[$data->xiulichangb]."|".\app\models\Insurance::$xiulichanga[$data->xiulichanga];
                    return $str;
                }
            ],




            [
                'attribute' => 'idimgz',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->idimgz,['width' => 300]);
                }
            ],
            [
                'attribute' => 'idimgb',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->idimgb,['width' => 300]);
                }
            ],
            [
                'attribute' => 'xsimgz',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->xsimgz,['width' => 300]);
                }
            ],
            [
                'attribute' => 'xsimga',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->xsimga,['width' => 300]);
                }
            ],
            [
                'attribute' => 'xsimgb',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->xsimgb,['width' => 300]);
                }
            ],
            [
                'attribute' => 'bdimg',
                'format' => 'raw',

                'value' => function($data)
                {
                    return Html::img(ACAR_IMGURL.$data->bdimg,['width' => 300]);
                }
            ],

        ],
    ]) ?>

</div>
