<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$userid=\Yii::$app->request->get('id',0);
$Users=\app\models\Users::findOne($userid);
$this->title = $Users->name;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userid, 'url' => ['view', 'id' => $model->userid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="driver-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
