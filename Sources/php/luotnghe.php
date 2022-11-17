<?php
    $idbaihat=$_POST["idbaihat"];
    include('./connect.php');
    $update=mysqli_query($con,"UPDATE baihat set luotnghe=luotnghe+1 where id='$idbaihat'");
    if($update){
        echo "Thành công";
    }else{
        echo "Lỗi";
    }
    mysqli_close($con);
?>