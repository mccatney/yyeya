<?php
    require_once(__DIR__ . '/../func_wallet/_truewallet.php');
    require_once(__DIR__ . '/../_database.php');
    require_once(__DIR__ . '/../func_wallet/_loginTW.php');
$sql_setting = 'SELECT * FROM wallet_account';
$query_setting = $connect->query($sql_setting);
$setting = $query_setting->fetch_assoc();

$tw = new TrueWallet($phone = $setting['phone'], $password = $setting['password']);
$tw->setAccessToken($access_token = $setting['reference_token']);
  $data = $tw->GetProfile();
  //print_r($tw->RequestLoginOTP()); //otp
  //print_r($tw->SubmitLoginOTP($otp_code = "595749", $phone = $setting['phone'], $otp_ref = "KFBN")); //otpsub
  print($data["code"]);
  echo "<center><br><font color=blue >/\<br>|<br>|<br>CODE</font>
  <br>
  <font color=red >BY.PORAPI</font><br>
  <font color=pink >ต้องทำให้code ขี้นเป็น UPC-200 ถึงจะรัน conjobได้</font>"

?>