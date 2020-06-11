<?php
include_once "dbconnect.php";
include_once "action.php";
if (!isset($_SESSION)) {
    session_start(); // создаем новую сессию или восстанавливаем текущую
}
include "header.php";
?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav navbar-right">


            <?php
// блок отображения сообщений
$c = 0;
if (isset($_SESSION['user_login'])) {
    echo "<a id='myBtn' href='admin_panel.php'><i style='line-height: 50px;' class='fas fa-plus'></i></a>";
    echo "<li><a href='action.php?action=logout'>Выйти из аккаунта</a></li>";
} else {
    echo "<li><a href='autorize.php'>Войти</a></li>";
    echo "<li><a href='registration.php'>Зарегистрироваться</a></li>";
}
?>
        </ul>
    </div>
</nav>
<div class="container bg-grey">
    <?php
$arr_id = getPostId();
echo "<ul>";
echo "<li><a href='index.php'>Home</a></li>";
foreach ($arr_id as $id) {
    echo "<li><a href='page.php?post_id=$id'>Post $id</a></li>";
}
echo "</ul>";

if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];
    $row = getPost($id);
    ?>
    <div class="container" style="margin:10px; padding:5px;background:f0f0f0;">
        <div class="speech-bubble">
            <div style="margin-bottom:20px;color: #fff;font-weight:700;text-transform:uppercase;font-size:23px;"><?php echo $row['caption']; ?></div>
            <div style="font-weight:500;color:#fff;font-size:17px;"><?php echo $row['message']; ?></div>
            <div style="text-align:right;margin-top:20px;color:#fff;font-weight:300;">Дата публикации: <?php echo $row['date']; ?></div>
            <div style="text-align:right;color:#fff;font-weight:300;">Опубликовано: <?php echo $row['log'] ?></div>
        </div>
    </div>
    <?php

}
?>
</div>
<?php
include "footer.php";