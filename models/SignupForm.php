<?php

namespace app\models;


use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model
{
    public $email;
    public $firstname;
    public $lastname;
    public $mobileno;
    public $role;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['email','firstname', 'lastname', 'mobileno', 'password', 'password_repeat'], 'required'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\models\User', 'message' => 'This email address has already been taken.'],
            ['firstname',  'match', 'pattern' => '/^[a-zA-Z]+$/', 'message' => 'Invalid characters in username.'],

            [['password', 'password_repeat'], 'string', 'min' => 8, 'max' => 32],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->mobileno = $this->mobileno;
        $user->role = 'Chef';
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);

        if ($user->save()){
            return true;
        }

        \Yii::error("User was not saved: ".VarDumper::dumpAsString($user->errors));
        return false;
    }

}