<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\admins\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- <div class="col">
    <div class = 'container'>

    <?php $form = ActiveForm::begin([
        'id' => 'order-form',
        'method'=>'post',
        'enableAjaxValidation' => 'true',
        'action' => '/site/customers'
    ]); ?>

    <?= $form->field($model, 'phoneno')->textInput(['id' => 'phoneno']) ?>
<div id = "myForm"> 
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'name']) ?>

    <?= $form->field($model, 'address')->textArea(['row' => 3, 'id' => 'address']) ?>

    <?= $form->field($model, 'email_id')->textInput(['maxlength' => true, 'id'=>'emailid']) ?>

    <?= $form->field($model, 'landmark')->textInput(['maxlength' => true, 'id'=>'landmark']) ?>

    <?= $form->field($model, 'alernateno')->textInput(['maxlength' => true, 'id'=>'alternate']) ?>
</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

</div> -->
<div class="col">
    <div class = 'container'>
<?= Html::beginForm('/orders/customers','post',['id'=>'order-form'])?>
<br>
<br>
                            <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Mobile Number</label>
                                <fieldset>
                                    <?= Html::input('text','phoneno',false,['class'=>'form-control','id'=>'phoneno','type'=>'phone','placeholder'=>'Enter mobile number','required'=>''])?>
                                </fieldset>
                            </div>
                        </div>
                        <br>
                         <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Name</label>
                                <fieldset>
                                    <?= Html::input('text','name',false,['class'=>'form-control','id'=>'name','type'=>'name','placeholder'=>'Enter full name','required'=>''])?>
                                </fieldset>
                            </div>
                        </div>
                        <br>
                            <div class="row">
                               <div class="col-md-4">                                
                                    <label for="exampleInputEmail1">Address</label>
                                    <fieldset>
                                    <?= Html::input('text','address',false,['class'=>'form-control','id'=>'address','type'=>'name','placeholder'=>'Enter address','required'=>'',])?>
                                </fieldset>
                            </div>
                        </div>
                       
                        <br>
                        
                        <div class="row">
                           <div class="col-md-4">
                            <label for="exampleInputEmail1">Landmark</label>
                                <fieldset>
                                    <?= Html::input('text','landmark',false,['class'=>'form-control','id'=>'landmark','type'=>'phone','placeholder'=>'Enter nearest landmark','required'=>''])?>
                                </fieldset>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                 <label for="exampleInputEmail1">Email</label>
                                <fieldset>
                                    <?= Html::input('text','email_id',false,['class'=>'form-control','id'=>'email_id','type'=>'phone','placeholder'=>'Enter Email ID','required'=>''])?>
                                </fieldset>
                            </div>
                        </div>
                        <br>
                        <div class = "row">
                            <div class="col-md-4">
                                 <label for="exampleInputEmail1">Alternate mobile number</label>
                                <fieldset>
                                    <?= Html::input('text','alernate',false,['class'=>'form-control','id'=>'alternate','type'=>'phone','placeholder'=>'Enter alternate number'])?>
                                </fieldset>
                            </div>
                        </div>
                        <br>
                            <div class="col-md-4">
                                <fieldset>
                                    <?= Html::submitButton('Order',['id'=>'order-submit','class'=>'btn','type'=>'submit'])?>
                                </fieldset>
                            </div>
                        
                    <?= Html::endForm()?>
              </div>
          </div>
<div class="modal fade" tabindex="-1" role="dialog" id="contactModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reservation</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
$script = <<< JS
$(document).ready(function(){  
  $("#phoneno").on("blur", function(){
        var data = $('#phoneno').serialize();

            $.ajax({
                url: '/orders/check-number',
                type: 'POST',
                data: data,
                success: function(res){
                    
                    if (res === 'not exists'){
                        
                        
                    }
                    else {
                        
                        var data = $.parseJSON(res)
                        $('#email_id').attr('value',data.email_id);
                        $('#name').attr('value',data.name); 
                        $('#address').attr('value',data.address); 
                        $('#landmark').attr('value',data.landmark); 
                        $('#alternate').attr('value',data.alernate);                       
                         
                    }

                },
               
            });
            
        });
});
JS;
$this->registerJs($script);
