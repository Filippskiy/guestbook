<?php
    include 'dbconnect.php';
    global $conn;
    $id = $_POST['id'];
    $query = "DELETE FROM `gbooktable` WHERE id='$id'";
    mysqli_query($conn,$query);