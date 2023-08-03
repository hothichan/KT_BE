<?php
    require_once './DB/connection.php';
    mysqli_select_db($conn,'quanlysinhvien');
    
    $id = $_POST['id'];
    $sql_select_avatar = "SELECT avatar FROM students WHERE id=$id";
    $is_select_avatar = mysqli_query($conn, $sql_select_avatar);
    $sql_avatar_one =  mysqli_fetch_assoc($is_select_avatar);

    $sql_delete = "DELETE FROM students WHERE id=$id";
    $is_delete = mysqli_query($conn,$sql_delete);
    if($is_delete) {
        $avatar = $sql_avatar_one['avatar'];
        unlink("uploads/$avatar");
        $sql_select = "SELECT * FROM students";
        $is_select = mysqli_query($conn, $sql_select);
        echo "
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Tuổi</th>
                <th>Ảnh đại diện</th>
                <th>Mô tả sinh viên</th>
                <th>ngày tạo</th>
                <th></th>
            </tr>
        ";
        while($row = mysqli_fetch_assoc($is_select)) {
            echo '<tr id="'. $row["id"].'">';
            echo '<td>'.$row['id'].'</td>';
            echo '<td id="fullname">'.$row["name"].'</td>';
            echo '<td id="age">'.$row["name"].'</td>';
            echo '<td>
                    <img src="uploads/'.$row["avatar"].'" alt="" width="50px" height="50px">
                 </td>';
            echo '<td>'.$row["created_at"].'</td>';
            echo '<td id="description">'.$row["description"].'</td>';
            echo '<td>
                    <a href="./edit.php?id='.$row['id'].'" id="btn_edit">Sửa</a>
                    <a href="#" id="delete" onclick="return confirm("bạn muốn xóa")" data-delete="delete" data-id="'.$row["id"].'">Xóa</a>
                 </td>';
            echo "</tr>";  
        }
    }
    mysqli_close($conn);
?>