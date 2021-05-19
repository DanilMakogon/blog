<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\Url;



echo GridView::widget([
    'dataProvider' => $noteCategoryProvider,
    'tableOptions' => ['class' => 'table admin-table'],
    'columns' => [
        'id',
        'name'
     ,
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => HTML::a(FAS::icon('plus')->addCssClass('mr-1'), Url::to(['note-category/create']),['class'=>'btn btn-theme text-white float-right']),

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
                    return Url::to(['note-category/view', 'id' => $model->id]);
                }

                if ($action === 'update') {
                    return Url::to(['note-category/update', 'id' => $model->id]);
                }
                if ($action === 'delete') {
                    return Url::to(['note-category/delete', 'id' => $model->id]);
                }
                return Url::to(['admin-panel/index?notes']);
            }
        ]
    ],
]);




