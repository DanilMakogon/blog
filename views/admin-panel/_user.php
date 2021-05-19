<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\Url;



echo GridView::widget([
    'dataProvider' => $userProvider,
    'tableOptions' => ['class' => 'table admin-table'],
    'columns' => [
        'id',
        'username',
        'email',
        [
            'attribute' => 'is_blocked',
            'content' => function ($model) {
                return ($model['is_blocked']) ? '<span  class="blocked-status">Заблокирован</span>' : '<span class="unblocked-status">Не заблокирован</span>';
            }
        ],

        [
            'attribute' => 'role',
            'content' => function ($model) {
                if ($model->role == 10) {
                    return '<span class="role-user">Пользователь</span>';
                } else {
                    if ($model->role == 20) {
                        return '<span class="role-admin">Админ</span>';
                    }
                }
                return $model->role;
            }

        ],
        [
            'attribute' => 'created_at',
            'content' => function ($model) {
                return Yii::$app->formatter->asDate($model->created_at, 'y-MM-d h:i:s');

            }

        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => HTML::a(FAS::icon('plus')->addCssClass('mr-1'), Url::to(['user/create']),['class'=>'btn btn-theme text-white float-right']),

            'template' => '<div class="text-right">{view}{update}{delete}</div>',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a(FAS::icon('eye'), $url, ['class' => 'mx-2']);
                },

                'update' => function ($url, $model) {
                    return Html::a(FAS::icon('sync'), $url, ['class' => 'mx-2']);
                },
                'delete' => function ($url, $model) {
                    return Html::a(FAS::icon('trash'), $url, ['class' => 'mx-2']);
                }

            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return Url::to(['user/view', 'id' => $model->id]);
                }

                if ($action === 'update') {
                    return Url::to(['user/update', 'id' => $model->id]);
                }
                if ($action === 'delete') {
                    return Url::to(['user/delete', 'id' => $model->id]);
                }
                return Url::to(['admin-panel/index']);
            }
        ]
    ],
]);




