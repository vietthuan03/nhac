<?php
    $id = $_GET["id"];
    include('../php/connect.php');
    mysqli_query($con,"Delete from user where id = '$id'");
    echo "Xoá thành công";
    header('location:user.php');

    mysqli_close($con);
?>