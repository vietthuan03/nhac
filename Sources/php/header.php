<link rel="stylesheet" href="./css/header.css">
<header>
  <nav class="navbar navbar-default navbar-expand-lg navbar-light">
    <div class="navbar-header d-flex col">

      <a class="navbar-brand" href="./index.php"><span><img class="mr-2" src="./image/logo.png" width="150px"></span></a>
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
        <span class="navbar-toggler-icon"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
      <ul class="nav navbar-nav">
        <li class="nav-item"><a href="./baihat.php" class="nav-link"><b>Bài hát</b></a></li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="./chude.php"><b class="caret">Chủ đề</b></a>
          </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="./bxh.php"><b class="caret">BXH</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./album.php"><b class="caret">Album</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./casi.php"><b class="caret">Ca sĩ</b></a>
        </li>
        
      </ul>
      <form action="./timkiem.php" class="navbar-form form-inline" method="post">
        <div class="input-group search-box">
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" name="keyword" type="text" placeholder="Tìm kiếm..." aria-label="Tìm kiếm..." required="required">
            <button class="btn btn-outline-success my-2 my-sm-0" name="ok" type="submit">Tìm kiếm</button>
          </form>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right ml-auto">

        <?php
            if(isset($_SESSION['userName']))
                    {
                      if($_SESSION['level']==2){
                        echo '<li class="nav-item">
                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Chào,&nbsp;'.$_SESSION['userName'].'</a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                  <li><a href="./admin/admin.php" class="dropdown-item">Trang quản trị</a></li>
                                  <li><a href="./canhan.php" class="dropdown-item">Trang cá nhân</a></li>
                                  <li><a href="./doimatkhau.php" class="dropdown-item">Đổi mật khẩu</a></li>
                                  <li><a href="./php/xulydangxuat.php" class="dropdown-item">Đăng Xuất</a></li>
                                </ul>
                            </li>';
                      }else{
                        echo '<li class="nav-item">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Chào,&nbsp;'.$_SESSION['userName'].'</a>
                            <ul class="dropdown-menu dropdown-menu-right">
                              <li><a href="./canhan.php" class="dropdown-item">Trang cá nhân</a></li>
                              <li><a href="./doimatkhau.php" class="dropdown-item">Đổi mật khẩu</a></li>
                              <li><a href="./php/xulydangxuat.php" class="dropdown-item">Đăng Xuất</a></li>
                            </ul>
                        </li>';
                      }
                    }
                    else{
                        echo '<li class="nav-item">
                        <a data-toggle="dropdown" class="nav-link dropdown-toggle mt-1" href="#">Đăng nhập</a>
                        <ul class="dropdown-menu form-wrapper">
                            <li>
                                <form action="./php/xulydangnhap.php" method="post">
                                    <div class="form-group">
                                        <input type="text" name="txtlogin" class="form-control" placeholder="Tên đăng nhập" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="txtpasswordlogin" class="form-control" placeholder="Mật khẩu" required="required">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Đăng nhập">
                                    <div class="form-footer">
                                        <a href="./quenmatkhau.php">Quên mật khẩu?</a>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle get-started-btn">Đăng
                            ký</a>
                        <ul class="dropdown-menu form-wrapper">
                            <li>
                            <form action="./php/dangky.php" method="post">
                                    <p class="hint-text">Điền thông tin để đăng ký!</p>
                                    <div class="form-group">
                                        <input type="text" name="txtUsername" class="form-control" placeholder="Tên đăng nhập" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="txtPassword" class="form-control" placeholder="Mật khẩu" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="txtPasswordCF" class="form-control" placeholder="Xác nhân mật khẩu"
                                            required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="txtEmail" class="form-control" placeholder="Email"
                                            required="required">
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline"><input type="checkbox" required="required"> Tôi đồng
                                            ý các <a href="#">Điều khoản &amp; Điều kiện</a></label>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Đăng ký">
                                </form>
                            </li>
                        </ul>
                    </li>';

                    };
            ?>

      </ul>
    </div>
  </nav>

</header>
<script type="text/javascript">
  $(document).on("click", ".navbar-right .dropdown-menu", function(e) {
    e.stopPropagation();
  });
</script>
