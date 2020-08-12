<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'cart';

?>
<div>

 <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data as $row):?>
      <tr>
        <td><?= $row->name ?> </td>
        <td><?= $row->quantity ?></td>
        <td><?= $row->price ?></td>
        <td><?= Html::a('Remove', ['remove-from-cart', 'id' => $row->id], ['style' => 'background-color:#84f14e']) ?></h2></td>
      </tr>
      <?php endforeach;?>

    </tbody>
  </table>
  <h2>Total : <?= $total ?> </h2> 
  <?= Html::a('Checkout', ['check-out'],['style' => 'background-color:#84f14e']) ?>
</div>