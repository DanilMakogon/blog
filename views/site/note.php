<?php
/** @var Note $note */

use app\models\Note;

$this->title = $note->title;
?>
<div class="site-index">
    <div class="note-view">
        <h1><?= $note->title ?></h1>
        <div class="note-content">
            <?= $note->content ?>
        </div>
        <div class="note-addition-info">
            <span><b>Автор:</b> <?= $note->getCreatorName() ?></span>
            <span><b>Категория:</b> <?= $note->getCategoryName() ?></span>
            <span><b><i class="far fa-calendar-alt"></i></b> <?= $note->getDatetime() ?></span>
        </div>
    </div>
    <div class="comments">
        <h3 class="mt-5 mb-3">Комментарии</h3>
        <div class="send-comment">
            <form action="">
                <textarea type="text" maxlength="500" name="text"></textarea>
                <input type="text" name="note_id" hidden>
                <button class="btn btn-sm btn-theme">Комментировать</button>
            </form>
        </div>
    </div>
</div>