<?php

namespace app\controllers;

use app\models\Note;
use app\models\NoteCategory;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

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
        if (Yii::$app->request->get('notes') !== null) {
            $query = Note::find();
            $noteProvider = new ActiveDataProvider([
                'query' => $query
            ]);
            return $this->render('index', ['noteProvider' => $noteProvider]);
        } else if(Yii::$app->request->get('categories') !== null){
            $query = NoteCategory::find();
            $noteCategoryProvider = new ActiveDataProvider([
                'query' => $query
            ]);
            return $this->render('index', ['noteCategoryProvider' => $noteCategoryProvider]);
        } else {
            $query = User::find();
            $userProvider = new ActiveDataProvider([
                'query' => $query
            ]);
            return $this->render('index', ['userProvider' => $userProvider]);
        }


    }

}
