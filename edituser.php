<?php
include('connection.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Lấy thông tin người dùng cần chỉnh sửa
    $sql = "SELECT * FROM user WHERE ID = $user_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['btn-submit'])) {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Thực hiện câu truy vấn để cập nhật thông tin người dùng
    $sql = "UPDATE user SET username='$username', phone='$phone', email='$email' WHERE ID = $user_id";
    mysqli_query($conn, $sql);

    // Chuyển hướng người dùng về trang danh sách người dùng sau khi cập nhật
    header('Location: users.php');
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
    <h1 align="center">Chỉnh sửa người dùng</h1>
    <div class="container  ">
        <div class="row">
            <form method="post" class="col-8 m-auto">
                <label for="username">Username:</label>
                <input class="form-control" type="text" name="username" id="username"
                    value="<?php echo $row['username']; ?>"><br>

                <label for="phone">Phone:</label>
                <input class="form-control" type="text" name="phone" id="phone"
                    value="<?php echo $row['phone']; ?>"><br>

                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email"
                    value="<?php echo $row['email']; ?>"><br>

                <input class="btn btn-primary" type="submit" name="btn-submit" value="Cập nhật">
            </form>
        </div>
    </div>
</body>

</html>