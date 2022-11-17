<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quên mật khẩu</title>
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
                include('./php/connect.php');
                $email = addslashes($_POST['txtEmail']);
                $code=md5(uniqid(rand()));
                function passGen($length,$nums){
                    $lowLet = "abcdefghijklmnopqrstuvwxyz";
                    $highLet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $numbers = "123456789";
                    $pass = "";
                    $i = 1;
                    While ($i <= $length){
                    $type = rand(0,1);
                    if ($type == 0){
                    if (($length-$i+1) > $nums){
                    $type2 = rand(0,1);
                    if ($type2 == 0){
                    $ran = rand(0,25);
                    $pass .= $lowLet[$ran];
                    }else{
                    $ran = rand(0,25);
                    $pass .= $highLet[$ran];
                    }
                    }else{
                    $ran = rand(0,8);
                    $pass .= $numbers[$ran];
                    $nums--;
                    }
                    }else{
                    if ($nums > 0){
                    $ran = rand(0,8);
                    $pass .= $numbers[$ran];
                    $nums--;
                    }else{
                    $type2 = rand(0,1);
                    if ($type2 == 0){
                    $ran = rand(0,25);
                    $pass .= $lowLet[$ran];
                    }else{
                    $ran = rand(0,25);
                    $pass .= $highLet[$ran];
                    }
                    }
                    }
                    $i++;
                    }
                    return $pass;
                    }

                $password=passGen(6,2);
                if (mysqli_num_rows(mysqli_query($con,"SELECT email FROM user WHERE email='$email'")) <1)
                {
                    echo "<h4 style='color:red;'>Tài khoản không tồn tại.Vui lòng nhập Email hợp lệ.</h4>";
                    exit();
                }
                function generate_token() {
                    return md5(microtime().mt_rand());
                }
                $options = [
                    'salt' => generate_token(),
                    'cost' => 12
                ];
                $hash = password_hash($password, PASSWORD_DEFAULT, $options);
                @$addmember = mysqli_query($con,"UPDATE user SET password='{$hash}' where email='{$email}'");
                mysqli_close($con);
                if ($addmember){

                    $to=$email;
                    // Chủ Đề
                    $subject="Quên mật khẩu";
                    // From
                    $header="from: NhacOnline <vietthuan954@gmail.com>";
                    // Your message
                    $message="Mật khẩu mới của bạn là: $password";
                    // Gủi mail
                    $sentmail = mail($to,$subject,$message,$header);

                    if ($sentmail) {
                        echo "<h4 style='color:blue;'>Kiểm tra email để lấy mật khẩu mới.</h4>";
                    }else {
                        echo "<h4 style='color:red;'>Có lỗi xảy ra khi gửi mail.</h4>";
                    }
                }
                else{
                    echo "<h4 style='color:red;'>Có lỗi xảy ra khi gửi mail.</h4>";
                }
            }
        ?>
        </div>
        <div class="col-md-6 m-auto mb-5">
        <div class="text-center my-5">
            <b>KHÔI PHỤC MẬT KHẨU!</b>
        </div>
        <form class="mb-5" action="./quenmatkhau.php" method="POST">
        <div class="form-group">
        <input type="email" class="form-control" name="txtEmail" aria-describedby="emailHelp" placeholder="Nhập email tài khoản">
        </div>
        <button type="submit" name="ok" class="btn btn-primary">Lấy lại mật khẩu</button>
        </form>
        </div>
    </div>
    <?php
    include('./php/footer.php');
    ?>
</body>
</html>