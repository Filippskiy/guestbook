<?php
// check request method

// including database connection
require 'dbconnect.php';

if(isset($_POST['page'])){
    // if get page number through post request and check it is valid number
    $page_num = filter_var($_POST['page'], FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 1,
            'min_range' => 1
        ]
    ]); 
    
}else{
    //Defautl page number
    $page_num = 1;
}
// set how much show posts in a single page
$page_limit = 5;
// Set Offset
$page_offset = $page_limit * ($page_num - 1);

function showPosts($conn, $current_page_num, $page_limit, $page_offset){
    
    // query of fetching posts
    $query = mysqli_query($conn,"SELECT * FROM `gbooktable` JOIN users ON GBookTable.user_id=users.user_id ORDER BY date DESC LIMIT $page_limit OFFSET $page_offset");
    
    // check database is not empty
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_array($query)){     
           echo '
           <div class="speech-bubble">
                <div style="margin-bottom:20px;color: #fff;font-weight:700;text-transform:uppercase;font-size:23px;">'.$row['caption'].'</div>
                <div style="font-weight:500;color:#fff;font-size:17px;">'. $row['message'].'</div>
                <div style="text-align:right;margin-top:20px;color:#fff;font-weight:300;">Дата публикации: '.$row['date'].'</div>
                <div style="text-align:right;color:#fff;font-weight:300;">Опубликовано: '.$row['log'].'</div>
            </div>';
        }
        // total number of posts
        $total_posts = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `gbooktable`"));
        
        // total number of pages
        $total_page = ceil($total_posts / $page_limit);
        // set next page number
        $next_page = $current_page_num+1; 
        // set prev page number
        $prev_page = $current_page_num-1; 
        
       echo "<li>";
        //showing prev button and check current page number is greater than 1
        if($current_page_num > 1){
           echo '<a href="'.$prev_page.'" class="page_link"><i class="fas fa-arrow-left"></i></a>';
        }
        // show all number of pages
        for($i = 1; $i <= $total_page; $i++){
            //highlight the current page number
            if($i == $current_page_num){
                echo '<a href="'.$i.'" class="page_link active_page">'.$i.'</a>';
            }else{
                echo '<a href="'.$i.'" class="page_link">'.$i.'</a>';
            }
            
        }
        // showing next button and check this is last page
        if($total_page+1 != $next_page){
           echo '<a href="'.$next_page.'" class="page_link"><i class="fas fa-arrow-right"></i></a>';
        }
        
        echo "</li>";  
        
    }else{
        echo "No Data found !";
    }
}
showPosts($conn, $page_num, $page_limit, $page_offset);
?>