<?php
    use app\components\ReservationWidget;
    use app\components\SubscribeWidget;
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h4>Here you can find delecious foods</h4>
                <h2>Asian Restaurant</h2>
                <p>Quisque nec nibh id lacus fringilla eleifend sed sit amet sem. Donec lectus odio, mollis a nisl non, tempor interdum nisl.</p>
                <div class="primary-button">
                    <a href="#" class="scroll-link" data-id="book-table">Order Right Now</a>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="cook-delecious">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <div class="first-image">
                    <img src="/img/cook_01.jpg" alt="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="cook-content">
                    <h4>We cook delecious</h4>
                    <div class="contact-content">
                        <span>You can call us on:</span>
                        <h6>+ 1234 567 8910</h6>
                    </div>
                    <span>or</span>
                    <div class="primary-white-button">
                        <a href="#" class="scroll-link" data-id="book-table">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="second-image">
                    <img src="/img/cook_02.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>



<section id="about" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <div class="about-info">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.2s">
                                   <h4>Read our story</h4>
                                   <h2>We've been Making The Delicious Foods Since 1999</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.4s">
                                   <p>Fusce hendrerit malesuada lacinia. Donec semper semper sem vitae malesuada. Proin scelerisque risus et ipsum semper molestie sed in nisi. Ut rhoncus congue lectus, rhoncus venenatis leo malesuada id.</p>
                                   <p>Sed elementum vel felis sed scelerisque. In arcu diam, sollicitudin eu nibh ac, posuere tristique magna. You can use this template for your cafe or restaurant website. Please tell your friends about <a href="https://plus.google.com/+templatemo" target="_parent">templatemo</a>. Thank you.</p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                         <div class="wow fadeInUp about-image" data-wow-delay="0.6s">
                              <?= Html::img('@web/img/banner-bg.jpg', ['alt'=>'some', 'class'=>'yyy']);?>
                         </div>
                    </div>
                    
               </div>
          </div>
     </section>
      <section id="team" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Meet our chefs</h2>
                              <h4>They are nice &amp; friendly</h4>
                         </div>
                    </div>
                    <?php foreach($chef as $chefItem):?>
                    <div class="col-md-4 col-sm-4">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                              
                                <?= Html::img('@web'.$chefItem->image, ['alt' => 'breakfast image', 'class'=>'tututu']) ?>
                                     <div class="team-hover">
                                        <div class="team-item">
                                             <h4>Duis vel lacus id magna mattis vehicula</h4> 
                                             <ul class="social-icon">
                                                  <li><a href="#" class="fa fa-linkedin-square"></a></li>
                                                  <li><a href="#" class="fa fa-envelope-o"></a></li>
                                             </ul>
                                        </div>
                                   </div>

                         </div>

                         <div class="team-info">
                              <h3><?= $chefItem->firstname ?> <?= $chefItem->lastname ?></h3>
                              <p><?= $chefItem->position ?></p>
                         </div>
                          
                    </div>    
                    <?php endforeach;?>                
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
                <div class="col-md-4">
                    <div class="food-item">
                        <h2>Breakfast</h2>
                        <?= Html::img('@web'.$breakfast->image, ['alt' => 'breakfast image', 'class'=> 'tutu']) ?>
                        <!-- <div class="price">$4.50</div> -->
                        <div class="text-content">
                            <h4><?= $breakfast->dishname ?></h4>
                            <p><?= $breakfast->description ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="food-item">
                        <h2>Lunch</h2>
                        <?= Html::img('@web'.$lunch->image, ['alt' => 'lunch image' , 'class'=> 'tutu']) ?>
                        <!-- <div class="price">$7.50</div> -->
                        <div class="text-content">
                            <h4><?= $lunch->dishname ?></h4>
                            <p><?= $lunch->description ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="food-item">
                        <h2>Dinner</h2>
                        <?= Html::img('@web'.$dinner->image, ['alt' => 'dinner image' , 'class'=> 'tutu']) ?>
                        <!-- <div class="price">$7.50</div> -->
                        <div class="text-content">
                            <h4><?= $dinner->dishname ?></h4>
                            <p><?= $dinner->description ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php echo ReservationWidget::widget();?>
<!-- 
<section class="get-app">
    <div class="container">
        <div class="row">
            <div class="heading">
                <h2>Get application for your phone</h2>
            </div>
            <div class="primary-white-button">
                <a href="#">Download now</a>
            </div>
        </div>
    </div>
</section>






<section class="our-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Our blog post</h2>
                </div>
            </div>
        </div>
        <div class="row">


           


    </div>
</section> -->



<!-- <?php echo SubscribeWidget::widget();?> -->