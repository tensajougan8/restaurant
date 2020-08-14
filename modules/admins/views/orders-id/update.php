<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admins\models\OrdersId */

$this->title = 'Update Orders Id: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orders-id-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
