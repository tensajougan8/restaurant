<?php
use app\components\ReservationWidget;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<section class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Our Menus</h1>
                <p>Curabitur at dolor sed felis lacinia ultricies sit amet vel sem. Vestibulum diam leo, sodales tempor lectus sed, varius gravida mi.</p>
            </div>
        </div>
    </div>
</section>



  <section id= "featured-food" class="featured-food">
        <div class="container">
            <div class="row">
                <div class="heading">
                    <h2>Chef Special's</h2>
                </div>
            </div>
            <div class="row">
                 <?php foreach($dinner as $breakfast):?>
                <div class="col-md-4">
                    <div class="food-item">
                        <h2><?= $breakfast->name ?></h2>
                        <?= Html::img('@web'.$breakfast->image, ['alt' => 'breakfast image', 'class'=> 'tutu']) ?>
                        <!-- <div class="price">$4.50</div> -->
                        <div class="text-content">
                            <p><?= $breakfast->description ?></p>
                        </div>
                        <div class = "row">
                            <div class="primary-button">
                                <?= Html::a('Buy', ['/orders/buy', 'id' => $breakfast->id], ['style' => 'background-color:#84f14e']) ?>
                               &nbsp; &nbsp; &nbsp; &nbsp;
                                <?= Html::a('Add to Cart', ['add-to-cart', 'id' => $breakfast->id], ['style' => 'background-color:#84f14e']) ?>
                            </div>
                        
                        </div>
                    </div>
                </div>
                <?php endforeach;?>  
            </div>
        </div>
    </section>



