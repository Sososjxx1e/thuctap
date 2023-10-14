<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="bg">
        <div class="login">

            <form method="post">
                <h3>Đăng Nhập</h3>

                <div class="form-group">
                    <label><b>Email</b></label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>

                <div class="form-group">
                    <label><b>Mật khẩu</b></label>
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" name="btn-submit" class="btn btn-primary">Đăng nhập</button><br>
                </div>
            </form>
            <?php
include('./connection.php'); // Import tệp chứa kết nối đến cơ sở dữ liệu

// Đảm bảo rằng biểu mẫu đã được gửi đi
if (isset($_POST['btn-submit'])) {
    // Nhận thông tin đăng nhập từ biểu mẫu
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    if (!empty($email) && !empty($password)) {
        // Sử dụng biến $conn từ tệp connection.php
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // Đăng nhập thành công
            header("Location: users.php");
            echo "<script>alert('Đăng nhập thành công');</script>";
        } else {
            // Đăng nhập thất bại
            echo "<script>alert('Đăng nhập thất bại');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin');</script>";
    }
}
?>


        </div>
    </div>

</body>

</html>