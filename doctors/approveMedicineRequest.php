<?php

 session_start();

    include('../connection.php');
    //approve appointment
    if(isset($_GET['request_medicine_id'])){
        $request_medicine_id = $_GET['request_medicine_id'];
        $database->query("
        update request_medicine set status = 'approved' where request_medicine_id = '$request_medicine_id'");
    }
   
    $_SESSION['message'] = "Appointment(s) approved.";
    $_SESSION['show_modal'] = "myModal";
    header('location: medicine_requests.php');    
