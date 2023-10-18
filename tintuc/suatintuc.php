<?php
            include('../connection.php'); // Kết nối cơ sở dữ liệu

            // Lấy ID của tin tức cần sửa từ tham số truyền qua URL
            if (isset($_GET['id'])) {
                $newsId = $_GET['id'];

                // Truy vấn để lấy dữ liệu của tin tức từ cơ sở dữ liệu
                $query = "SELECT * FROM news WHERE NewsID = $newsId";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    // Gán giá trị của các cột vào các biến
                    $Title = $row['Title'];
                    $Content = $row['Content'];
                    $PublishDate = $row['DatePublished'];
                    $Author = $row['Author'];
                    $CategoryID = $row['CategoryID'];
                    $OriginalImage = $row['image'];
                }
            }
            ?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa tin tức</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="bg">
        <div class="login">
            <form method="post" enctype="multipart/form-data">
                <h1>chỉnh sửa tin tức</h1>
                <div class="form-group">
                    <label for="Title"><b>Tiêu đề</b></label>
                    <input type="text" class="form-control" placeholder="Tiêu đề" name="Title" id="Title"
                        value="<?php if(isset($Title)) echo $Title; ?>">
                </div>
                <div class="form-group">
                    <label for="Content"><b>Nội dung</b></label>
                    <textarea class="form-control" placeholder="Nội dung" name="Content"
                        id="Content"><?php if(isset($Content)) echo $Content; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="PublishDate"><b>Ngày xuất bản</b></label>
                    <input type="date" class="form-control" name="PublishDate" id="PublishDate"
                        value="<?php if(isset($PublishDate)) echo $PublishDate; ?>">
                </div>
                <div class="form-group">
                    <label for="Author"><b>Tác giả</b></label>
                    <input type="text" class="form-control" placeholder="Tác giả" name="Author" id="Author"
                        value="<?php if(isset($Author)) echo $Author; ?>">
                </div>
                <div class="form-group">
                    <label for="CategoryID"><b>Danh mục</b></label>
                    <select class="form-control" name="CategoryID" id="CategoryID">
                        <?php
                        $query = "SELECT CategoryID, CategoryName FROM categories";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = ($row['CategoryID'] == $CategoryID) ? 'selected' : '';
                                echo '<option value="' . $row['CategoryID'] . '" ' . $selected . '>' . $row['CategoryName'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Image"><b>Ảnh</b></label>
                    <input type="file" class="form-control" name="Image" id="Image">
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" name="btn_update" class="btn btn-primary">Update</button>
                </div>
            </form>

            <?php
            if (isset($_POST["btn_update"])) {
                // Lấy thông tin từ form bằng phương thức POST
                $Title = $_POST["Title"];
                $Content = $_POST["Content"];
                $PublishDate = $_POST["PublishDate"];
                $Author = $_POST["Author"];
                $CategoryID = $_POST["CategoryID"];

                // Kiểm tra xem người dùng đã chọn một tệp ảnh mới hay chưa
                if ($_FILES["Image"]["name"] != "") {
                    // Nếu họ đã chọn một tệp ảnh mới, lấy thông tin về tệp và di chuyển nó
                    $Image = $_FILES["Image"]["name"];
                    $ImageTmp = $_FILES["Image"]["tmp_name"];
                    $ImageDirectory = "../upload/";
                    move_uploaded_file($ImageTmp, $ImageDirectory . $Image);
                } else {
                    // Nếu họ không chọn một tệp ảnh mới, sử dụng tệp ảnh gốc
                    $Image = $OriginalImage;
                }

                // Thực hiện câu truy vấn để cập nhật tin tức
                $sql = "UPDATE news 
                        SET Title = '$Title', Content = '$Content', DatePublished = '$PublishDate', Author = '$Author', CategoryID = '$CategoryID', image = '$Image'
                        WHERE NewsID = '$newsId'"; // Thay your_news_id bằng ID của tin tức bạn muốn cập nhật

                // Thực thi câu SQL với biến conn lấy từ file connection.php
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Cập nhật tin tức thành công');</script>";
                    header('Location: ../quanlytintuc.php');
                } else {
                    echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
                }
            }
            ?>

        </div>
    </div>
</body>

</html>