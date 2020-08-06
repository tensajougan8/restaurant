<?php

namespace app\controllers;
use Yii;
use app\models\Menu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



class OrdersController extends Controller
{
    
	 public $layout = 'restaurant';

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
        	->where(['status'=>'1', 'type'=>'lunch']);

        return $this->render('lunch',['lunch'=> $lunch]);
    }

    public function actionDinner()
    {
        $dinner = Menu::find()
        	->where(['status'=>'1', 'type'=>'dinner']);

        return $this->render('dinner',['dinner'=> $dinner]);
    }

    public function actionSnacks()
    {
        $snacks = Menu::find()
        	->where(['status'=>'1', 'type'=>'snacks']);

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

    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
