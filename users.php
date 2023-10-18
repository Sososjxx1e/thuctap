<?php
// Kết nối đến cơ sở dữ liệu (sử dụng biến $conn từ tệp connection.php)
include('connection.php');

// Truy vấn để lấy danh sách người dùng
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" type="text/css" href="user.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="main-container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="width:75%">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">quản lý</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " href="quanlydanhmuc.php"> danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="quanlytintuc.php">tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="users.php">người dùng</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="table-wrapper" style="    margin-top: 50px;">
            <a class="btn btn-primary " style="color: white;margin-bottom: 20px;margin-left: 6px;"
                href="dangki.php">thêm người dùng</a>
            <div class="table-title">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th ">Actions</th>
                    </tr>
                    <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo '<td class="edit"><a class="btn btn-warning" href="edituser.php?id=' . $row['ID'] . '">Edit</a>  <a class="btn btn-danger ml-3" href="deleteuser.php?id=' . $row['ID'] . '">Delete</a></td>';
            echo "</tr>";
        }
        ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>