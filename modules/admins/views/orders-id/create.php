<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admins\models\OrdersId */

$this->title = 'Create Orders Id';
$this->params['breadcrumbs'][] = ['label' => 'Orders Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-id-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
