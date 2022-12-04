<?php
if(!file_exists("_system/license.key"))
{
	header("location: install/install.php");
}
	require_once("_system/_config.php");
	require_once("_system/_database.php");
	require_once("_system/func_wallet/_time2reset_mtopup.php");

	if(isset($_SESSION['uid']) || isset($_SESSION['username']))
	{
		$sql_player = 'SELECT * FROM authme WHERE id = "'.$_SESSION['uid'].'"';
		$query_player = $connect->query($sql_player);

		if($query_player->num_rows <= 0)
		{
			session_destroy();

				//* REFRESH
			echo "<meta http-equiv='refresh' content='0 ;'>";
		}
		else
		{
			$player = $query_player->fetch_assoc();
		}
	}

	if($time2reset_mtopup <= time())
	{
		file_put_contents('_system/func_wallet/_time2reset_mtopup.php','<?php $time2reset_mtopup = '.strtotime('first day of next month midnight').'; ?>');
		$connect->query("UPDATE authme SET topup_m = 0, topup_w = 0");

		//* REFRESH
		echo "<meta http-equiv='refresh' content='0 ;'>";
	}
                $sql_setting = 'SELECT * FROM setting';
		$query_setting = $connect->query($sql_setting);
                $setting = $query_setting->fetch_assoc();
                $sql_download = 'SELECT * FROM download';
		$query_download = $connect->query($sql_download);
                $download = $query_download->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">
    <head>
            <meta charset="utf-8">
            <title><?php echo $setting['name_server'];?></title>
            <link href="assets/css/kanit.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/css/style-theme.css">
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-6jHF7Z3XI3fF4XZixAuSu0gGKrXwoX/w3uFPxC56OtjChio7wtTGJWRW53Nhx6Ev" crossorigin="anonymous">
			<link rel="stylesheet" href="assets/fa/css/font-awesome.css?1">
            <link rel="stylesheet" href="assets/css/sweetalert2.min.css" >
            <link rel="stylesheet" href="assets/css/mary.css">
            <link rel="stylesheet" href="assets/css/lt.css">
            <script src="assets/js/sweetalert2.all.min.js"></script>
            <link rel="icon" href="<?php echo $setting['icon']; ?>">
            <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta>
    </head>
<style type="text/css">
body,td,th {
font-family: 'Kanit', sans-serif;
font-size: 15px;
}
body
{
  background: url(<?php echo $setting['bg'];?>) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.lp-panel {
color: black;
font-size: 18px;
background: rgba(255,255,255.1);
padding: 20px;
}
.lp-menu {
padding: 11px;
font-size: 17px;
border-bottom: 1px solid white;
text-decoration: none !important;
color: black;
transition-duration: 0.3s;
background: rgba(238,238,238,1)
}
.lp-menu:hover {
border-left: 6.5px solid transparent;
color: black;
background: rgba(223,223,223,1)
}
.lp-title-input {
color: white;
background: rgba(0,0,0,0.5);
border: 0px;
border-radius: 0px;
}
.lp-input {
font-size:16px;
background: rgba(255,255,255,1);
border-radius: 0px;
color: black;
}
.lp-input:disabled {
background: rgba(0,0,0,0.1);
}
.modal-content
 {
 border-radius: 0px;
 border: solid 1px white;
     padding:9px 15px;
     background-color: rgba(255,255,255,1);
 }
 .lp-card {
color: black;
background: rgba(255,255,255.1);
}
</style>
<script type="text/javascript">
    func();
    var seconds = 5 /*SECONDS, UPDATE INTERVAL*/;
    setInterval(function(){
        func();
    }, seconds * 1000);
    function func(){ 
    //เปลียน IP ตรงนี้ (ตัวอย่าง)
        var ip = "<?php echo $setting['ip_server']; ?>";
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://eu.mc-api.net/v3/server/info/" + ip, true);
        xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                        data = JSON.parse(xhr.responseText);
                        if (data.status) {
                                document.getElementById("sta").innerHTML="<span id='sta' <span style='color: green;font-size: 18px;'>Online</span>";
                                document.getElementById("bar").innerHTML=data.players.online + "/" + data.players.max;
                                document.getElementById("bar").style.width = Math.round(100*(data.players.online/data.players.max)) + "%";
                        } else {
                                document.getElementById("bar").innerHTML="0/0";
                                 document.getElementById("sta").innerHTML="<span id='sta' <span style='color: red;font-size: 18px;'>Offline</span>";
                        }
                }
        }
        xhr.send();
    };
