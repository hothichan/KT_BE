<?php
    require_once './DB/connection.php';
    mysqli_select_db($conn,'quanlysinhvien');
    if(isset($_POST['btn_submit'])) {
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES['avatar']['name']);
        $insert = true;

        $fullname = $_POST["fullname"];
        $age = $_POST["age"];
        $description = $_POST["description"];

        if(empty($fullname) || empty($age)) {
            echo 'Tên và tuổi không được để trống! <br>';
            $insert = false;
        } else if(isset($_FILES['avatar'])) {
            $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $maxSize = 10000000;
            $allowtypes  = ['jpg', 'png', 'jpeg', 'gif'];

            if(file_exists($target_file)) {
                echo 'file đã tồn tại <br>' ;
                $insert = false;
            }

            if($_FILES['avatar']['size'] > $maxSize) {
                echo 'file quá lớn <br>';
                $insert = false;
            }

            if(!in_array($fileType,$allowtypes)) {
                echo 'avatar phải là ảnh <br>';
                $insert = false;
            }
        }

        if($insert) {
            if(move_uploaded_file($_FILES['avatar']['tmp_name'],$target_file)){
                echo 'file được uplaod thành công <br>';
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $timeInsert = date('Y-m-d H:i:s');
                $avatar = basename($_FILES["avatar"]["name"]);
                //insert DB
                $sql_insert = "INSERT INTO students(name,age,avatar,description,created_at) 
                VALUE ('$fullname','$age','$avatar','$description','$timeInsert')";
                if(mysqli_query($conn,$sql_insert)) {
                    header("Location: ./index.php");
                } else {
                    echo 'thêm không thành công <br>';
                }
            }
        }
    }
    mysqli_close($conn);
?>