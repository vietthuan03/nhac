<style>
    .item_title{
        width: 200px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-weight:bold;
    }
    .rg{
        width: 200px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-weight:bold;
    }
</style>
<div class="w-100 mt-3 p-1 bg-light rounded"><img class="w-100" src="./image/score.jpg" alt="Ảnh"></div>
    <hr>
    <div class="text-md-left mt-3">
            <h5>Album nghe nhiều</h5>
        </div><hr>
    <div class="list-group">
        <ul id="listbaihat" class="p-0" style="list-style:none;">
            <?php require('./php/connect.php');
            $sql = "SELECT a.id,a.tenalbum,a.image, SUM(vb.luotnghe) AS tongluotnghe FROM album a INNER JOIN v_baihat vb ON a.id = vb.idalbum GROUP BY a.id ORDER BY (tongluotnghe) DESC" ;
            $result = mysqli_query($con,$sql);
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                $tenalbum = $row['tenalbum'];
                $anh = $row['image'];
                $luotnghe = $row['tongluotnghe'];
                echo '<a href="./p_album.php?id='.$row['id'].'" class="list-group-item list-group-item-action flex-column align-items-start mb-2 p-1 rounded">
                    <span>
                        <img class="float-md-left mr-2" src="./'.$anh.'" width="40px">
                    </span>
                    <div class="item_title">'.$tenalbum.'</div>
                    <div class="box_items text-right">
                        <span class="item_span">
                            <img src="./image/views.png" width="20px">
                            <span style="font-size:13px;">'.$luotnghe.'</span>
                        </span>
                    </div>
                </a>';
                $i++;
            }
            mysqli_close($con);
            ?>
        </ul>
    </div>
    <hr>
<div class="text-md-left">
    <h5>Bài hát nghe nhiều</h5>
</div><hr>
<div class="list-group">
    <?php
        require('./php/connect.php');
        $sql = "SELECT * FROM v_baihat ORDER BY luotnghe DESC";
        $result = mysqli_query($con,$sql);
        $i=1;
        while(($row = mysqli_fetch_assoc($result)) && ($i<=10)){
            $tenbaihat = $row['tenbaihat'];
            $luotnghe = $row['luotnghe'];
            $cl='';
        switch ($i) {
            case 1:
                $cl='danger';
                break;
            case 2:
                $cl='success';
                break;
            case 3:
                $cl='primary';
                break;
            default:
                $cl='warning';
                break;
        }
        echo '<a href="./playnhac.php?id='.$row['id'].'" class="list-group-item list-group-item-action flex-column align-items-start mb-2 p-2 rounded">
                <span class="badge badge-pill badge-'.$cl.'">'.$i.'</span>
                <span class="ml-3 rg">'.$tenbaihat.'</span>
                <span class="item_span float-right">
                    <img src="./image/views.png" width="18px">
                    <span style="font-size:13px;">'.$luotnghe.'</span>
                </span>
            </a>';
        $i++;
        }
        mysqli_close($con);
    ?>
</div>