</script>
<br>
<div class="container" align="center">
    <img class="animation" style="width: 20%;" src="<?php echo $setting['icon']; ?>">
<br><a style="font-size: 40px;"><?php echo $setting['name_server'];?></a>
  </div>
<body style="color:#000;">
        <div style="width:1200px; max-width:100%; margin:auto; margin-top:40px;">
<div id="header" style="margin-bottom:10px;">
<div class="header">
<div id="header" style="margin-bottom:10px;">
  
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto pt-3 pt-lg-0">
                    <li class="nav-item dropdown"> 
      <li class="nav-item">
        <a class="nav-link" href="?page=home"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Home-icon.svg/1200px-Home-icon.svg.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>Home</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;หน้าหลัก</span>
              </span><span class="sr-only">(current)</span></a>
	</li>&nbsp;&nbsp;	
    <li class="nav-item">	
        <a class="nav-link" href="?page=shop&server=1"><img src="menu/shop.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>Shop</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;ร้านค้า</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;
    <li class="nav-item">	
        <a class="nav-link" href="?page=topup"><img src="menu/topup.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>Topup</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;เติมเงิน</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;
     <li class="nav-item">	  
        <a class="nav-link" href="?page=redeem"><img src="menu/redeem.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>Redeem</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;เติมโค็ด</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;	  
    <li class="nav-item">	
        <a class="nav-link" href="?page=download"><img src="menu/download.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>Download</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;ดาวน์โหลด</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;
                </ul>
                <ul class="navbar-nav pb-3 pb-lg-0">
                    <?php if(!$_SESSION['username']){ ?>
	<li class="nav-item">	
        <a class="nav-link" href="?page=register"><img src="menu/register.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>REGISTER</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;สมัครสมาชิก</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;	
    <li class="nav-item">	
        <a class="nav-link" href="?page=login"><img src="menu/login.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>LOGIN</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;เข้าสู่ระบบ</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;		  

                    <?php }else{ ?>
		<!--<li class="nav-item">	
        <a class="nav-link" href="?page=gift"><img src="https://download.seaicons.com/icons/paomedia/small-n-flat/1024/gift-icon.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>GIFT</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbsp;ของขวัญ</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;	-->
	  <li class="nav-item">	
        <a class="nav-link" href="?page=log"><img src="menu/log.png" style="width:37px;height:37px;"></i><span class="pull-right">
                <span id="xnav-upp">&nbsp;&nbsp;<b>LOG</span></b>
                <br>
                <span id="xnav-btt">&nbsp;&nbspประวัติการเติม</span>
              </span><span class="sr-only">(current)</span></a>
      </li>&nbsp;&nbsp;	
                    <?php } ?>
					
                </ul>
            </div>
        </div>
    </nav>
	
	
	
	
<br>  
     <div class="card card-transparent" style="padding: 20px;color: black; -webkit-box-shadow: 0px 5px 30px -5px #000000;
  -moz-box-shadow: 0px 5px 30px -5px #000000;
    box-shadow: 0px 5px 30px -5px #000000;">
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                   <?php
                    if(!$_GET){$_GET["page"] = 'home';}
                    if(!$_GET["page"])
                    {
                      $_GET["page"] = "home";
                    }
                     if($_GET["page"] == "home"){
                         include_once __DIR__.'/_page/home.php';
                    }elseif($_GET['page'] == "shop"){
                        include_once __DIR__.'/_page/shop.php';
                    }elseif($_GET['page'] == "download"){
                        include_once __DIR__.'/_page/download.php';
                    }elseif($_GET['page'] == "topup"){
                        include_once __DIR__.'/_page/topup.php';
                    }elseif($_GET['page'] == "log"){
                        include_once __DIR__.'/_page/log.php';
                    }elseif($_GET['page'] == "gift"){
                        include_once __DIR__.'/_page/gift.php';						
                    }elseif($_GET['page'] == "confirm"){
                        include_once __DIR__.'/_page/confirm.php';
                    }elseif($_GET['page'] == "login"){
                        include_once __DIR__.'/_page/login.php';
                    }elseif($_GET['page'] == "register"){
                        include_once __DIR__.'/_page/register.php';
                    }elseif($_GET['page'] == "logout"){
                        include_once __DIR__.'/_page/logout.php';
                    }elseif($_GET['page'] == "redeem"){
                        include_once __DIR__.'/_page/redeem.php';
                    }elseif($_GET['page'] == "user"){
                        include_once __DIR__.'/_page/user.php';
					}elseif($_GET['page'] == "gift"){
                        include_once __DIR__.'/_page/gift.php';
                    }elseif($_SESSION['uid'] && $player['status'] == "admin" && $_GET['page'] == "backend"){
                        include_once __DIR__.'/backend/index.php';
                    }else{
                                            echo '<div class="alert alert-danger"><i class="fa fa-warning"></i>404 ไม่พบหน้าที่ต้องการ</div>';
                                            echo '<meta http-equiv="refresh" content="2;URL=?page=home">';
                                        }
                     ?>
                </div>
