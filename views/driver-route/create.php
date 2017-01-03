<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DriverRoute */
$userid=\Yii::$app->request->get('userid',0);
$Users=\app\models\Users::findOne($userid);
$this->title = $Users->name.'添加路线';
$this->params['breadcrumbs'][] = ['label' => 'Driver Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-route-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
