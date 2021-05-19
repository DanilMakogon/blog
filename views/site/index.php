<?php

/* @var $this yii\web\View */

/** @var ActiveQuery $notes */


use app\models\Note;
use app\models\NoteCategory;
use yii\db\ActiveQuery;
use yii\helpers\Url;

$this->title = 'Блог';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-8">
            <?php
                if(count($notes) == 0) {
                    echo '<h3 class="mt-5 mb-5">Упс! Записей пока что нет!</h3>';
                }
            ?>
            <?php foreach ($notes as $note): ?>
                <div class="post">
                    <h4><a href="<?=Url::to(['site/note','id'=> $note->id])?>"><?= $note->title ?></a></h4>
                    <div class="additional-info">
                        <span><b>Автор:</b> <?= $note->getCreatorName() ?></span>
                        <span><b>Категория:</b> <?= $note->getCategoryName() ?></span>
                        <span><b><i class="far fa-calendar-alt"></i></b> <?= $note->getDatetime() ?></span>
                    </div>
                    <div class="post-content">
                        <?= $note->getShortedContent() ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="blog-paginator">
                <a href="" class="next-link"><i class="fas fa-arrow-left"></i></a>
                <a href="" class="next-link"><i class="fas fa-arrow-right"></i></a>
                <span class="count-of-notes">Всего записей: <?= Note::find()->count()?></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sidebar">
                <div class="sidebar-block">
                    <p class="sidebar-heading">Категории</p>
                    <ul>
                        <?php /** @var NoteCategory $categories */
                        foreach ($categories as $category) {
                            echo '<li><a href="">'.$category->name.'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