<div class="col-lg-4">
<div class="card border-0 shadow mb-4 d-none d-lg-block">
<div class="card-body">
<?php if($_SESSION['username']){ ?>
<h5 class="m-0"><i class="fa fa-user fa-fw"></i> ระบบสมาชิก</h5>
<hr>
<text style="font-size: 16px;"> 
<center><img src="https://minotar.net/armor/bust/<?php echo $_SESSION['realname']; ?>/175"><br></center>
<hr>
         <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-success btn-line-b text-white"><i class="fa fa-user"></i>&nbsp;ชื่อผู้ใช้</span>
  </div>
<input class="form-control form-control-lg lp-input mypointlive" value="<?php echo $_SESSION['realname']; ?>" disabled/>
</div>
       
            <div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-success btn-line-b text-white"><i class="fa fa-credit-card"></i>&nbsp;จำนวนพ้อยท์</span>
  </div>
<input class="form-control form-control-lg lp-input" value="<?php echo number_format($player['points']); ?> พ้อยท์" disabled/>
</div>
<div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-success btn-line-b text-white"><i class="fa fa-credit-card"></i>&nbsp;ยอดการเติม</span>
  </div>
<input class="form-control form-control-lg lp-input" value="<?php echo number_format($player['rp']); ?> บาท" disabled/>
</div>
<div class="d-flex flex-column" style="width: 100%">
<a class="lp-menu" href="?page=user"><i class="fa fa-user"></i>&nbsp;ข้อมูลส่วนตัว</a>
<a class="lp-menu" href="?page=logout"><i class="fa fa-sign-out"></i>&nbsp;ออกจากระบบ</a>
</div><hr>
<?php }else{ ?>
<div class="card-header bg-success" style="color:#FFF;"><i class="fa fa-user fa-lg"></i> LOGIN ( เข้าสู่ระบบ )</div>
<hr>
<form method="post" action="">
<input type="hidden" name="login_submit">
<div class="form-group">
<input type="text"  name="username" class="form-control" placeholder="ชื่อตัวละคร : ">
</div>
<div class="form-group">
<input type="password"  name="password" class="form-control" placeholder="รหัสผ่าน : ">
</div>
<button type="submit" class="btn btn-block btn-outline-success mb-3"><i class="fa fa-sign-in fa-fw"></i> เข้าสู่ระบบ</button>
</form>
<?php } ?>
</div>
</div>
<?php
	require __DIR__ . '/_system/status/_MinecraftQuery.php';
	require __DIR__ . '/_system/status/_MinecraftQueryException.php';
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;
	
	$MCQuery = new MinecraftQuery();
?>
<a href="?page=redeem" class="btn btn-success btn-block btn-lg text-white" style="border-bottom:4px solid #013c0e;margin-bottom:10px;"><b>POINT CODE</b><br>[ เติมโค้ด ]</a>
<div class="widget_ct" style="">
<div class="card" style="background:none!important;">
  <div class="card-body bg-semi-white" style="padding:0px;border-radius:0px 0px 8px 8px;">
</div>
</div></div>

 <div class="card border-0 shadow mb-4">
<div class="card-body">
    <div class="card-header slash bg-success" style="color: white;"><i class="fa fa-exchange"></i>&nbsp;สถานะเซิฟเวอร์
