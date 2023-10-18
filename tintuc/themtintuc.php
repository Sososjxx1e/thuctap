<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới tin tức</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="bg">
        <div class="login">
            <form method="post" enctype="multipart/form-data">
                <h1>Thêm mới tin tức</h1>
                <div class="form-group">
                    <label for="Title"><b>Tiêu đề</b></label>
                    <input type="text" class="form-control" placeholder="Tiêu đề" name="Title" id="Title">
                </div>
                <div class="form-group">
                    <label for="Content"><b>Nội dung</b></label>
                    <textarea class="form-control" placeholder="Nội dung" name="Content" id="Content"></textarea>
                </div>
                <div class="form-group">
                    <label for="PublishDate"><b>Ngày xuất bản</b></label>
                    <input type="date" class="form-control" name="PublishDate" id="PublishDate">
                </div>
                <div class="form-group">
                    <label for="Author"><b>Tác giả</b></label>
                    <input type="text" class="form-control" placeholder="Tác giả" name="Author" id="Author">
                </div>
                <div class="form-group">
                    <label for="CategoryID"><b>Danh mục</b></label>
                    <select class="form-control" name="CategoryID" id="CategoryID">
                        <?php
                        include('../connection.php');
                        $query = "SELECT CategoryID, CategoryName FROM categories";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['CategoryID'] . '">' . $row['CategoryName'] . '</option>';
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
                    <button type="submit" name="btn_submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>

            <?php
            if (isset($_POST["btn_submit"])) {
                // Lấy thông tin từ form bằng phương thức POST
                $Title = $_POST["Title"];
                $Content = $_POST["Content"];
                $PublishDate = $_POST["PublishDate"];
                $Author = $_POST["Author"];
                $CategoryID = $_POST["CategoryID"];

                // Lấy tên tệp và đường dẫn tạm thời của ảnh tải lên
                $Image = $_FILES["Image"]["name"];
                $ImageTmp = $_FILES["Image"]["tmp_name"];

                // Thư mục để lưu trữ ảnh tải lên
                $ImageDirectory = "../upload/";

                // Di chuyển tệp ảnh vào thư mục lưu trữ
                move_uploaded_file($ImageTmp, $ImageDirectory . $Image);

                // Thực hiện câu truy vấn để thêm tin tức mới
                $sql = "INSERT INTO news (Title, Content, DatePublished, Author, CategoryID, image) 
                        VALUES ('$Title', '$Content', '$PublishDate', '$Author', '$CategoryID', '$Image')";

                // Thực thi câu SQL với biến conn lấy từ file connection.php
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Thêm tin tức thành công');</script>";
                } else {
                    echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>