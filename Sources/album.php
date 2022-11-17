<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Album</title>
    <link rel="stylesheet" href="./css/hover.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fixbody.css">
	<link rel="stylesheet" href="./css/jquery.paginate.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery.paginate.js"></script>
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
                    <h3>Album</h3>
                </div><hr>
                <div class="row" id="listbaihat">
                <?php
                    require('./php/connect.php');
                    $sql = "SELECT * FROM album";
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $tenalbum = $row['tenalbum'];
                        $image=$row['image'];
                        echo '<div class="col-lg-3 col-md-4 img-hover">
                                <a href="p_album.php?id='.$row['id'] .'" class="d-block mb-4 h-100" style="text-decoration: none;">
                                <div><img class="img-fluid img-thumbnail " src="./'.$image.'" alt=""></div>
                                <div class="mt-2" style="color: black;">'.$tenalbum.'</div>
                                </a>
                            </div>';
                    }
                    mysqli_close($con);
                    ?>
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

    </div><script>
        $('#listbaihat').paginate({
            scope: $('div'),
			  perPage:16
		});
    </script>
</body>

</html>
