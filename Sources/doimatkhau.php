<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đổi mật khẩu</title>
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
            <div class="col-md-8 m-auto pt-5 text-center">
            <?php
            if(isset($_POST['ok'])){
                $userName = $_SESSION['userName'];
                $passwordold   = addslashes($_POST['txtPasswordOLD']);
                $password   = addslashes($_POST['txtPassword']);
                $passwordcf = addslashes($_POST['txtPasswordCF']);
                function generate_token() {
                    return md5(microtime().mt_rand());
                }
                $options = [
                    'salt' => generate_token(),
                    'cost' => 12
                ];
                $hash = password_hash($password, PASSWORD_DEFAULT, $options);
                
                if ($password!=$passwordcf) {
                    echo "<h4 style='color:red;'>Mật khẩu và mật khẩu xác nhận không khớp. Vui lòng nhập lại.</h4>";
                }else{
                    include('./php/connect.php');
                    $result = mysqli_query($con,"Select * from user where userName = '$userName'");
                    $row = mysqli_fetch_assoc($result);
                    $hashpass = $row["passWord"];
                    if(password_verify($passwordold, $hashpass))
                    {
                        $update = mysqli_query($con,"UPDATE user SET password='{$hash}' where userName='{$userName}'");
                        if($update){
                            echo "<h4 style='color:blue;'>Đổi mật khẩu thành công</h4>";
                        }else{
                            echo "<h4 style='color:red;'>Đổi mật khẩu thất bại!</h4>";
                        }
                    }
                    else
                    {
                        echo "<h4 style='color:red;'>Sai mật khẩu. Vui lòng thử lại.</h4>";
                    }
                    mysqli_close($con);
                }      
            }
            ?>
            </div>
        <div class="col-md-6 m-auto mb-5">
        <form class="" action="./doimatkhau.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-10 m-auto">
                    <div class="row"><div class="col-md-12 text-center mb-3"><label style="font-size:24px">Đổi mật khẩu</label></div></div>
                    <div class="form-group row">
                        <label class="col-md-4 mb-3 col-form-label form-control-label">Mật khẩu cũ:</label>
                        <div class="col-md-8">
                                <input name="txtPasswordOLD" class="form-control" type="password" required="required">
                        </div>
                        <label class="col-md-4 mb-3 col-form-label form-control-label">Mật khẩu mới:</label>
                        <div class="col-md-8">
                                <input name="txtPassword" class="form-control" type="password" required="required">
                        </div>
                        <label class="col-md-4 col-form-label form-control-label">Nhập lại mật khẩu:</label>
                        <div class="col-md-8">
                                <input name="txtPasswordCF" class="form-control" type="password" required="required">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                      <label class="col-lg-3 col-form-label form-control-label"></label>
                      <div class="col-lg-9">
                        <input type="reset" class="btn btn-secondary" value="Reset">
                        <input type="submit" name="ok" class="btn btn-primary" value="Cập nhật">
                      </div>
                    </div>
                </div>
            </div>
          <div style="clear: both"></div>
          </form>
    </div>
    <?php
    include('./php/footer.php');
    ?>
</body>
</html>