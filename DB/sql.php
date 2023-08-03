<?php 
    require_once './connection.php';
    $sql_create_db = "CREATE DATABASE quanlysinhvien";

    if(mysqli_query($conn,$sql_create_db)) {
        //Tạo bảng sau khi tạo csdl thành công
        //Liên kết CSDL đã tạo
        mysqli_select_db($conn,"quanlysinhvien");
        $sql_create_table_sv = "CREATE TABLE students (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255),
            age INT(11),
            avatar VARCHAR(255),
            description TEXT,
            created_at TIMESTAMP
        )";
        if(!mysqli_query($conn,$sql_create_table_sv)) {
            echo 'Tạo bảng không thành công<br>';
        }

    } else {
        echo 'tạo CSDL không thành công <br>';
    }
    mysqli_close($conn);
?>