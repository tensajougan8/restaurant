<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admins\models\OrdersId */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-id-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ '1' => 'Packing', '2' => 'Delivered' ], ['prompt' => 'Select status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>