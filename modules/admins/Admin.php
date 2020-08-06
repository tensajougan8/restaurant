<?php

namespace app\modules\admins;
use yii\filters\AccessControl;
/**
 * Admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admins\controllers';

    /**
     * {@inheritdoc}
     */



    public $layout = '@app/views/layouts/admin';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    
}
