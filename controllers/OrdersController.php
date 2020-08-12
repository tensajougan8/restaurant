<?php

namespace app\controllers;
use Yii;
use yii\bootstrap\ActiveForm;
use app\models\Menu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yz\shoppingcart\CartPositionTrait;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\ShoppingCart;
use app\models\Customer;
use app\models\Orders;
use yii\helpers\Json;

class OrdersController extends Controller
{
    
	 public $layout = 'onlineorder';

    public function actionBreakfast()
    {
        $breakfast = Menu::find()
        	->where(['status'=>'1', 'type'=>'breakfast'])
        	->all();

        return $this->render('breakfast',['breakfast'=> $breakfast]);
    }

    public function actionLunch()
    {
        $lunch = Menu::find()
        	->where(['status'=>'1', 'type'=>'lunch'])
        	->all();

        return $this->render('lunch',['lunch'=> $lunch]);
    }

    public function actionDinner()
    {
        $dinner = Menu::find()
        	->where(['status'=>'1', 'type'=>'dinner'])
        	->all();

        return $this->render('dinner',['dinner'=> $dinner]);
    }

    public function actionDesserts()
    {
        $desserts = Menu::find()
        	->where(['status'=>'1', 'type'=>'desserts'])
        	->all();;

        return $this->render('desserts',['desserts'=> $desserts]);
    }

    public function actionSnacks()
    {
        $snacks = Menu::find()
        	->where(['status'=>'1', 'type'=>'snacks'])
        	->all();

        return $this->render('snacks',['snacks'=> $snacks]);
    }

    public function actionBuy($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['buy', 'id' => $model->id]);
        }

        return $this->render('buy', [
            'model' => $model,
        ]);
    }

    public function actionAddToCart($id)
	{
	    $cart = Yii::$app->cart;

	    $model = Menu::findOne($id);
	    if ($model) {
	        $cart->put($model, 1);
	        $data = $cart->getPositions();
	        $itemsCount = \Yii::$app->cart->getCount();

	        $type = $model->type;
	        switch($type)
	        {
	        	case 'breakfast':
	      		return $this->actionBreakfast();
	      		break;
	      		case 'lunch':
	      		return $this->actionLunch();
	      		break;
	      		case 'dinner':
	      		return $this->actionDinner();
	      		break;
	      		case 'desserts':
	      		return $this->actionDesserts();
	      		break;
	      		case 'snacks':
	      		return $this->actionSnacks();
	      		break;
	      		default:

	        }
	        	
	        // return $this->render('cart-view',['data'=>$data,'itemsCount'=>$itemsCount ]);
	    }
	    throw new NotFoundHttpException();
	}

	public function actionViewTheCart()
	{
		$cart = Yii::$app->cart;

	   
	        $data = $cart->getPositions();
	        $itemsCount = \Yii::$app->cart->getCount();
	      	 $total = \Yii::$app->cart->getCost();
	        return $this->render('cart-view',['data'=>$data,'total'=>$total ]);
	   
	}

	public function actionRemoveFromCart($id)
	{
		$cart = Yii::$app->cart;

	    $model = Menu::findOne($id);
	    if ($model) {
	        $cart->remove($model, 1);
	        $data = $cart->getPositions();
	        return $this->render('cart-view',['data'=>$data]);
	    }
	    throw new NotFoundHttpException();
	}

	 public function actionCustomers()
     {
        $order = new Customer();

        if(\Yii::$app->request->isAjax){
            if ($data = \Yii::$app->request->post()){
                 $order2 = $data['phoneno'];
               $customer = Customer::find()
               ->where(['phoneno'=>$order2])
               ->exists();
               if($customer)
               {
                $customer1 = Customer::find()
                ->where(['phoneno'=>$order2])->one();
                $customer1->name = $data['name'];
                $customer1->address = $data['address'];
                $customer1->email_id = $data['email_id'];
                $customer1->landmark = $data['landmark'];
                $customer1->alernateno = $data['alernate'];
                if ($customer1->validate()){
                    $customer1->save();
                    $cus = Customer::find()->select(['id'])->where(['phoneno'=>$order2]);
                    $res = $this->SaveOrder($cus);
                    return ('Success');
                } else {
                    return json_encode($customer1->errors);
                }
               }
           else{
                $order->phoneno = $data['phoneno'];
                $order->name = $data['name'];
                $order->address = $data['address'];
                $order->email_id = $data['email_id'];
                $order->landmark = $data['landmark'];
                $order->alernateno = $data['alernate'];

                if ($order->validate()){
                    $order->save();
                    $cus = Customer::find()->select(['id'])->where(['phoneno'=>$order2]);
                   $res = $this->SaveOrder($cus);
                    return ('Success');
                } else {
                    return json_encode($order->errors);
                }
            }
            } else{
                return false;
            }

        }
        return false;
    }

     public function actionCheckNumber()
     {
       

        if(\Yii::$app->request->isAjax){
            if ($data = \Yii::$app->request->post()){

               $order = $data['phoneno'];
               $customer = Customer::find()
               ->where(['phoneno'=>$order])
               ->exists();
               if($customer)
               {
                    $check = Customer::find()->where(['phoneno'=>$order])->one();
                    echo Json::encode($check);
               }
              else
               {
                     return "not exists";
                }
               
              }
          }
        
    }


	public function actionCheckOut()
	{
		$model = new Customer;
		$cart = Yii::$app->cart;
		$total = \Yii::$app->cart->getCost();
	    return $this->render('buy',['total'=>$total, 'model'=>$model ]);
	}

    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function SaveOrder($cus)
    {
    	$cart = Yii::$app->cart;
    	foreach($cart->getPositions() as $data)
    	{
    		$orders = new Orders;
    		$orders->customer_id = $cus;
    		$orders->item_id = $data->id;
    		$orders->quantity = $data->quantity;
    		$orders->status = 1;

    		$orders->save(false); 
    		$cart->removeAll();
    	}
    }

}
