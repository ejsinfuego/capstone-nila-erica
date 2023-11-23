<?php
session_start();
if($_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == ''){
    header('Location: ../login_v2.php');
}
require '../vendor/autoload.php';

use Carbon\Carbon;

$timeNow = Carbon::now('Asia/Manila');

echo $timeNow->toTimeString();

include('../connection.php');

if($_GET){
    $request_medicine_id = $_GET['request_medicine_id'];

    $database->query("update request_medicine set status = 'claimed' where request_medicine_id = $request_medicine_id");
    $message = "Medicine(s) claimed.";
    $_SESSION['message'] = $message;
    $_SESSION['show_modal'] = "myModal";
    header('location: request_medicine.php');

}else{
    $message = "Failed to claim medicine(s).";
}

$_SESSION['message'] = $message;
$_SESSION['show_modal'] = "myModal";
header('location: request_medicine.php');