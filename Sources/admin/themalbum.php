<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm album</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/fix.css">
</head>

<body>
    <?php
        session_start();
        include('header.php');
    ?>
    <div class="col-md-8 m-auto pt-5 text-center">
    <?php
        if(isset($_POST['ok']))
        {
            $talbum = $_POST['txtName'];
            $image=$_FILES['uploadimg']['name'];
            $pattern='#\.(jpg|jpeg|gif|png)$#i';

            if ($_FILES['uploadimg']['size'] < 4000000)
            {
                if(preg_match($pattern,$image)==1)
                {
                    if (isset($_FILES['uploadimg'])) {
                        if ($_FILES['uploadimg']['error'] > 0)
                            echo "Upload lỗi rồi!";
                        else {	
                            move_uploaded_file($_FILES['uploadimg']['tmp_name'], '../image/' . $_FILES['uploadimg']['name']);
                        }
                    }
                    $destck='../image/'.$_FILES['uploadimg']['name'];
                    $dest='image/'.$_FILES['uploadimg']['name'];
                    if(file_exists($destck))
                    {	
                        include('../php/connect.php');
                        $update=mysqli_query($con,"Insert Into album(tenalbum,image) value('$talbum','$dest')");
                        mysqli_close($con);
                        if($update)
                        {
                            echo "<h3 style='color:blue;'>Thêm album thành công...</h3>";
                         }
                        else
                        {
                            echo "<h3 style='color:red;'>Thêm album thất bại!</h3>";
                        }
                    }
                    else
                    {
                        echo "<h3 style='color:red;'>Thêm album thất bại!</h3>";
                    }
                }
                else
                {
                    echo "<h3 style='color:red;'>Sai định dạng file anh!</h3>";
                }
            }
            else
            {
            echo "<h3 style='color:red;'>Dung lượng ảnh quá lớn!</h3>";
            }
        }
    ?>
    </div>
    <main class="col-md-8 m-auto p-5">
          <form class="" action="./themalbum.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="row"><div class="col-md-12 text-center mb-3"><label style="font-size:24px">Thêm album</label></div></div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label form-control-label">Tên album:</label>
                        <div class="col-md-9">
                                <input name="txtName" class="form-control" type="text" required="required">
                        </div>
                        <label class="col-md-3 mt-3 col-form-label form-control-label">Ảnh:</label>
                        <div class="col-md-9">
                        <label class="custom-file">
                                <input type="file" id="anh" name="uploadimg" class="custom-file-input">
                                <label class="custom-file-label text-left mt-3" for="anh">Chọn đường dẫn đến ảnh...</label>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-5">
                      <label class="col-lg-3 col-form-label form-control-label"></label>
                      <div class="col-lg-9">
                        <input type="reset" class="btn btn-secondary" value="Reset">
                        <input type="submit" name="ok" class="btn btn-primary" value="Thêm">
                      </div>
                    </div>
                </div>
            </div>
          <div style="clear: both"></div>
          </form>
        </main>
    <?php
        include('footer.php');
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/xacnhan.js"></script>
</body>

</html>