<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Album</title>
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
                    $resultcd = mysqli_query($con,"SELECT tenalbum FROM album where id = '$id'");
                    $rowcd = mysqli_fetch_assoc($resultcd);
                    mysqli_close($con);
                    echo "<h3>Album $rowcd[tenalbum]</h3>";
                    ?>
                </div><hr>
                <div class="list-group">
                <ul id="listbaihat" class="p-0" style="list-style:none;">
                <?php
                    require('./php/connect.php');
                    $sql = "SELECT * FROM v_baihat where idalbum = '$id'" ;
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
            alert('B???n ph???i ????ng nh???p ????? s??? d???ng ch???c n??ng n??y!');
        });
    </script>
</body>

</html>
