<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admins\models\Special */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Specials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="special-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'dishname',
            'type',
            'description',
            'image:image',
            [
                'label' => 'Availablity',
                'format' => 'html',
                'attribute' => 'status',
                'value' => function($data) {
                    return ($data->status == 1)?('<span class="text-success">Available</span>'):('<span class="text-danger">Not Available</span>');
                }
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
