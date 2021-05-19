<?php

use app\models\Note;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;


/** @var Note $noteProvider */
echo GridView::widget([
    'dataProvider' => $noteProvider,
    'tableOptions' => ['class' => 'table admin-table'],
    'columns' => [
        'id',
        'title',
        [
            'attribute' => 'content',
            'content' => function ($model) {
                return StringHelper::truncateWords($model->content, 10, '...');
            }
        ],

        [
            'attribute' => 'created_at',
            'content' => function ($model) {
                return Yii::$app->formatter->asDate($model->created_at, 'y-MM-d h:i:s');

            }
        ],
        [
            'attribute' => 'creator',
            'label' => 'Автор',
            'content' => function ($model) {
                return $model->getCreatorName();
            }
        ],
        [
            'attribute' => 'category',
            'label' => 'Категория',
            'content' => function ($model) {
                return $model->getCategoryName();
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => HTML::a(FAS::icon('plus')->addCssClass('mr-1'), Url::to(['note/create']),
                ['class' => 'btn btn-theme text-white float-right']),

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
                    return Url::to(['note/view', 'id' => $model->id]);
                }

                if ($action === 'update') {
                    return Url::to(['note/update', 'id' => $model->id]);
                }
                if ($action === 'delete') {
                    return Url::to(['note/delete', 'id' => $model->id]);
                }
                return Url::to(['admin-panel/index?notes']);
            }
        ]
    ],
]);




