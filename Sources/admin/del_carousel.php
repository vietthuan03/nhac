<<?php
    $id = $_GET["id"];

    include("../php/connect.php");
    mysqli_query($con,"Delete from carousel where id=$id");
    header('location:admin.php');
    mysqli_close($con);

?>
