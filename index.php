<?php
    require_once './DB/connection.php';
    mysqli_select_db($conn,"quanlysinhvien");
    $sql_select = "SELECT * FROM students";
    $is_select = mysqli_query($conn, $sql_select);
    $products = mysqli_fetch_all($is_select,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
    <h1>DANH SÁCH SINH VIÊN</h1>
    <a href="./create.php">Thêm mới</a>
    <table border="1" cellspacing="0" cellpadding="8" id="table">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Tuổi</th>
            <th>Ảnh đại diện</th>
            <th>Mô tả sinh viên</th>
            <th>ngày tạo</th>
            <th></th>
        </tr>
        <?php foreach($products as $product):?>
            <tr id="<?php echo $product['id']?>">
                <td><?php echo $product['id']?></td>
                <td id="fullname"><?php echo $product['name']?></td>
                <td id="age"><?php echo $product['age']?></td>
                <td>
                    <img src="uploads/<?php echo $product['avatar']?>" alt="" width="50px" height="50px">
                </td>
                <td id="description"><?php echo $product['description']?></td>
                <td><?php echo $product['created_at']?></td>
                <td>
                    <a href="./edit.php?id=<?php echo $product['id']?>" id="btn_edit">Sửa</a>
                    <a href="#" id="delete" data-delete="delete" data-id="<?php echo $product['id']?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <?php mysqli_close($conn) ?>

    <script src="./Js/edit.js"></script>
</body>
</html>