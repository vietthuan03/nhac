<?php
    session_start();
    $id = $_GET['id'];
    $d = $_GET['d'];
    include("../php/connect.php");
    mysqli_query($con,"UPDATE comment SET duyet=$d where id='$id'");
    mysqli_close($con);
    header('location:comment.php');
?>