<?php

session_start();
include('../connection.php');
//cancel appointment
if(isset($_GET['appointment_id'])){
        $appointment_id = $_GET['appointment_id'];
        $database->query("update consultation set stat = 'cancelled' where consultation_id = $appointment_id");
        $_SESSION['message'] = "Appointment(s) cancelled.";
        $_SESSION['show_modal'] = "myModal";
        header('location: appointments.php'); 
    }
