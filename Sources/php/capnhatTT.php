<?php
    session_start();
    include('./connect.php');
    $userName = $_SESSION['userName'];
    $hoten    = addslashes($_POST['txtHoTen']);
    $gioiTinh = addslashes($_POST['slGioiTinh']);
    $ngaysinh = addslashes($_POST['txtNgaySinh']);
    $email    = addslashes($_POST['txtEmail']);
    $password = addslashes($_POST['txtPassWord']);
    $sdt      = addslashes($_POST['txtSDT']);
    $diachi   = addslashes($_POST['txtDiaChi']);
    $image    = $_FILES['uploadimg']['name'];
    $pattern  = '#\.(jpg|jpeg|gif|png)$#i';
    if ($_FILES['uploadimg']['size'] < 4000000) {
        if (preg_match($pattern, $image) == 1) {
            if (isset($_FILES['uploadimg'])) {
                if ($_FILES['uploadimg']['error'] > 0)
                    echo "Upload lỗi rồi!";
                else {
                    move_uploaded_file($_FILES['uploadimg']['tmp_name'], '../image/' . $_FILES['uploadimg']['name']);
                }
            }
            $destck = '../image/' . $_FILES['uploadimg']['name'];
            $dest   = 'image/' . $_FILES['uploadimg']['name'];
            if (file_exists($destck)) {
                $result = mysqli_query($con, "Select * from user where userName = '$userName'");
                $row    = mysqli_fetch_assoc($result);
                $hash   = $row["passWord"];
                if (password_verify($password, $hash)) {
                    @$addmember = mysqli_query($con, "UPDATE user
                                SET hoten='{$hoten}',
                                gioitinh='{$gioiTinh}',
                                ngaysinh='{$ngaysinh}',
                                sdt='{$sdt}',
                                diachi='{$diachi}',
                                avatar='{$dest}'
                                where userName = '{$userName}'
                                ");
                    mysqli_close($con);
                    if ($addmember) {
                        echo 'Cập nhật thành công. <a href="javascript: history.go(-1)">Trở lại...</a> <span id="time"></span>';
                        echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
                        exit();
                    } else {
                        echo 'Có lỗi xảy ra trong quá trình cập nhật. <a href="javascript: history.go(-1)">Thử lại...</a> <span id="time"></span>';
                        echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
                        exit();
                    }
                } else {
                    echo 'Sai Mật khẩu. Vui lòng thử lại. <a href="javascript: history.go(-1)">Trở lại...</a><span id="time"></span>';
                    echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
                    exit();
                }
            } else {
                echo 'Có lỗi xảy ra trong quá trình cập nhật. <a href="javascript: history.go(-1)">Thử lại...</a> <span id="time"></span>';
                echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
                exit();
            }
        } else {
            $result = mysqli_query($con, "Select * from user where userName = '$userName'");
            $row    = mysqli_fetch_assoc($result);
            $hash   = $row["passWord"];
            if (password_verify($password, $hash)) {
                @$addmember = mysqli_query($con, "UPDATE user
                            SET hoten='{$hoten}',
                            gioitinh='{$gioiTinh}',
                            ngaysinh='{$ngaysinh}',
                            sdt='{$sdt}',
                            diachi='{$diachi}'
                            where userName = '{$userName}'
                            ");
                mysqli_close($con);
                if ($addmember) {
                    echo 'Cập nhật thành công. <a href="javascript: history.go(-1)">Trở lại...</a> <span id="time"></span>';
                    echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
                    exit();
                } else {
                    echo 'Có lỗi xảy ra trong quá trình cập nhật. <a href="javascript: history.go(-1)">Thử lại...</a> <span id="time"></span>';
                    echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
                }
            } else {
                echo 'Sai Mật khẩu. Vui lòng thử lại. <a href="javascript: history.go(-1)">Trở lại...</a><span id="time"></span>';
                echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
                exit();
            }
        }
    } else {
        echo 'Dung lượng ảnh quá lớn! <a href="javascript: history.go(-1)">Thử lại...</a> <span id="time"></span>';
        echo '<script src="../js/demnguoc.js" charset="utf-8"></script>';
        exit();
    }
?>