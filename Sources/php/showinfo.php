<?php
    $id=$_POST['id'];
    include('./connect.php');
    $sql2=mysqli_query($con,"select*from v_baihat where id='$id'");
    $row2=mysqli_fetch_assoc($sql2);
    mysqli_close($con);
    echo'<img class ="float-left mr-3" src="./'.$row2['image'].'" width="100px">
    <h4>'.$row2['tenbaihat'].'</h4>
    <label for="">Trình bày:</label>
    '.$row2['tencasi'].'
    <br>
    <label for="">Lượt nghe:</label>
    '.$row2['luotnghe'].'';
    echo "<div class='container-audio mt-5 ml-3'>";
        for ($i=0; $i < 37; $i++) { 
            echo "<div class='colum1'>
                <div class='row'></div>
            </div>";
        }
    echo"</div>";
?>