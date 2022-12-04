	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
		{
                    include_once '_page/userLogin.php';
		}
		else
		{
			?>

<div class="card border-0 shadow mb-4">
<div class="card-body">
<h5 class="m-0"><i class="fa fa-user"></i>&nbsp;ผู้ใช้งาน</h5>
<hr>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">ชื่อตัวละคร: </span>
  </div>
    <input type="text" name="username" disabled="" value="<?php echo $_SESSION['realname']; ?>" id="username" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">ยอดคงเหลือ: </span>
  </div>
    <input type="text" name="username" disabled="" value="<?php echo number_format($player['points']); ?>.00 พ้อยท์" id="username" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">ยอดการเติมเงินรวม: </span>
  </div>
    <input type="text" name="username" disabled="" value="<?php echo number_format($player['rp']); ?>.00 พ้อยท์" id="username" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">Email: </span>
  </div>
    <input type="text" name="username" disabled="" value="<?php echo $player['email'] ?>" id="username" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">IP: </span>
  </div>
    <input type="text" name="username" disabled="" value="<?php echo $player['ip'] ?>" id="username" class="form-control form-control-lg lp-input">
</div>

  </div>
</div>

<div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-lock"></i> เปลี่ยนรหัสผ่าน</h5>
                            <hr>
                            <?php
                        if(isset($_POST['chang']) == "cpassword")
                          {
                            echo '<div class="alert alert-danger">ระบบอยุ่ในช่วงทำอยุ่ Comming Soon...</div>';
                            /*
                            $authme_check = new Authme();
                              $user_check = $authme_check->checkPassword($_SESSION['username'],$_POST['password_old']);

                              $fetch_authme = $connect->query("SELECT * FROM authme WHERE username = '".$_SESSION['username']."'");
                              $authme = $fetch_authme->fetch_assoc();

                              $password_hashing = hashPassword($_POST['password_old']);

                        if($_POST['password_new'] != $_POST['repassword_new'])
                        {
                            echo '<div class="alert alert-danger">รหัสผ่านทั่ง2ช่องไม่ตรงกัน</div>';
                        }
                        elseif(!preg_match("/^[a-zA-Z0-9_-]+$/", $_POST['password_new']))
                        {
                             echo '<div class="alert alert-danger">กรุณาใส่แต่อักษรภาษาอังกฤษ</div>';
                        }
                        elseif(strlen($_POST['password_new'])<4)
                        {
                             echo '<div class="alert alert-danger">กรุณาใส่รหัสผ่านมากกว่า 4 ตัวขึ่นไป</div>';
                        }
                        else
                        {
                                  if($user_check == FALSE)
                                  {
                                       echo '<div class="alert alert-danger">รหัสผ่านเก่าไม่ถูกต้อง 4 ตัวขึ่นไป</div>';
                                  }
                                  elseif($user_check == TRUE)
                                  {
                                 $connect->query("UPDATE `authme` SET `password` = '$password_hashing' WHERE `authme`.`id` = ".$_SESSION['uid']);
                                  echo '<div class="alert alert-success"> เปลี่ยนรหัสผ่านสำเร็จแล้ว</div>';
                                    }
                                  else
                                  {
                                       echo '<div class="alert alert-danger">ระบบผิดพลาด '.$setting['name_server'].'</div>';
                                      
                                  }
                              }*/
                          }
                          ?>
                            <form method="post">
                                <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">Username&nbsp;:&nbsp;</span>
  </div>
    <input type="text" name="username" disabled="" value="<?php echo $_SESSION['username']; ?>" id="username" class="form-control form-control-lg lp-input">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">รหัสผ่านปัจจุบัน&nbsp;:&nbsp;</span>
  </div>
    <input type="password" name="password_old" id="password_old" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">รหัสผ่านใหม่&nbsp;:&nbsp;</span>
  </div>
    <input type="password" name="password_new" id="password_new" class="form-control form-control-lg lp-input">
</div>

<div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input">ยืนยันรหัสผ่านใหม่&nbsp;:&nbsp;</span>
  </div>
    <input type="password" name="repassword_new" id="repassword_new" class="form-control form-control-lg lp-input">
</div>
<input type="hidden" name="chang" value="cpassword">
<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;ยันยันและเปลี่ยนรหัสผ่าน</button>
</form>
</div></div>
			<?php
		}
	?>
