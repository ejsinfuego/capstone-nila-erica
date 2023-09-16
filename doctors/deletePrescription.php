<?php

 session_start();

    include('../connection.php');
    //delete all picked appointments
    if(isset($_GET['prescription_id'])){
        $prescription_id = $_GET['prescription_id'];
        $database->query("DELETE FROM prescription WHERE prescription_id = '$prescription_id'");
    }

    $_SESSION['message'] = "Prescription deleted successfully";
    $_SESSION['show_modal'] = "myModal";
    header('location: prescription.php');    
    