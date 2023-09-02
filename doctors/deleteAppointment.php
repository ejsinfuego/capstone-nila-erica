<?php

 session_start();

    include('../connection.php');
    //delete all picked appointments
    if(isset($_POST['appointment_ids'])){
        $appointment_ids = $_POST['appointment_ids'];
        foreach($appointment_ids as $appointment_id){
            $database->query("DELETE FROM consultation WHERE consultation_id = '$appointment_id'");
        }
    }
    $_SESSION['message'] = "Appointment(s) deleted successfully";
    header('location: appointments.php');    
    