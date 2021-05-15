<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NoteCategory */

$this->title = 'Create Note Category';
$this->params['breadcrumbs'][] = ['label' => 'Note Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
