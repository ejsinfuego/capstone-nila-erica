<?php

 session_start();
 if($_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == ''){
    header('Location: ../login_v2.php');
}

    include('../connection.php');
    //approve appointment
    if(isset($_GET['appointment_id'])){
        $appointment_id = $_GET['appointment_id'];
        $database->query("
        update consultation set stat = 'approved' where consultation_id = '$appointment_id'");
    }
   
    $_SESSION['message'] = "Appointment(s) approved.";
    $_SESSION['show_modal'] = "myModal";
    header('location: appointments.php');    
    