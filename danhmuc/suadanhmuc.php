<?php
include('../connection.php');

if (isset($_GET['id'])) {
    $CategoryID = $_GET['id'];

    // Lấy thông tin người dùng cần chỉnh sửa
    $sql = "SELECT * FROM categories WHERE CategoryID = $CategoryID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['btn-submit'])) {
    // Đảm bảo rằng biến $CategoryID đã được định nghĩa
    if (isset($CategoryID)) {
        $CategoryName = $_POST['CategoryName'];

        // Thực hiện câu truy vấn để cập nhật thông tin danh mục
        $sql = "UPDATE categories SET CategoryName='$CategoryName' WHERE CategoryID = $CategoryID";
        mysqli_query($conn, $sql);

        // Chuyển hướng người dùng về trang danh sách danh mục sau khi cập nhật
        header('Location: ../quanlydanhmuc.php');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chỉnh sửa người dùng</title>
    <link rel="stylesheet" type="text/css" href="user.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h1 align="center">Chỉnh sửa danh mục</h1>
    <div class="container  ">
        <div class="row">
            <form method="post" class="col-8 m-auto">
                <label for="CategoryName">tên danh mục:</label>
                <input class="form-control" type="text" name="CategoryName" id="CategoryName"
                    value="<?php echo $row['CategoryName']; ?>"><br>

                <input class="btn btn-primary" type="submit" name="btn-submit" value="Cập nhật">
            </form>
        </div>
    </div>
</body>

</html>