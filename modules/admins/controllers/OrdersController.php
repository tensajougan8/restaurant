<?php

namespace app\modules\admins\controllers;

use Yii;
use app\modules\admins\models\OrdersId;
use app\modules\admins\models\Orders;
use app\modules\admins\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $order = Orders::find()
            ->joinWith('item')
            ->joinWith('customer')
            ->where(['<>' ,'orders.status', '3'])
            ->all();

            $connection = \Yii::$app->getDb();
            $command1 = $connection->createCommand("SELECT c.id, c.name, o.id, o.status, SUM(ord.quantity*p.price) as 
                Total
                FROM customer c inner join orderid o
                     on c.id = o.customer_id join
                     orders ord
                     on o.id = ord.order_id join
                     menu p
                     on ord.item_id = p.id
                GROUP BY o.id");

            $result = $command1->queryAll();
             // $connection = \Yii::$app->getDb();
            $command = $connection->createCommand("SELECT name,o.Numberor , r.Numberde
    FROM customer 
    INNER JOIN (Select customer_id, count(*) as Numberor  from orders where status = 1 Group by customer_id )AS o
    on customer.id = o.customer_id
     INNER JOIN (Select customer_id, count(distinct (order_id)) as Numberde  from orders where status = 1 Group by customer_id )AS r
    on customer.id = r.customer_id");

             $result1 = $command->queryAll();

           

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'order' => $order,
            'result' => $result,
            'result1' => $result1
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate1($id)
    {
        $model = $this->findModel1($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

              Orders::updateAll(['status' => 3], ['like', 'order_id', $id]);  
              $res = $this->actionIndex();
              return $res; 
        }

        return $this->render('update1', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel1($id)
    {
        if (($model = OrdersId::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
