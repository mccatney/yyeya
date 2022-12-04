<?php
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
if (isset($_GET["transaction"])) {
	$transactions = $tw->getTransaction(50);
	 foreach ($transactions["data"]["activities"] as $report) {
        $data = $tw->GetTransactionReport($report["report_id"]);
        $code = $data["data"]["service_code"];
        $tran = $data['data']['section4']['column2']['cell1']['value'];
        $money = $data["data"]["amount"];
        $msg = $data["data"]["personal_message"]['value'];
		$phone = $data["data"]["section2"]["column1"]['cell1']['value'];
		$time = $data['section4']['column1']['cell1']['value'];
        if ($tran == $_GET["transaction"]){
         break;
        }
    }
    if($tran == $_GET['transaction']) {
		$response["message"] = 'success';
        $response["code"] = '100';
        $response["amount"] = $money;
        $response["message_transfer"] = $msg;
        $response["transaction"] = $tran;
		$response["phone"] = $phone;
		$response["time"] = $time;
        echo json_encode($response);
        die;
    }
}


?>