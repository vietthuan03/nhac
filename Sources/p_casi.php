<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ca sĩ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./css/hover.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/jquery.paginate.css">
    <link rel="stylesheet" href="./css/fixbody.css">
    <link rel="stylesheet" href="./css/like.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery.paginate.js"></script>
    <script src="./js/like.js"></script>
    <style>
        .nav-tabs .nav-link.active {
            background-color:#eee;
            border-bottom:#eee;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fullwidth">
        <?php
        session_start();
        include('./php/header.php');
        ?>
        <main class="col-md-11 m-auto">
            <div class="left col-md-8 float-left">
            <div class="text-md-left mt-5">
                <?php 
                    $id = $_GET["id"];
                    require('./php/connect.php');
                    $resultcd = mysqli_query($con,"SELECT tencasi FROM casi where id = '$id'");
                    $rowcd = mysqli_fetch_assoc($resultcd);
                    mysqli_close($con);
                    echo "<h3>Ca sĩ $rowcd[tencasi]</h3>";
                    ?>
                </div><hr>
            <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home"><b>Bài hát</b></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1"><b>Tiểu sử</b></a>
            </li>
            </ul>
        <div class="tab-content bg-white rounded-bottom">
            <div id="home" class="container tab-pane active rounded-bottom" style="background:#eee"><br>
                <div class="list-group">
                <ul id="listbaihat" class="p-0" style="list-style:none;">
                <?php
                    require('./php/connect.php');
                    $sql = "SELECT * FROM v_baihat where idcasi = '$id'" ;
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $tenbaihat = $row['tenbaihat'];
                        $anh = $row['image'];
                        $casi = $row['tencasi'];
                        $luotnghe = $row['luotnghe'];
                        echo '<li><a href="./playnhac.php?id='.$row['id'].'" class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                            <span>
                                <img class="float-left mr-2" src="./'.$anh.'" width="50px">
                            </span>
                            <div class="item_title font-weight-bold">'.$tenbaihat.'</div>
                            <div class="box_items">
                                <span class="item_span mr-5">
                                    <img src="./image/views.png" width="18px">
                                    <span style="font-size:13px;">'.$luotnghe.'</span>
                                </span>
                                <span>
                                    <span style="font-size:13px;">'.$casi.'</span>
                                </span>
                            </div>
                        </a><div class="dlike">';
                        if(isset($_SESSION['id'])){
                            $iduser = $_SESSION['id'];
                            $results = mysqli_query($con, "SELECT * FROM likes WHERE iduser=$iduser AND idbaihat=".$row['id']."");
                                if (mysqli_num_rows($results) == 1 ):
                                    echo "<span class='unlike fa fa-thumbs-up' data-id='$row[id]'></span>
                                    <span class='like d-none fa fa-thumbs-o-up' data-id='$row[id]'></span>";
                                else:
                                    echo "<span class='like fa fa-thumbs-o-up' data-id='$row[id]'></span> 
                                    <span class='unlike d-none fa fa-thumbs-up' data-id='$row[id]'></span>";
                                endif;
                                echo "<span class='likes_count'>$row[likes]</span>";
                            echo "</div></li>";
                        }else{
                            echo "<span class='yclogin fa fa-thumbs-o-up'></span>";
                            echo "<span class='likes_count'>$row[likes]</span>";
                            echo "</div></li>";
                        }
                    }
                    mysqli_close($con);
                ?>
                </ul>
                </div>
            </div>
            <div id="menu1" class="container tab-pane fade rounded-bottom pb-5 pl-5 pr-5" style="background:#eee"><br>
                <?php
                    require('./php/connect.php');
                    $sqlcs = "SELECT * FROM casi where id='$id'" ;
                    $resultcs = mysqli_query($con,$sqlcs);
                    $rowcs = mysqli_fetch_assoc($resultcs);
                    echo "<div class='text-md-left'>
                                <h4>Tiểu sử ca sĩ $rowcs[tencasi]</h4>
                            </div><hr>";
                    echo "<img class='img-thumbnail ml-5 mb-5' align='right' style='width:200px;' src='./$rowcs[image]'>
                            <div class=''>$rowcs[tieusu]</div>";
                    mysqli_close($con);
                ?>
            </div>
        </div>
                
            </div>
            <div class="right col-md-4 float-right">
            <?php include('./php/menuright.php');?>
            </div>
            <div style="clear: both"></div>
        </main>
        <?php
        include('./php/footer.php');
        ?>
    </div>
    <script>
        $('#listbaihat').paginate({
			  perPage:10 
		});
        $('.yclogin').on('click', function(){
            alert('Bạn phải đăng nhập để sử dụng chức năng này!');
        });
    </script>
</body>

</html>
