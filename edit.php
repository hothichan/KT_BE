<?php 
    require_once './DB/connection.php';
    mysqli_select_db($conn,'quanlysinhvien');

    $uid = $_GET['id'];
    $sql_select_one = "SELECT * FROM students WHERE id=$uid";
    $is_select_one = mysqli_query($conn,$sql_select_one);
    $product = mysqli_fetch_assoc($is_select_one);

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
        } else if($_FILES['avatar']['error'] === 0) {
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
            if($insert) {
                $unFile = $product['avatar'];
                unlink("$target_dir/$unFile");
                $avatar = basename($_FILES["avatar"]["name"]);
                move_uploaded_file($_FILES['avatar']['tmp_name'],$target_file);
                $sql_update_avatar = "UPDATE students SET avatar = '$avatar' WHERE id='$uid'";
                mysqli_query($conn,$sql_update_avatar);
            }
        }

        if($insert) {
            echo 'file được uplaod thành công <br>';
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $timeUpdate = date('Y-m-d H:i:s');
            
            //insert DB
            $sql_update = "UPDATE students SET
                name = '$fullname',age = '$age',description = '$description',created_at = '$timeUpdate' WHERE id='$uid'";
            if(mysqli_query($conn,$sql_update)) {
                header("Location: ./index.php");
            } else {
                echo 'sửa không thành công <br>';
            }
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>SỬA THÔNG TIN VIÊN # <?php echo $product['id'];?> </h1>
    <a href="./index.php">về trang danh sách</a>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="fullname">Họ tên</label>
        <input type="text" name="fullname" id="fullname" value="<?php echo $product['name'];?>"> <br>
        <label for="age">Tuổi</label>
        <input type="text" name="age" id="age" value="<?php echo $product['age'];?>"> <br>
        <label for="avatar">Ảnh đại diện</label>
        <input type="file" name="avatar" id="avatar"> <br>
        <img src="./uploads/<?php echo $product['avatar'];?>" alt="" width="50px" height="50px"><br>
        <label for="description">Mô tả</label>
        <textarea name="description" id="description" cols="30" rows="10"><?php echo $product['description'];?></textarea><br>

        <input type="submit" name="btn_submit" value="Save">
        <input type="reset" value="Reset">
    </form>
</body>
</html>