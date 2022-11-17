<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang Quản Trị comment</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/fix.css">
</head>

<body>
    <?php
        session_start();
        include('header.php');
    ?>
    <main class="col-md-10 m-auto">

    <div class="card mb-3 mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Time</th>
                            <th>Link</th>
                            <th>Duyệt</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Time</th>
                            <th>Link</th>
                            <th>Duyệt</th>
                            <th>Xoá</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        include('../php/connect.php');
                        $stt=1;
                        $result = mysqli_query($con,"SELECT u.hoten,c.id,c.thoigian,c.noidung,c.duyet,c.idbaihat FROM comment c INNER JOIN user u ON c.iduser = u.id");
                        While($data = mysqli_fetch_assoc($result))
                        {
                            $sqltime=$data['thoigian'];
                            $timestamp=strtotime($sqltime);
                            $time=date('d-m-Y H:i',$timestamp);
                            echo "<tr>";
                            echo "<td style='width:50px;'>$stt</td>";
                            echo "<td style='width:150px;'>$data[hoten]</td>";
                            echo "<td>$data[noidung]</td>";
                            echo "<td style='width:130px;'>$time</td>";
                            echo "<td><a href='../playnhac.php?id=$data[idbaihat]' target='_blank' style='color:#09F;'>Xem</a></td>";
                            if($data['duyet']==0)
                            {
                                echo "<td><a href='./duyet.php?id=$data[id]&d=1'>Duyệt</a></td>";
                            }
                            else{
                                echo "<td><a href='./duyet.php?id=$data[id]&d=0' style='color:lime;'>Huỷ</a></td>";
                            }
                            echo "<td><a href='./del_comment.php?id=$data[id]' onclick=' return xacnhan();' style='color:red;'>Xoá</a></td>";
                            echo "</tr>";
                            $stt++;
                        }
                        mysqli_close($con);
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated by Admin</div>
    </div>
    </main>
    <?php
        include('footer.php');
    ?>
    <script src="js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/xacnhan.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script>
        $('#dataTable').DataTable();
    </script>
</body>

</html>