<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AdminPanelController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    // deny all POST requests
                    [
                        'actions' => ['index'],
                        'allow' => true,

                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return (Yii::$app->user->identity->isAdmin());
                        }
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
