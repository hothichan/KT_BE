<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>THÊM SINH VIÊN MỚI</h1>
    <a href="./index.php">về trang danh sách</a>
    <form action="./insert_DB.php" method="post" enctype="multipart/form-data">
        <label for="fullname">Họ tên</label>
        <input type="text" name="fullname" id="fullname"> <br>
        <label for="age">Tuổi</label>
        <input type="text" name="age" id="age"> <br>
        <label for="avatar">Ảnh đại diện</label>
        <input type="file" name="avatar" id="avatar"> <br>
        <label for="description">Mô tả</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea><br>

        <input type="submit" value="Save" name="btn_submit">
        <input type="reset" value="Reset">
    </form>
</body>
</html>