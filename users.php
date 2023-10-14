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


        <h1>danh sáck người dùng</h1>
        <div class="table-wrapper">
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