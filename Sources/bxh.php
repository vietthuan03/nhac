<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bảng Xếp Hạng</title>
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
        #listbaihat1 li a{
            float: left;
            width: 85%;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
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
                <h3>Bảng xếp hạng</h3>
                </div>
                <select name="bxh"class="custom-select w-25" onchange="loadbxh()" style="min-width:150px;" id="bxh">
                    <option selected value="baihat">Bài hát</option>
                    <option value="album">Album</option>
                    <option value="chude">Chủ đề</option>
                </select>
                <hr>
            <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home"><b>Lượt nghe</b></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1"><b>Lượt thích</b></a>
            </li>
            </ul>
        <div class="tab-content bg-white rounded-bottom" id="tabbxh"></div>
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
        $.ajax({
				url : "./php/chonbxh.php",
				type : "post",
				dataType:"text",
				data : {
						loai : 'baihat'
				},
				success : function (result){
                    $('#tabbxh').html(result);
				}
			});
        function loadbxh(){
			$.ajax({
				url : "./php/chonbxh.php",
				type : "post",
				dataType:"text",
				data : {
						loai : $('#bxh').val()
				},
				success : function (result){
                    $('#tabbxh').html(result);
				}
			});
		}
        $('#listbaihat').paginate({
			  perPage:10 
        });
        $('#listbaihat1').paginate({
			  perPage:10 
        });
        $('.yclogin').on('click', function(){
            alert('Bạn phải đăng nhập để sử dụng chức năng này!');
        });
    </script>
</body>

</html>
