<?php
    $id = $_GET["id"];
    //moconnect
    include('../php/connect.php');

    //truyvan
    mysqli_query($con,"Delete from baihat where id = '$id'");
    echo "Xoá thành công";
    header('location:baihat.php');
    //dongketnoi
    mysqli_close($con);
?>