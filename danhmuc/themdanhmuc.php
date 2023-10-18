<?php
include('../connection.php'); // Kết nối cơ sở dữ liệu

if (isset($_POST["btn_submit"])) {
    // Lấy thông tin từ form bằng phương thức POST
    $CategoryName = $_POST["CategoryName"];

    // Thực hiện câu truy vấn để thêm danh mục mới
    $sql = "INSERT INTO categories (CategoryName) 
            VALUES ('$CategoryName')";

    // Thực thi câu SQL với biến conn lấy từ file connection.php
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Thêm danh mục thành công');</script>";
        header('location: ../quanlydanhmuc.php');
    } else {
        echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới danh mục</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="bg">
        <div class="login">
            <form method="post" enctype="multipart/form-data">
                <h1>Thêm mới danh mục</h1>

                <div class="form-group">
                    <label for="CategoryName"><b>Tên danh mục</b></label>
                    <input type="text" class="form-control" name="CategoryName" id="CategoryName">
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" name="btn_submit" class="btn btn-primary">Thêm mới danh mục</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>