</div>
	<hr>
  <span id="hover" style="font-size:15px;"><i class="fa fa-fw fa-server"></i>&nbsp;IP Server : <?php echo $setting['ip_server']; ?></span><br>
  <span id="hover" style="font-size:15px;"><i class="fa fa-fw fa-power-off"></i>&nbsp;สถานะเซิฟ :</span> <span id="sta"></span><br>
  <span id="hover" style="font-size:15px;"><i class="fa fa-fw fa-tag"></i>&nbsp;เวอร์ชั่น : <?php echo $setting['version_server']; ?></span><br>
  <span id="hover" style="font-size:15px;"><i class="fa fa-fw fa-users"></i>&nbsp;ผู้เล่นออนไลน์ : <span id="bar">คน</span></span>
</div>
</div>
<div class="card-body">
<h5 class="m-0"><img src="https://pbs.twimg.com/profile_images/1642161716/music_logo.png" style="width: 30px;"> สถานีฟังเพลง</h5>
<div class="panel-body">
<audio id="myVideo" class="full" preload="auto" controls="" autoplay=""><source src="http://link2.onair.network:8006/;" type="audio/mpeg"></audio>		
</div>

<div class="card border-0 shadow mb-4">
<div class="card-body">
<h5 class="m-0"><i class="fa fa-trophy"></i>&nbsp;อันดับการเติมเงิน</h5>
<hr>

<?php
$sql_list = 'SELECT * FROM authme ORDER BY topup DESC LIMIT 5';
$query_list = $connect->query($sql_list);

