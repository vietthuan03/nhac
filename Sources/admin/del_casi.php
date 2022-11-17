<<?php
    $id = $_GET["id"];

    include("../php/connect.php");
    mysqli_query($con,"Delete from casi where id=$id");
    mysqli_query($con,"UPDATE baihat SET idcasi = 8 WHERE idcasi =$id");
    header('location:casi.php');
    mysqli_close($con);

?>