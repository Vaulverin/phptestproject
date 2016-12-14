<div class="header clearfix">
    <nav>
        <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="/">Оставить отзыв</a></li>
            <li role="presentation"><a href="/AdminPanel/Logout">Выход</a></li>
        </ul>
    </nav>
    <h3>Панель урпавления</h3>
</div>
<?php
if(isset($data['page']))
{
    if ($data['page'] == 'main')
        include './application/Views/adminpanel_main_view.php';
    else if($data['page'] == 'comment')
        include './application/Views/adminpanel_comment_view.php';
}