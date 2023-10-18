<?php
// Kết nối đến cơ sở dữ liệu (sử dụng biến $conn từ tệp connection.php)
include('connection.php');

// Truy vấn để lấy danh sách tin tức từ bảng news và kết hợp với tên danh mục từ bảng categories
$sql = "SELECT news.NewsID, news.CategoryID, news.Title, news.Content, news.DatePublished, news.Author, news.image, categories.CategoryName
        FROM news
        LEFT JOIN categories ON news.CategoryID = categories.CategoryID";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách tin tức</title>
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
                            <a class="nav-link" href="quanlydanhmuc.php">danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">người dùng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="table-wrapper" style="">
            <a class="btn btn-primary " style="color: white; margin-bottom: 20px; margin-left: 6px;"
                href="./tintuc/themtintuc.php">thêm tin tức</a>
            <div class="table-title">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Danh mục</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Ngày xuất bản</th>
                        <th>Tác giả</th>
                        <th>Ảnh</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['NewsID'] . "</td>";
                        echo "<td>" . $row['CategoryName'] . "</td>";
                        echo "<td>" . $row['Title'] . "</td>";
                        echo "<td>" . $row['Content'] . "</td>";
                        echo "<td>" . $row['DatePublished'] . "</td>";
                        echo "<td>" . $row['Author'] . "</td>";
                        echo "<td><img src='upload/" . $row['image'] . "' alt='Image' width='100'></td>";
                        echo '<td class="edit"><a class="btn btn-warning" href="./tintuc/suatintuc.php?id=' . $row['NewsID'] . '">Edit</a>  <a class="btn btn-danger ml-3" href="./tintuc/xoatintuc.php?id=' . $row['NewsID'] . '">Delete</a></td>';
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>