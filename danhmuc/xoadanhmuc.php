<?php
include('../connection.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Thực hiện câu truy vấn để xóa người dùng
    $sql = "DELETE FROM categories WHERE CategoryID = $user_id";
    mysqli_query($conn, $sql);

    // Chuyển hướng người dùng về trang danh sách người dùng sau khi xóa
    header('Location: ../quanlydanhmuc.php');
}
?>