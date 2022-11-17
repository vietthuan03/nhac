<?php
    session_start();
    include('./connect.php');
    $userName = $_POST['txtlogin'] ;
    $passWord = $_POST['txtpasswordlogin'];
    $result = mysqli_query($con,"Select * from user where userName = '$userName'");
    if (mysqli_num_rows($result)==1) {
      $row = mysqli_fetch_assoc($result);
      $hash = $row["passWord"];
      $active = $row["active"];
      $_SESSION['level'] = $row['level'];
      if ($active==0) {
        echo "Tài khoản chưa kích hoạt. Kiểm tra email để kích hoạt tài khoản. <a href='../index.php'>Về trang chủ</a>";
      }else {
        if(password_verify($passWord, $hash))
        {
            $_SESSION['userName']=$userName;
            $_SESSION['id']=$row['id'];
            $_SESSION['avatar']=$row['avatar'];
            header("location:../index.php");
            exit();
        }
        else
        {
            echo 'Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại. <a href="javascript: history.go(-1)">Trở lại</a> sau... <span id="time"></span>';
            echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
            exit;
        }
      }
    }else {
      echo "Tài khoản không tồn tại. <a href='../index.php'>Về trang chủ</a>";
    }
    mysqli_close($con);
?>
