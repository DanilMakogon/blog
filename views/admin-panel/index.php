<?php
/* @var $this yii\web\View */

$this->registerJsFile('js/admin.js', ['depends' => yii\bootstrap4\BootstrapPluginAsset::className()]);
?>
<h3 class="mb-4 text-center">Панель администратора</h3>


<ul class="nav  nav-pills nav-fill mb-3">

    <li class="nav-item px-2">
        <a class="nav-link <?= (!isset($_GET['notes']) && !isset($_GET['comments']) && !isset($_GET['categories'])) ? 'active' : '' ?>"
           href="/admin-panel/index?users">Пользователи</a>
    </li>
    <li class="nav-item px-2">
        <a class="nav-link <?= (isset($_GET['notes'])) ? 'active' : '' ?>" href="/admin-panel/index?notes">Записи</a>
    </li>
    <li class="nav-item px-2">
        <a class="nav-link <?= (isset($_GET['comments'])) ? 'active' : '' ?>" href="/admin-panel/index?comments">Комментарии</a>
    </li>
    <li class="nav-item px-2">
        <a class="nav-link <?= (isset($_GET['categories'])) ? 'active' : '' ?>" href="/admin-panel/index?categories">Категории</a>
    </li>
</ul>
<hr>


