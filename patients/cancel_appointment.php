<?php

session_start();
include('../connection.php');
//cancel appointment
if(isset($_GET['appointment_id'])){
        $appointment_id = $_GET['appointment_id'];
        $database->query("update consultation set stat = 'cancelled' where consultation_id = $appointment_id");
        $message = "Appointment(s) cancelled.";
    }
    else{
        $message = "Failed to cancel appointment(s).";
    }
    $_SESSION['message'] = $message;
    $_SESSION['show_modal'] = "myModal";
    header('location: appointments.php');
