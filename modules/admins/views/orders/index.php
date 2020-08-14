<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admins\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'customer.name',
            'customer.phoneno',
            'customer.address',
            'item.name',
            'quantity',
            [
                'label' => 'Status',
                'format' => 'html',
                'attribute' => 'status',
                'value' => function($data) {
                    switch($data->status)
                    {
                        case 1:
                        return ('<span class="text-success">Preparing</span>');
                        break; 
                        case 2:
                        return ('<span class="text-success">Packed</span>');
                        break; 
                        case 3:
                        return ('<span class="text-success">Delivered</span>');
                        break; 
                    }
                    
                }
            ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<!-- <div class = "container">
    
<h2>Orders</h2>
<table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Address</th>
        <th>Price</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($order as $row): ?>
      <tr>
        <td><?= $row->customer->phoneno ?> </td>
        <td><?= $row->quantity ?> </td>
        <td><?= $row->customer->address ?> </td>
        <td><?= $row->item->price ?></td>
        <?php if( $row->status == 1 ): ?>
            <td>Preparing</td>
            <?php else: ?>
              <td>Packed</td> 
              <?php endif; ?> 
      </tr>
    </tbody>
<?php endforeach; ?>
  </table> -->
</div>
  <h2>Bill</h2>
  <?php foreach ($result as $data): ?>
  <h3>Order ID: <?= $data['id'] ?></h3>
  <h3>Customer Name:<?= $data['name'] ?></h3><h3>Total:<?= $data['Total'] ?></h3>
  <?php if( $data['status'] == 1 ): ?>
    <h3>Packing</h3>
    <?php else: ?>
        <h3>Delivered</h3>
        <?php endif; ?> 
        <?= Html::a('Update', ['orders/update1' , 'id' => $data['id'] ], ['class' => 'btn btn-success']) ?>
  <?php endforeach; ?>
<!-- </div> -->


