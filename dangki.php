<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="bg">
        <div class="login">

            <form method="post">
                <h1>Đăng kí</h1>
                <div class="form-group">
                    <label><b>Họ và tên</b></label>
                    <input type="text" class="form-control" placeholder="Họ và tên" name="username">
                </div>

                <div class="form-group">
                    <label><b>Số điện thoại</b></label>
                    <input type="text" class="form-control" placeholder="Số điện thoại" name="phone">
                </div>

                <div class="form-group">
                    <label><b>Email</b></label>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>

                <div class="form-group">
                    <label><b>Mật khẩu</b></label>
                    <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                </div>

                <div class="form-group">
                    <label><b>Nhập lại mật khẩu</b></label>
                    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="repassword">
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" name="btn_submit" class="btn btn-primary">Đăng kí</button><br>
                </div>

                <span>Nếu bạn đã có tài khoản, đăng nhập <a href="Signin.html">tại đây</a></span>
            </form>
            <?php
            include('./connection.php');
	if (isset($_POST["btn_submit"])) {
		//lấy thông tin từ các form bằng phương thức POST
		$username = $_POST["username"];
        $phone = $_POST["phone"];
		$password = $_POST["password"];
        $repass = $_POST["repassword"];
		
		$email = $_POST["email"];
		
		if ($username == "" || $password == ""  || $email == "") {
			echo "<script>alert('vui lòng điền đầy đủ thông tin ');</script>";
		}
        elseif($password != $repass){
            echo "<script>alert('mật khẩu không khớp');</script>";
        }
        
        else{
			$sql = "INSERT INTO user(
										username,
                                        phone,
										password,
										email
									) VALUES (
										'$username',
										'$phone',
										'$password',
										'$email'
									)";
			// thực thi câu $sql với biến conn lấy từ file connection.php
			mysqli_query($conn,$sql);
            echo "<script>alert('chúc mừng bạn đăng ký thành công');</script>";
		}
	}

?>
        </div>
    </div>

</body>

</html>