$sql_last = 'SELECT * FROM activities WHERE (action = "TOPUP Truewallet" || action = "TOPUP TrueMoney") ORDER BY id DESC';
$query_last = $connect->query($sql_last);
?>
<table class="table table-striped ranking_tb" border="0" style="font-size:13px;">
  <thead>
    <tr>
      <th scope="col">ชื่อผู้เล่น</th>
      <th scope="col">จำนวน</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($query_list->num_rows > 0)
    {
      while($list_topup = $query_list->fetch_assoc())
      {
        ?>
        <tr>
          <td>
            <img src="https://minotar.net/avatar/<?php echo $list_topup['username']; ?>/28" class="mr-3" width="28"><?php echo $list_topup['realname']; ?>
          </td>
          <td>
            <?php echo number_format($list_topup['topup'],2); ?> <i class="fa fa-adjust"></i>
          </td>
        </tr>
        <?php
      }
    }
    else
    {
      ?>
      <tr>
        <td>
          <img src="https://minotar.net/avatar/steve/28" class="mr-3" width="28">ไม่มีอันดับคนเติมเงิน
        </td>
        <td>
          <?php echo number_format("0",2); ?> <i class="fa fa-coins text-dark"></i>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
</div>
</div>

<div class="card border-0 shadow mb-4">
<div class="card-body">
<div class="card-header bg-danger  btn-line-b black_line" style="color:#FFF;"><i class="fa fa-trophy"></i> อันดับเติมเงินล่าสุด</div>
<hr>

<?php
$sql_last = 'SELECT * FROM activities WHERE (action = "TOPUP Truewallet" || action = "TOPUP TrueMoney") ORDER BY id DESC LIMIT 1';
$query_last = $connect->query($sql_last);
?>
<table class="table table-striped ranking_tb" border="0" style="font-size:13px;">
  <thead>
    <tr>
      <th scope="col">ชื่อผู้เล่น</th>
      <th scope="col">จำนวน</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($query_last->num_rows > 0)
    {
      while($last_topup = $query_last->fetch_assoc())
      {
        ?>
        <tr>
          <td>
            <img src="https://minotar.net/avatar/<?php echo $last_topup['username']; ?>/28" class="mr-3" width="28"><?php echo $last_topup['username']; ?>
          </td>
          <td>
            <?php echo number_format($last_topup['topup_amount'],2); ?> <i class="fa fa-adjust"></i>
          </td>
        </tr>
        <?php
      }
    }
    else
    {
      ?>
      <tr>
        <td>
          <img src="https://minotar.net/avatar/steve/28" class="mr-3" width="28">ไม่มีคนเติมเงินล่าสุด
        </td>
        <td>
          <?php echo number_format("0",2); ?> <i class="fas fa-coins text-dark"></i>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
</div>
</div>
</div>

                    <br>
	
  
  <div class="card border-0 shadow mb-4">
<div class="card-body">
<h5 class="m-0"><i class="fa fa-facebook-official"></i>  FACEBOOK</h5>
<hr>
	 <div class="fb-page" data-adapt-container-width="true" data-height="450" data-hide-cover="false" data-href="<?php echo $setting['page_facebook'] ?>" data-show-facepile="true" data-small-header="false" data-tabs="timeline" data-width="350">
                                <blockquote cite="<?php echo $setting['page_facebook'] ?>" class="fb-xfbml-parse-ignore"></blockquote>
                                </div>

                                <div id="fb-root">&nbsp;</div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.3"></script>
                        </div>
</div>
<div class="card border-0 shadow mb-4">
<div class="card-body">
<h5 class="m-0"><img src="img/discord.png" style="width: 30px;"></i> ดิสคอร์ดพูดคุย</h5>
<hr>
	<iframe id="discord" src="https://discordapp.com/widget?id=<?php echo $setting['discord_id']; ?>&theme=dark" height="500" allowtransparency="true" frameborder="0" style="width: 100%"></iframe> 
</div></div>						
                    </div>
            </div>
        </div>
    </main>
</div>	
<td style="color: #fff;">
</td>
</tr>
<div style="background: #0f0c29!important;
background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29)!important;
background: linear-gradient(to right, #24243e, #302b63, #0f0c29)!important;
padding:8px;color: white; text-align:center;margin-top: 40px;">
<small style="font-size:14px;">System & Design By <a href="https://www.facebook.com/kuykeehee123" style="color: white;text-decoration: underline;">porserver</a> | <a target="_blank" class="foot_hover"  href="backend">จัดการระบบ</a><br></small>
</tbody>
</table>
</div>
</html>

 <?php
	if(isset($_POST['login_submit']))
	{
		$msg = '';
		$alert = 'error';
		$msg_alert = 'เกิดข้อผิดพลาด!';

		$username = $connect->real_escape_string($_POST['username']);
		$sql = 'SELECT * FROM authme WHERE username = "'.$username.'"';
		$a = $connect->query($sql);
		$a_num = $a->num_rows;
		if($a_num == 1)
		{
			$password_info = $a->fetch_assoc();
			$sha_info = explode("$",$password_info['password']);
			$salt = $sha_info[2];
			$sha256_password = hash('sha256', $_POST['password']);
			$sha256_password .= $sha_info[2];

			if(strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password)) == 0){
				$sql_user = 'SELECT * FROM authme WHERE username = "'.$username.'"';
				$query_user = $connect->query($sql_user);
				$fetch_user = $query_user->fetch_assoc();

				//* SET SESSION
				$_SESSION['uid'] = $fetch_user['id'];
				$_SESSION['username'] = $fetch_user['username'];
				$_SESSION['realname'] = $fetch_user['realname'];


				$msg = 'ยินดีต้อนรับคุณ: '.$_SESSION['realname'];
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
			}
			else
			{
				$msg = 'รหัสผ่านไม่ถูกต้อง';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}
		}
		else
		{
			$msg = 'ไม่พบตัวละครนี้';
			$alert = 'error';
			$msg_alert = 'เกิดข้อผิดพลาด!';
		}

		?>
			<script>
				swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
					button: "Reload",
				})
				.then((value) => {
					window.location.href = window.location.href;
				});
			</script>
		<?php
	}
        
if(isset($_POST['submit']) == "redeem")
{
    if($_SESSION['username']){
    $code = $_POST['redeem_code'];

    $redeem_q = $connect->query("SELECT * FROM redeem WHERE code = '".$code."'");
    $redeem = $redeem_q->fetch_assoc();

    if($redeem_q->num_rows != 0)
    {
        $update_q = $connect->query("UPDATE authme set points = points + '".$redeem['cmd']."' WHERE username = '".$_SESSION['username']."'");
        //alert
            $msg = 'คุณได้รับสินค้าแล้ว';
			$alert = 'success';
			$msg_alert = 'สำเร็จ!';
        $delete_redeem = $connect->query("DELETE FROM redeem WHERE id = '".$redeem['id']."'");
    }
    else
    {
        $msg = 'ไม่มีโค๊ดที่ท่านเลือก';
			$alert = 'error';
			$msg_alert = 'ผิดพลาด!';
    } ?>
        <script>
				swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
					button: "Reload",
				})
				.then((value) => {
					window.location.href = window.location.href;
				});
			</script>               
    <script>
				swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
					button: "Reload",
				})
				.then((value) => {
					window.location.href = window.location.href;
				});
			</script> 
                        <?php
}
}
?>