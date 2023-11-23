<?php


require '../vendor/autoload.php';
use Carbon\Carbon;

$timeNow = Carbon::now('Asia/Kolkata');

 session_start();
 if($_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == ''){
    header('Location: ../login_v2.php');
}

    include('../connection.php');
    //approve appointment
    $username = $_SESSION['complete_name'];
    if($_GET){
        var_dump($username);
        $request_medicine_id = $_GET['request_medicine_id'];

        $medicine_request = $database->query("select * from request_medicine where request_medicine_id = '$request_medicine_id'");
        $medicine_request = $medicine_request->fetch_assoc();
        $database->query("
        update request_medicine set status = 'approved', approved_by= '$username', updated_at='$timeNow' where request_medicine_id = '$request_medicine_id'");
        
        $database->query("
        update medicine_inventory set med_qty = med_qty - ".$medicine_request['quantity']." where medicine_id = '".$medicine_request['medicine_id']."'");

        $message = "Request(s) approved.";
        
    }else{
        $message = "Failed to approve request(s).";
    }
   
    $_SESSION['message'] = $message;
    $_SESSION['show_modal'] = "myModal";
    header('location: request_medicine.php');

  
