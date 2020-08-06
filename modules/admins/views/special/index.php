<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admins\models\SpecialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Specials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="special-index">

    <h1><?= Html::encode($this->title) ?></h1>
  <?php Pjax::begin(); ?>
    <p>
        <?= Html::a('Create Special', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'dishname',
            'type',
            'description:ntext',
            // 'image',
            [
                'label' => 'Image',
                'format' => 'raw',
                'attribute' => 'image',
                'value' => function($data){
                    return Html::img(Url::toRoute(\Yii::$app->imageresize->getUrl(\Yii::getAlias('@webroot') . $data->image, 226, 100, 'outbound', 100)),[
                        'alt'=>$data->dishname,
                        'style'=>'min-width: 226px',
                    ]);
                },
            ],
           [
                'label' => 'Availablity',
                'format' => 'html',
                'attribute' => 'status',
                'value' => function($data) {
                    return ($data->status == 1)?('<span class="text-success">Available</span>'):('<span class="text-danger">Not Available</span>');
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

 <?php Pjax::end(); ?>
</div>
