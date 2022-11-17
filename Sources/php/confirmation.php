<?php
    include('./connect.php');
    $passkey=$_GET['passkey'];
    $result = mysqli_query($con,"SELECT * FROM user WHERE code ='$passkey'");
    if (mysqli_num_rows($result)==1) {
      $row = mysqli_fetch_assoc($result);
      $active = $row["active"];
      if ($active==1) {
        echo "Tài khoản đã được kích hoạt từ trước.<a href='../index.php'>Đi đến trang chủ</a>";
      }else {
        $result1 = mysqli_query($con,"UPDATE user SET active=1 WHERE code ='$passkey'");
        if ($result1) {
          echo "Kích hoạt thành công. Bây giờ bạn có thể đăng nhập tài khoản. <a href='../index.php'>Đi đến trang chủ</a>";
        }else {
          echo "Có lỗi xảy ra khi kích hoạt tài khoản. <a href='../index.php'>Đi đến trang chủ</a>";
        }
      }
    }else {
      echo 'Sai mã kích hoạt.Vui lòng thử lại.';
    }
    mysqli_close($con);
 ?>
