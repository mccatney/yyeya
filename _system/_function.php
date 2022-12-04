<?php
class Authme
{
	function checkPassword($nickname,$password) 
	{
	 include dirname( __file__ ).("/_config.php");
	  $con = mysqli_connect($config['mysql_host'], $config['mysql_username'], $config['mysql_password']);
	  $select_db = mysqli_select_db($con, $config['mysql_dbname']);  
	  $a = mysqli_query($con,"SELECT password FROM authme where username = '$nickname'"); 
	  if(mysqli_num_rows($a) == 1) { 
	  	$password_info = mysqli_fetch_array($a); 
	  	$sha_info = explode("$",$password_info[0]); 
	  } 
	  else 
	  		return false; 

	  if($sha_info[1] === "SHA") {
	   $salt = $sha_info[2]; 
	   $sha256_password = hash('sha256', $password); 
	   $sha256_password .= $sha_info[2];
	   if(strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password)) == 0) return true; else return false; } 
	}
        
}
function createSalt($length) 
  {
   srand(date("s"));
   $chars = "abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; $ret_str = "";
   $num = strlen($chars); 
    for($i=0;$i<$length;$i++) 
    {
        $ret_str.= $chars[rand()%$num]; 
    }
   return $ret_str; 
  }
function hashPassword($orgPassword) 
  { 
    $salt = createSalt(16); $hashedPassword = "\$SHA\$".$salt."\$".hash('sha256',hash('sha256',$orgPassword).$salt); 
    return $hashedPassword; 
  }

class master
{

	function send_date($ip,$key,$type)
	{
		$check = @file_get_contents('http://43.229.135.44/mc/data_center.php?act=checkip&ip='.$ip.'&type='.$type.'&key='.$key.'');

		if(!$check)
		{
			return FALSE;

		}
		else
		{
			return TRUE;
		}
	}
}