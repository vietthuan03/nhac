<<?php
    $id = $_GET["id"];

    include("../php/connect.php");
    mysqli_query($con,"Delete from album where id=$id");
    mysqli_query($con,"UPDATE baihat SET idalbum = 2 WHERE idalbum =$id");
    header('location:album.php');
    mysqli_close($con);

?>