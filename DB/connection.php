<?php 
    $host = 'localhost';
    $user = 'root';
    $pass = '';

    $conn = mysqli_connect($host,$user,$pass);

    if(!$conn) {
        die('kết nối thất bại' . mysqli_connect_errno());
    }
?>