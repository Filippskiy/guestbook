<?php
include_once "dbconnect.php";
include_once "action.php";
if (!isset($_SESSION)) {
    session_start(); // создаем новую сессию или восстанавливаем текущую
}
include "header.php";
?>

<!-- <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav navbar-right"> -->


            <?php
// блок отображения сообщений
$c = 0;
if (isset($_SESSION['user_login'])) {
    echo "<a href='action.php?action=logout' style='float:right;'>Выйти из аккаунта</a>";
    echo "</div> <div class='container'><hr/>";
    echo "<a id='myBtn' href='admin_panel.php'><i style='line-height: 50px;' class='fas fa-plus'></i></a>";
} else {
    echo "<a href='autorize.php'>Войти </a>";
    echo "<a href='registration.php'>Зарегистрироваться</a>";
    echo "</div> <div class='container'><hr/>";
}
?>
        <!-- </ul>
    </div>
</nav> -->
    <div class="row">
            <ul class="posts col-9"></ul>
    </div>
    <script>
        $(function(){
            function getPosts(pageNum){
                var pageNum = pageNum;
                $.ajax({
                    type:'POST',
                    url:'change_posts.php',
                    data:{page:pageNum},
                    success:function(data){
                        $('.posts').html(data);
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            }
            getPosts(1);
            $('.posts').on('click','.page_link',function(e){
                e.preventDefault();
                var page_num = $(this).attr('href');
                getPosts(page_num);
            });
            function delete_post(id){
                var del_id = id;
                var info = 'id=' + del_id;
                    $.ajax({
                        type : "POST",
                        url : "remove.php", //URL to the delete php script
                        data : info,
                        success : function() {}
                    });
            }
    });
    </script> 
<?php
include "footer.php";