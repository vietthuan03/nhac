<?php 
    session_start();
	include('./connect.php');
    $iduser = $_SESSION['id'];
	if (isset($_POST['liked'])) {
		$idbaihat = $_POST['idbaihat'];
		$result = mysqli_query($con, "SELECT * FROM v_baihat WHERE id=$idbaihat");
		$row = mysqli_fetch_array($result);
        $n = $row['likes'];
		mysqli_query($con, "INSERT INTO likes (iduser, idbaihat) VALUES ($iduser, $idbaihat)");
		mysqli_query($con, "UPDATE baihat SET likes=$n+1 WHERE id=$idbaihat");
		echo $n+1;
		exit();
	}
	if (isset($_POST['unliked'])) {
		$idbaihat = $_POST['idbaihat'];
		$result = mysqli_query($con, "SELECT * FROM v_baihat WHERE id=$idbaihat");
		$row = mysqli_fetch_array($result);
		$n = $row['likes'];

		mysqli_query($con, "DELETE FROM likes WHERE idbaihat=$idbaihat AND iduser=$iduser");
		mysqli_query($con, "UPDATE baihat SET likes=$n-1 WHERE id=$idbaihat");
		
		echo $n-1;
		exit();
    }
    mysqli_close($con);
?>