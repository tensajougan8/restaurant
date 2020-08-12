<?php

namespace app\controllers;

use yii\web\Controller;
use function React\Promise\all;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use app\controllers\AppController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Subscribe;
use app\models\Reservation;
use app\models\SignupForm;
use app\models\Special;
use app\models\Staff;
use yii\bootstrap\ActiveForm;
use app\models\Customer;
use yii\helpers\Json;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public $layout = 'restaurant';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $breakfast = Special::find()
            ->where([ 'type' => 'breakfast'])
            ->orderBy(['id'=> SORT_DESC])
            ->one();

        $lunch = Special::find()
            ->where(['type' => 'lunch'])
            ->orderBy(['id'=> SORT_DESC])
            ->one();

        $dinner = Special::find()
            ->where(['type' => 'dinner'])
            ->orderBy(['id'=> SORT_DESC])
            ->one();

        $chef = Staff::find()
            ->where(['position' => 'chef'])
            ->limit(3)
            ->all();
        return $this->render('index',
            [
                'breakfast' => $breakfast,
                'lunch' => $lunch,
                'dinner' => $dinner,
                'chef' => $chef,
            ]);
           
    }

     public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['Admin']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    public function actionSubscribe(){

            $subscribe = new Subscribe();

            if(\Yii::$app->request->isAjax){
                if ($email = \Yii::$app->request->post('email')){
                    $subscribe->email = $email;
                    if($subscribe->validate()){
                        $subscribe->save();
                        return 'Success!';
                    } else
                    {
                        return json_encode($subscribe->errors);

                    }

                } else{
                    return 'Request error';
                }
            }
            return false;

    }

    

     public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()){
            Yii::$app->session->addFlash('SIGNUP', 'You have successfully registered');
            return $this->redirect(Yii::$app->homeUrl);
        }

        return $this->render('signup', [
            'model' => $model
        ]);


    }



    public function actionReservation(){
        $reservation = new Reservation();

        if(\Yii::$app->request->isAjax){
            if ($data = \Yii::$app->request->post()){

                $reservation->day = $data['day'];
                $reservation->hour = $data['hour'];
                $reservation->full_name = $data['name'];
                $reservation->phone = $data['phone'];
                $reservation->persons = $data['persons'];

                if ($reservation->validate()){
                    $reservation->save();
                    return ('Success');
                } else {
                    return json_encode($reservation->errors);
                }
            } else{
                return false;
            }
        }
        return false;

    }



    public function actionFeedback(){
        $feedback = new Feedback();
        if(Yii::$app->request->isAjax)
        {
            if ($feedback->load(Yii::$app->request->post())){
                if ($feedback->validate()){
                    $feedback->save();
                    return ('Success');
                } else {
                    return json_encode($feedback->errors);
                }
            }


        }

        return false;

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }



    public function actionContact()
    {
        $feedback = new Feedback();

        if (Yii::$app->request->isAjax && $feedback->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($feedback);

        }

        return $this->render('contact', [
            'model' => $feedback,
        ]);


    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
