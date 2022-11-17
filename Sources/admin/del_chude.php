<<?php
    $id = $_GET["id"];

    include("../php/connect.php");
    mysqli_query($con,"Delete from chude where id=$id");
    mysqli_query($con,"UPDATE baihat SET idchude = 8 WHERE idchude =$id");
    header('location:chude.php');
    mysqli_close($con);

?>