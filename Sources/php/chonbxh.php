<?php
    session_start();
    $loai=$_POST['loai'];
    switch ($loai) {
        case 'chude':
        {
            echo '<div id="home" class="container tab-pane active rounded-bottom" style="background:#eee"><br>
                <div class="list-group">
                <ul id="listbaihat" class="p-0" style="list-style:none;">';
                    require('./connect.php');
                    $sql = "SELECT c.id,c.tenchude,c.image, SUM(vb.luotnghe) AS tongluotnghe FROM chude c INNER JOIN v_baihat vb ON c.id = vb.idchude GROUP BY c.id ORDER BY (tongluotnghe) DESC" ;
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $tenchude = $row['tenchude'];
                        $anh = $row['image'];
                        $luotnghe = $row['tongluotnghe'];
                        echo '<a href="./p_album.php?id='.$row['id'].'" class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                            <span>
                                <img class="float-md-left mr-2" src="./'.$anh.'" width="55px">
                            </span>
                            <div class="item_title font-weight-bold">'.$tenchude.'</div>
                            <div class="box_items text-right">
                                <span class="item_span mr-5">
                                    <img src="./image/views.png" width="40px">
                                    <span style="font-size:13px;">'.$luotnghe.'</span>
                                </span>
                            </div>
                        </a>';
                    }
               echo '</ul>
               <script>
               $("#listbaihat").paginate({
                        perPage:10 
                });
               </script>
                </div>
            </div>
            <div id="menu1" class="container tab-pane fade rounded-bottom" style="background:#eee"><br>
            <div class="list-group">
                <ul id="listbaihat1" class="p-0" style="list-style:none;">';
                $sql = "SELECT c.id,c.tenchude,c.image, SUM(vb.likes) AS tonglikes FROM chude c INNER JOIN v_baihat vb ON c.id = vb.idchude GROUP BY c.id ORDER BY (tonglikes) DESC" ;
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $tenchude = $row['tenchude'];
                    $anh = $row['image'];
                    $luotlikes = $row['tonglikes'];
                    echo '<a href="./p_album.php?id='.$row['id'].'" class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                        <span>
                            <img class="float-md-left mr-2" src="./'.$anh.'" width="55px">
                        </span>
                        <div class="item_title font-weight-bold">'.$tenchude.'</div>
                        <div class="box_items text-right">
                            <span class="item_span mr-5">
                                <span class="fa fa-thumbs-o-up"></span>
                                <span style="font-size:13px;">'.$luotlikes.'</span>
                            </span>
                        </div>
                    </a>';
                }
                    mysqli_close($con);
               echo '</ul>
               <script>
               $("#listbaihat1").paginate({
                        perPage:10 
                });
               </script>
                </div>
            </div>';
            break;
        }
        case 'album':
        {
            echo '<div id="home" class="container tab-pane active rounded-bottom" style="background:#eee"><br>
                <div class="list-group">
                <ul id="listbaihat" class="p-0" style="list-style:none;">';
                    require('./connect.php');
                    $sql = "SELECT a.id,a.tenalbum,a.image, SUM(vb.luotnghe) AS tongluotnghe FROM album a INNER JOIN v_baihat vb ON a.id = vb.idalbum GROUP BY a.id ORDER BY (tongluotnghe) DESC" ;
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $tenalbum = $row['tenalbum'];
                        $anh = $row['image'];
                        $luotnghe = $row['tongluotnghe'];
                        echo '<a href="./p_album.php?id='.$row['id'].'" class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                            <span>
                                <img class="float-md-left mr-2" src="./'.$anh.'" width="55px">
                            </span>
                            <div class="item_title font-weight-bold">'.$tenalbum.'</div>
                            <div class="box_items text-right">
                                <span class="item_span mr-5">
                                    <img src="./image/views.png" width="40px">
                                    <span style="font-size:13px;">'.$luotnghe.'</span>
                                </span>
                            </div>
                        </a>';
                    }
               echo '</ul>
               <script>
               $("#listbaihat").paginate({
                        perPage:10 
                });
               </script>
                </div>
            </div>
            <div id="menu1" class="container tab-pane fade rounded-bottom" style="background:#eee"><br>
            <div class="list-group">
                <ul id="listbaihat1" class="p-0" style="list-style:none;">';
                $sql = "SELECT a.id,a.tenalbum,a.image, SUM(vb.likes) AS tonglikes FROM album a INNER JOIN v_baihat vb ON a.id = vb.idalbum GROUP BY a.id ORDER BY (tonglikes) DESC" ;
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $tenalbum = $row['tenalbum'];
                    $anh = $row['image'];
                    $luotlikes = $row['tonglikes'];
                    echo '<a href="./p_album.php?id='.$row['id'].'" class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                        <span>
                            <img class="float-md-left mr-2" src="./'.$anh.'" width="55px">
                        </span>
                        <div class="item_title font-weight-bold">'.$tenalbum.'</div>
                        <div class="box_items text-right">
                            <span class="item_span mr-5">
                                <span class="fa fa-thumbs-o-up"></span>
                                <span style="font-size:13px;">'.$luotlikes.'</span>
                            </span>
                        </div>
                    </a>';
                }
                    mysqli_close($con);
               echo '</ul>
               <script>
               $("#listbaihat1").paginate({
                        perPage:10 
                });
               </script>
                </div>
            </div>';
            break;
        }    
        default:
        {
            echo '<div id="home" class="container tab-pane active rounded-bottom" style="background:#eee"><br>
                <div class="list-group">
                <ul id="listbaihat" class="p-0" style="list-style:none;">';

                    require('./connect.php');
                    $sql = "SELECT * FROM v_baihat ORDER BY luotnghe DESC" ;
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
               echo '</ul>
               <script>
               $("#listbaihat").paginate({
                        perPage:10 
                });
               </script>
                </div>
            </div>
            <div id="menu1" class="container tab-pane fade rounded-bottom" style="background:#eee"><br>
            <div class="list-group">
                <ul id="listbaihat1" class="p-0" style="list-style:none;">';
                    $sql = "SELECT * FROM v_baihat ORDER BY likes DESC" ;
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
               echo '</ul>
               <script>
               $("#listbaihat1").paginate({
                        perPage:10 
                });
               </script>
                </div>
            </div>';
            break;
        }
    }
?>