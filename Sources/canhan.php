<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Trang Cá Nhân</title>
  <link rel="stylesheet" href="./css/hover.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container-fullwidth">
    <?php
        session_start();
        include('./php/header.php');
    ?>
        <?php
        include('./php/connect.php');
          $userName = $_SESSION['userName'];
          $result = mysqli_query($con,"Select * from user where userName = '$userName'");
          $row = mysqli_fetch_assoc($result);
          $hoten = $row["hoten"];
          $gioiTinh =$row["gioitinh"];
          $Nam='';
          $Nu='';
          $Khac='';
          switch ($gioiTinh) {
            case 0:
              $Nam="selected";
              break;
            case 1:
              $Nu="selected";
              break;
            default:
              $Khac="selected";
              break;
          }
          $ngaysinh=$row["ngaysinh"];
          $email=$row["email"];
          $sdt=$row["sdt"];
          $diachi=$row["diachi"];
          $avatar=$row['avatar'];
      mysqli_close($con);
          echo '
        <main class="col-md-11 m-auto p-5">
        
        <div class="row">
          <form class="col-md-12" action="./php/capnhatTT.php" method="post" enctype="multipart/form-data">
            <div class="col-md-3 float-left text-md-center p-3">
              <img src="./'.$avatar.'" width="160px" class="m-x-auto img-fluid img-circle" alt="avatar">
              <label class="custom-file">
                <input type="file" id="anh" name="uploadimg" class="custom-file-input">
                <label class="custom-file-label text-left mt-3" for="anh">Thay đổi ảnh...</label>
              </label>
            </div>
                <div class="col-md-8 float-right p-3">
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label">Họ và Tên</label>
                      <div class="col-lg-9">
                        <input name="txtHoTen" class="form-control" type="text" value="'.$hoten.'">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label">Giới tính</label>
                      <div class="col-lg-9">
                        <select name="slGioiTinh"class="custom-select mr-sm-2" id="gioitinh">
                          <option '.$Nam.' value="0">Nam</option>
                          <option '.$Nu.' value="1">Nữ</option>
                          <option '.$Khac.' value="2">Khác</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label">Ngày sinh</label>
                      <div class="col-lg-9">
                        <input name="txtNgaySinh" class="form-control" type="date" value="'.$ngaysinh.'">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label">Email</label>
                      <div class="col-lg-9">
                        <input name="txtEmail" class="form-control" type="email" value="'.$email.'" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label">Số điện thoại</label>
                      <div class="col-lg-9">
                        <input name="txtSDT" class="form-control" type="text" value="'.$sdt.'" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label">Địa chỉ</label>
                      <div class="col-lg-9">
                        <input name="txtDiaChi" class="form-control" type="text" value="'.$diachi.'" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label">Password</label>
                      <div class="col-lg-9">
                        <input name="txtPassWord" class="form-control" type="password" value="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label form-control-label"></label>
                      <div class="col-lg-9">
                        <input type="reset" class="btn btn-secondary" value="Reset">
                        <input type="submit" class="btn btn-primary" value="Lưu">
                      </div>
                    </div>
                </div>
            </div>
          <div style="clear: both"></div>
          </form>
        </main>';
        ?>
    <?php
        include('./php/footer.php');
        ?>
  </div>
</body>

</html>
