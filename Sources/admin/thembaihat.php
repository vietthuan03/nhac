<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm bài hát</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/fix.css">
</head>

<body>
    <?php
        session_start();
        include('header.php');
    ?>
    <div class="col-md-8 m-auto pt-5 text-center">
    <?php
		if(isset($_POST['up']))
		{
			
			$tenbaihat=$_POST['tenbaihat'];
			$tcasi=$_POST['casi'];
			$tchude=$_POST['chude'];
			$talbum=$_POST['album'];
			$file_name=$_FILES['upload']['name'];
			$image=$_FILES['uploadimg']['name'];
			$pattern='#.+\.(mp3)$#i';
            $pattern1='#\.(jpg|jpeg|gif|png)$#i';
            
            if ($_FILES['uploadimg']['size'] < 4000000)
            {
                if(preg_match($pattern,$file_name)==1)
                {
                    if(preg_match($pattern1,$image)==1)
                    {
                        if (isset($_FILES['upload']) && isset($_FILES['uploadimg'])) {
                            if ($_FILES['upload']['error'] > 0)
                                echo "Upload lỗi rồi!";
                            else {
                                move_uploaded_file($_FILES['upload']['tmp_name'], '../nhac/' . $_FILES['upload']['name']);	
                                move_uploaded_file($_FILES['uploadimg']['tmp_name'], '../image/' . $_FILES['uploadimg']['name']);
                                
                            }
                        }

                        $destck='../nhac/'.$_FILES['upload']['name'];
                        $destck1='../image/'.$_FILES['uploadimg']['name'];
                        $dest='nhac/'.$_FILES['upload']['name'];
                        $dest1='image/'.$_FILES['uploadimg']['name'];
                        if(file_exists($destck) && file_exists($destck1))
                        {	
                            include('../php/connect.php');
                            $re=mysqli_query($con,"SELECT ab.id AS idab,cs.id AS idcs,cd.id AS idcd FROM album ab,casi cs,chude cd WHERE ab.tenalbum = '$talbum' AND cs.tencasi = '$tcasi' AND cd.tenchude = '$tchude'");
                            $rowi=mysqli_fetch_assoc($re);
                            $idalbum = $rowi['idab'];
                            $idcasi = $rowi['idcs'];
                            $idchude = $rowi['idcd'];
                            $update=mysqli_query($con,"INSERT INTO baihat(tenbaihat,path,image,idalbum,idcasi,idchude) VALUES('$tenbaihat','$dest','$dest1','$idalbum','$idcasi','$idchude')");
                            mysqli_close($con);
                            if($update)
                            {
                                echo "<h3 style='color:blue;'>Bài hát của bạn đã được đăng...</h3>";
                            }
                            else
                            {
                                echo "<h3 style='color:red;'>Đăng nhạc thất bại!</h3>";
                            }
                        }
                        else
                        {
                            echo "<h3 style='color:red;'>Đăng nhạc thất bại!</h3>";
                        }
                    }
                    else
                    {
                        echo "<h3 style='color:red;'>Sai định dạng file anh!</h3>";
                    }
                }
                else
                {
                    echo "<h3 style='color:red;'>Sai định dạng file nhac!</h3>";
                }
            }
            else
            {
            echo "<h3 style='color:red;'>Dung lượng ảnh quá lớn!</h3>";
            }
        }
    ?>
    </div>
    <main class="col-md-8 m-auto p-5">
          <form class="" action="./thembaihat.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="row"><div class="col-md-12 text-center mb-3"><label style="font-size:24px">Thêm bài hát</label></div></div>
                    <div class="form-group row">
                        <label class="col-md-3 mt-3 col-form-label form-control-label">Nhạc:</label>
                        <div class="col-md-9">
                        <label class="custom-file">
                            <input type="file" id="nhac" name="upload" class="custom-file-input">
                            <label class="custom-file-label text-left mt-3" for="anh">Chọn đường dẫn đến nhạc...</label>
                        </label>
                        </div>
                        <label class="col-md-3 mt-3 col-form-label form-control-label">Ảnh:</label>
                        <div class="col-md-9">
                        <label class="custom-file">
                            <input type="file" id="anh" name="uploadimg" class="custom-file-input">
                            <label class="custom-file-label text-left mt-3" for="anh">Chọn đường dẫn đến ảnh...</label>
                        </label>
                        </div>
                        <label class="col-md-3 mt-3 col-form-label form-control-label">Tên bài hát:</label>
                        <div class="col-md-9">
                                <input name="tenbaihat" class="form-control mt-3" type="text" required="required">
                        </div>
                        <label class="col-md-3 mt-3 col-form-label form-control-label">Ca sĩ:</label>
                        <div class="col-md-9">
                            <select class="custom-select mr-sm-2 mt-3" id="casi" name="casi">
                                <?php
                                    include("../php/connect.php");
                                    $casi=mysqli_query($con,"select * from casi");
									while($row=mysqli_fetch_assoc($casi)){
										echo '<option>'.$row['tencasi'].'</option>';
                                    }
                                    mysqli_close($con);
								?>
                            </select>
                        </div>
                        <label class="col-md-3 mt-3 col-form-label form-control-label">Chủ đề:</label>
                        <div class="col-md-9">
                            <select class="custom-select mr-sm-2 mt-3" id="chude" name="chude">
                                <?php
                                    include("../php/connect.php");
                                    $chude=mysqli_query($con,"select * from chude");
									while($row=mysqli_fetch_assoc($chude)){
										echo '<option>'.$row['tenchude'].'</option>';
                                    }
                                    mysqli_close($con);
								?>
                            </select>
                        </div>
                        <label class="col-md-3 mt-3 col-form-label form-control-label">album:</label>
                        <div class="col-md-9">
                            <select class="custom-select mr-sm-2 mt-3" id="album" name="album">
                                <?php
                                    include("../php/connect.php");
                                    $album=mysqli_query($con,"select * from album");
									while($row=mysqli_fetch_assoc($album)){
										echo '<option>'.$row['tenalbum'].'</option>';
                                    }
                                    mysqli_close($con);
								?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-5">
                      <label class="col-lg-3 col-form-label form-control-label"></label>
                      <div class="col-lg-9">
                        <input type="reset" class="btn btn-secondary" value="Reset">
                        <input type="submit" name="up" class="btn btn-primary" value="Thêm">
                      </div>
                    </div>
                </div>
            </div>
          <div style="clear: both"></div>
          </form>
        </main>
    <?php
        include('footer.php');
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/xacnhan.js"></script>
</body>

</html>