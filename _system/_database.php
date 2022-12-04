<?php
include_once __DIR__.'/_config.php';
include_once __DIR__.'/_function.php';
$connect = new mysqli($config['mysql_host'],$config['mysql_username'],$config['mysql_password'],$config['mysql_dbname']);
    $connect->query('SET names utf8');
    if($connect->connect_errno){
        exit("Error-> ".$connect->connect_error);
    }

    # ป้องกัน sql injection จาก $_GET
    foreach($_GET as $key => $value){
        $_GET[$key]=addslashes(strip_tags(trim($value)));
    }
    if(isset($_GET['id']) && $_GET['id'] !='')
    { 
        $_GET['id']=(int) $_GET['id'];
    }
    extract($_GET);
?>
