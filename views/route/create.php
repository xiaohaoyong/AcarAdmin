<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Route */

$this->title = '添加路线';
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
