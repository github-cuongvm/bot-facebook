<?php
session_start();
include'config.php';
?>
<!DOCTYPE html>
<html>

<!-- Mirrored from webapplayers.com/luna_admin-v1.1/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Jul 2016 03:26:12 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>Bot cảm xúc <?php echo $version; ?></title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="vendor/toastr/toastr.min.css"/>

    <!-- App styles -->
    <link rel="stylesheet" href="styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="styles/stroke-icons/style.css"/>
    <link rel="stylesheet" href="styles/style.css">

    <script type="text/javascript" src="scripts/jquery.min.js"></script>

    <script type="text/javascript" src="scripts/login_facebook.js"></script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9134933101135736",
    enable_page_level_ads: true
  });
</script>


</head>
<body>

<!-- Wrapper-->
<div class="wrapper">

    <!-- Header-->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <div id="mobile-menu">
                    <div class="left-nav-toggle">
                        <a href="#">
                            <i class="stroke-hamburgermenu"></i>
                        </a>
                    </div>
                </div>
                <a class="navbar-brand" href="#">
                    BotFB
                    <span><?php echo $version; ?></span>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="left-nav-toggle">
                    <a href="#">
                        <i class="stroke-hamburgermenu"></i>
                    </a>
                </div>
                <form class="navbar-form navbar-left">
                    <input class="form-control" placeholder="Bot Cảm Xúc" style="width: 175px">
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="profil-link">
                        <a href="https://www.facebook.com/nhocconsanhdieu">
                            <span style="text-transform: none;">Liên hệ Admin</span>
                            <img src="https://graph.fb.me/642941656/picture" class="img-circle" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End header-->

    <!-- Navigation-->
    <aside class="navigation">
        <nav>
            <ul class="nav luna-nav">
                <li class="nav-category">
                    Main
                </li>
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>

                <li>
                    <a href="#monitoring" data-toggle="collapse" aria-expanded="false">
                        Chức Năng<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                    </a>
                    <ul id="monitoring" class="nav nav-second collapse">
                        <li><a href="/"> Bot Cảm Xúc</a></li>
                    </ul>
                </li>
                <?php if ( isset($_SESSION['id']) ) { ?>
                    <li>
                    <a href="logout.php">Đăng Xuất</a>
                </li>
                <?php } ?>

                <li class="nav-info">
                    <i class="pe pe-7s-shield text-accent"></i>
                    <div class="m-t-xs">
                        <span class="c-white">BotFB</span> Phiên bản <?php echo $version; ?>  với tính năng mới lạ hơn, người dùng được chọn nhiều cảm xúc hơn để Bot auto.
                    </div>
                </li>
            </ul>
        </nav>
    </aside>
    <!-- End navigation-->


    <!-- Main content-->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                        <div class="pull-right text-right" style="line-height: 14px">
                            <small><?php echo $page_name; ?><br>Dashboard<br> <span class="c-white"><?php echo $version; ?></span></small>
                        </div>
                        <div class="header-icon">
                            <i class="pe page-header-icon pe-7s-shield"></i>
                        </div>
                        <div class="header-title">
                            <h3 class="m-b-xs"><?php echo $page_name; ?></h3>
                            <small>
                                Phiên bản Bot 1.0 dùng token, token dễ bị die nên lấy luôn bộ source trên mạng này để chạy cho tiện kkk
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <?php
            //    if( isset($_POST['cookie']) && !isset($_SESSION['id']))
            if( isset($_POST['cookie']))
            {
                $url = curl("https://m.facebook.com/profile.php",$_POST['cookie']);
                //echo $url;
                //exit;
                if(preg_match('#<title>(.+?)</title>#is',$url, $_puaru))
                {
                    $name = $_puaru[1];
                }
                if(preg_match('#name="target" value="(.+?)"#is',$url, $_puaru))
                {
                    $id = $_puaru[1];
                }
                if(preg_match('#name="fb_dtsg" value="(.+?)"#is',$url, $_puaru))
                {
                    $fb_dtsg = $_puaru[1];
                }
                if( isset($name) && isset($id) && isset($fb_dtsg))
                {
                    $_SESSION['id'] = $id;
                    $_SESSION['name'] = $name;
                    $_SESSION['fb_dtsg'] = $fb_dtsg;
                    $_SESSION['cookie'] = $_POST['cookie'];
                    ?>
                    <meta content="0; URL=index.php">
                    <?php

                } else {
                    die('<script>alert("Cookie này bị lỗi, hãy thử lại với cookie khác nhé ^^"); window.location.replace("index.php");</script>');
                }
            }


            if( isset($_POST['CamXuc']) && isset($_SESSION['id']))
            {
                if($_POST['CamXuc'] == 'tatbot')
                {
                    mysqli_query($connection, "
            DELETE FROM
               Account
            WHERE
               user_id='" . mysqli_real_escape_string($connection, $_SESSION['id']) . "' 
         ");
                    ?>
                    <meta content="0; URL=index.php">
                    <?php
                }
                else
                {
                    mysqli_query($connection, "CREATE TABLE IF NOT EXISTS `Account` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` varchar(32) NOT NULL,
      `name` varchar(32) NOT NULL,
      `fb_dtsg` text NOT NULL,
      `cookie` text NOT NULL,
      `camxuc` text NOT NULL,
      `comments` text NOT NULL,
      `battatcmt` varchar(32) NOT NULL,
      PRIMARY KEY (`id`)
      ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
   ");

                    $row = null;
                    $result = mysqli_query($connection, "
      SELECT
         *
      FROM
         Account
      WHERE
         user_id = '" . mysqli_real_escape_string($connection, $_SESSION['id']) . "'
   ");
                    if ($result){
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        if(mysqli_num_rows($result) > 100){
                            mysqli_query($connection, "
            DELETE FROM
               Account
            WHERE
               user_id='" . mysqli_real_escape_string($connection, $_SESSION['id']) . "' AND
               id != '" . $row['id'] . "'
         ");
                        }
                    }
                    if($_POST['battatcmt'] != 'tatcmt' && str_replace(' ', '', $_POST['comment']) !== '')
                    {
                        if(!$row){
                            mysqli_query($connection,
                                "INSERT INTO 
            Account
         SET
            `user_id` = '" . mysqli_real_escape_string($connection, $_SESSION['id']) . "',            
            `name` = '" . mysqli_real_escape_string($connection, $_SESSION['name']) . "',
            `fb_dtsg` = '" . $_SESSION['fb_dtsg'] . "',
            `camxuc` = '" . $_POST['CamXuc'] . "',
            `comments` = '" . $_POST['comment'] . "',
            `battatcmt` = '1',
            `cookie` = '" . $_SESSION['cookie'] . "'
      ");
                        } else {
                            mysqli_query($connection,
                                "UPDATE 
            Account
         SET
            `fb_dtsg` = '" . $_SESSION['fb_dtsg'] . "',            
            `camxuc` = '" . $_POST['CamXuc'] . "',
            `comments` = '" . $_POST['comment'] . "',
            `battatcmt` = '1',
            `cookie` = '" . $_SESSION['cookie'] . "'

         WHERE
            `id` = " . $row['id'] . "
      ");
                        }
                    }
                    else
                    {
                        if(!$row){
                            mysqli_query($connection,
                                "INSERT INTO Account SET
            `user_id` = '" . mysqli_real_escape_string($connection, $_SESSION['id']) . "',            
            `name` = '" . mysqli_real_escape_string($connection, $_SESSION['name']) . "',
            `fb_dtsg` = '" . $_SESSION['fb_dtsg'] . "',
            `camxuc` = '" . $_POST['CamXuc'] . "',
            `comments` = '',
            `battatcmt` = '0',
            `cookie` = '" . $_SESSION['cookie'] . "'
      ");
                        } else {
                            mysqli_query($connection,
                                "UPDATE 
            Account
         SET
            `fb_dtsg` = '" . $_SESSION['fb_dtsg'] . "',            
            `camxuc` = '" . $_POST['CamXuc'] . "',
            `comments` = '',
            `battatcmt` = '0',
            `cookie` = '" . $_SESSION['cookie'] . "'

         WHERE
            `id` = " . $row['id'] . "
      ");
                        }
                    }

                    ?>
                    <meta content="0; URL=index.php">
                    <?php
                }}

            function get($url){
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_URL, $url);
                $ch = curl_exec($curl);
                curl_close($curl);
                return $ch;
            }
            function curl($url,$cookie)
            {
                $ch = @curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                $head[] = "Connection: keep-alive";
                $head[] = "Keep-Alive: 300";
                $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
                $head[] = "Accept-Language: en-us,en;q=0.5";
                curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
                curl_setopt($ch, CURLOPT_ENCODING, '');
                curl_setopt($ch, CURLOPT_COOKIE, $cookie);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Expect:'
                ));
                $page = curl_exec($ch);
                curl_close($ch);
                return $page;
            }
            function post_data($site,$data,$cookie){
                $datapost = curl_init();
                $headers = array("Expect:");
                curl_setopt($datapost, CURLOPT_URL, $site);
                curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
                curl_setopt($datapost, CURLOPT_HEADER, TRUE);

                curl_setopt($datapost, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($datapost, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
                curl_setopt($datapost, CURLOPT_POST, TRUE);
                curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
                curl_setopt($datapost, CURLOPT_COOKIE,$cookie);
                ob_start();
                return curl_exec ($datapost);
//    ob_end_clean();
//    curl_close ($datapost);
//    unset($datapost);
            }
            ?>

            <div class="row">
<?php if( !isset($_SESSION['id']))
{
    ?>
                <div class="col-md-6">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1">Nhập Cookie</a></li>
                            <li><a data-toggle="tab" href="#menu2">Đăng nhập bằng tài khoản Facebook</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="menu1" class="tab-pane fade in active">
                                <div class="panel panel-filled">
                                    <div class="panel-body">
                                        <p> Nếu bạn muốn lấy cookie từ tài khoản facebook, hãy nhấn vào tab
                                            <code>Đăng nhập bằng tài khoản Facebook</code>

                                        <p>Dùng Cookie Để Hạn Chế Không Bao Giờ Die Token 100% </p>

                                        <form action="" method="POST">
                                            <div class="form-group"><label for="exampleInputEmail1">Cookie ( Cách Lấy Cookie Vui Lòng Xem Clip )</label> <input class="form-control" id="cookie" name="cookie" placeholder="Nhập cookie vào đây"></div>

                                            <button class="btn btn-default btn-block">Đăng nhập</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="panel panel-filled">
                                    <div class="panel-body">
                                        <p> Nhập thông tin tài khoản và mật khẩu Facebook của bạn. Nếu đăng nhập bằng số điện thoại thì
                                            nhớ thay số 0 ở đầu thành 84, sau đó chọn nền tảng bạn hay đăng nhập (PC hoặc Mobile) để tránh bị checkpoint trên thiết bị mới.<p>
                                        <p>Ví dụ: <code> 0123456789</code> đổi thành <code>84123456789</code></p>

                                        <p>Thông tin này chỉ dùng để lấy cookie, và sẽ không lưu lại trên Server nên yên tâm nhé ^^ </p>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Tên đăng nhập" id="user" title="Nhập tên đăng nhập hoặc số điện thoại vào đây">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="*******" type="password" id="pass" title="Nhập mật khẩu liền đi chứ lị">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" id="login_type" title="Chọn nền tảng bạn hay đăng nhập">
                                                <option value="1">Máy tính</option>
                                                <option value="2">Điện thoại</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-default" id="login">Lấy cookie ngay cho nóng</button>
                                        </div>
                                        <div id="login_result">

                                        </div>
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <input class="form-control" id="cookie1" name="cookie" placeholder="Cookie sẽ xuất hiện ở đây" style="text-align: center" autocomplete="off">
                                            </div>

                                            <button class="btn btn-default btn-block">Đăng nhập</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } else {

    $result =  mysqli_fetch_assoc(mysqli_query($connection, "select count(*) from `Account` where `user_id`='".$_SESSION['id']."' "));

    $dem = $result['count(*)'];
    if($dem == 0)
    {
        $tinhtrang = 'Bạn Chưa Cài BOT';
        $submitt ='Cài BOT';
    }
    else
    {
        $submitt ='Cập Nhật BOT';
        $camxuc='LIKE';

        $camxuccuaban = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM `Account` where `user_id`='".$_SESSION['id']."'"));
        if($camxuccuaban['camxuc'] == '1') $camxuc='LIKE';
        if($camxuccuaban['camxuc'] == '2') $camxuc='LOVE';
        if($camxuccuaban['camxuc'] == '3') $camxuc='WOW';
        if($camxuccuaban['camxuc'] == '4') $camxuc='HAHA';
        if($camxuccuaban['camxuc'] == '5') $camxuc='ANGRY';
        if($camxuccuaban['camxuc'] == '6') $camxuc='SAD';
        $tinhtrang ='Bạn Đã Cài BOT '.$camxuc.'';
    }
?>
    <div class="col-md-6">
        <div class="panel panel-filled">
            <div class="panel-heading">
                <div class="panel-tools">
                    <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                    <a class="panel-close"><i class="fa fa-times"></i></a>
                </div>
                Bảng Điều Khiển
            </div>
            <div class="panel-body">
                <p>Xin chào <code><?php echo $_SESSION['name']; ?></code> - <code><?php echo $_SESSION['id']; ?></code></p>
                 <p>Tình Trạng: <code><?php echo $tinhtrang; ?></code></p>
                 <form action="" method="POST">
                    <div class="radio"><label>
                            <input type="radio" name="CamXuc" id="LIKE" value="1"
                                <?php
                                    if (isset($camxuc) && $camxuc == 'LIKE') {
                                        echo ('checked');
                                    }
                                ?>
                            >
                            Cảm Xúc: LIKE </label></div>
                    <div class="radio"><label>
                            <input type="radio" name="CamXuc" id="LOVE" value="2"
                                <?php
                                if (isset($camxuc) && $camxuc == 'LOVE') {
                                    echo ('checked');
                                }
                                ?>
                            >
                            Cảm Xúc: LOVE </label></div>
                    <div class="radio"><label>
                            <input type="radio" name="CamXuc" id="WOW" value="3"
                                <?php
                                if (isset($camxuc) && $camxuc == 'WOW') {
                                    echo ('checked');
                                }
                                ?>
                            >
                            Cảm Xúc: WOW </label></div>
                    <div class="radio"><label>
                            <input type="radio" name="CamXuc" id="HAHA" value="4"
                                <?php
                                if (isset($camxuc) && $camxuc == 'HAHA') {
                                    echo ('checked');
                                }
                                ?>
                            >
                            Cảm Xúc: HAHA </label></div>
                    <div class="radio"><label>
                            <input type="radio" name="CamXuc" id="SAD" value="5"
                                <?php
                                if (isset($camxuc) && $camxuc == 'SAD') {
                                    echo ('checked');
                                }
                                ?>
                            >
                            Cảm Xúc: SAD </label></div>
                    <div class="radio"><label>
                            <input type="radio" name="CamXuc" id="ANGRY" value="6"
                                <?php
                                if (isset($camxuc) && $camxuc == 'ANGRY') {
                                    echo ('checked');
                                }
                                ?>
                            >
                            Cảm Xúc: ANGRY </label></div>
                    <div class="radio"><label>
                            <input type="radio" name="CamXuc" id="TURN-OFF" value="tatbot"
                                <?php
                                if (!isset($camxuc)) {
                                    echo ('checked');
                                }
                                ?>
                            >
                            Tắt BOT </label></div>
                <div class="form-group">
                    <label for="comment">Nội Dung Comment:</label>
                        <textarea class="form-control" rows="5" name="comment" title="Nội Dung Comment"><?php if(isset($camxuccuaban) && intval($camxuccuaban['battatcmt']) === 1) { echo ($camxuccuaban['comments']);} ?></textarea>
                </div>
                    <div class="radio"><label> <input type="radio" name="battatcmt" value="tatcmt" checked
                            <?php
                                if (isset($camxuccuaban['battatcmt']) && intval($camxuccuaban['battatcmt']) == 0) {
                                    echo 'checked';
                                }
                            ?>
                            >
                            Tắt Comments
                        </label></div>
                    <div class="radio"><label> <input type="radio" name="battatcmt" value="batcmt"
                                <?php
                                if (isset($camxuccuaban['battatcmt']) && intval($camxuccuaban['battatcmt']) == 1) {
                                    echo 'checked';
                                }
                                ?>
                            >
                            Bật Comments
                        </label></div>
                    <div class="text-center">
                        <button class="btn btn-w-md btn-success"><?php echo $submitt; ?></button>
                    </div>
                 </form>

            </div>
        </div>

                </div>
                <?php } ?>
                <div class="col-md-6">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                                <a class="panel-close"><i class="fa fa-times"></i></a>
                            </div>
                            Thống Kê
                        </div>
                        <div class="panel-body">
                        <?php
                        $file = scandir('log/');
                        $result1 =  mysqli_fetch_assoc(mysqli_query($connection, "select count(*) from `Account`"));
                            $tonguser = $result1['count(*)'];
                        ?>
                            <p>Thông tin người dùng <code>mới nhất</code> được cập nhật tại đây.</p>
                            <p>Số người dùng <code><?php echo $tonguser; ?></code> - Đã tương tác <code><?php echo count($file)-2;?> </code> ID.</p>

                            <div class="table-responsive">
                                <table  class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>CX</th>
                                        <th>Name</th>
                                        <th>ID</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$infongdung = mysqli_query($connection, "SELECT * FROM `Account` ORDER BY id DESC LIMIT 4");
while ($getpuaru = mysqli_fetch_array($infongdung)) {
    $camxuc = 'LIKE';

    if($getpuaru['camxuc'] == '1') $camxuc='LIKE';
    if($getpuaru['camxuc'] == '2') $camxuc='LOVE';
    if($getpuaru['camxuc'] == '3') $camxuc='WOW';
    if($getpuaru['camxuc'] == '4') $camxuc='HAHA';
    if($getpuaru['camxuc'] == '5') $camxuc='SAD';
    if($getpuaru['camxuc'] == '6') $camxuc='ANGRY';
?>
                                    <tr>
                                        <td><?php echo $camxuc;?></td>
                                        <td><?php echo $getpuaru['name'];?></td>
                                        <td><?php echo $getpuaru['user_id'];?></td>
                                    </tr>
<?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                                <a class="panel-close"><i class="fa fa-times"></i></a>
                            </div>
                            Hướng Dẫn Sử Dụng
                        </div>
                        <div class="panel-body">
                            <p>
                                Nếu không biết cách sử dụng Bot, vui lòng xem clip ở bên dưới.
                            </p>
                             <p><div class="embed-responsive embed-responsive-16by9"><iframe width="360" height="115" src="https://www.youtube.com/embed/I-bzSRQc_uI?autoplay=0" frameborder="0" allowfullscreen></iframe></div></p>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

<!-- Vendor scripts -->
<script src="vendor/pacejs/pace.min.js"></script>
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/toastr/toastr.min.js"></script>
<script src="vendor/sparkline/index.js"></script>
<script src="vendor/flot/jquery.flot.min.js"></script>
<script src="vendor/flot/jquery.flot.resize.min.js"></script>
<script src="vendor/flot/jquery.flot.spline.js"></script>

<!-- App scripts -->
<script src="scripts/luna.js"></script>

</body>

</html>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>