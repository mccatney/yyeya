<?php
error_reporting(0);
header('Content-Type: application/json');
    require_once(__DIR__ . '/../func_wallet/_truewallet.php');
    require_once(__DIR__ . '/../_database.php');
    require_once(__DIR__ . '/../func_wallet/_loginTW.php');
$sql_setting = 'SELECT * FROM wallet_account';
$query_setting = $connect->query($sql_setting);
$setting = $query_setting->fetch_assoc();

  $phone = $setting['phone'];
  $password = $setting['password'];
  $access_token = $setting['reference_token'];

$tw = new TrueWallet($phone, $password);
$tw->setAccessToken($access_token);


$data = $tw->getTransaction(50);
  foreach ($data["data"]["activities"] as $transfer) {
  $values = $tw->GetTransactionReport($transfer["report_id"]);

  $por["name"] =$values ["data"]["section2"]["column1"]["cell2"]["value"];
  $por["time"] =$values ["data"]["section4"]["column1"]["cell1"]["value"];
  $por["transfer_id"]  = $values["data"]["section4"]["column2"]["cell1"]["value"];
	$por["money"] = $values["data"]["section3"]["column1"]["cell1"]["value"];
  $por["sender"]["phone"] = $values["data"]["section2"]["column1"]["cell1"]["value"];
	echo json_encode($por, JSON_UNESCAPED_UNICODE)."\n";
print_r($values);
  }




?>