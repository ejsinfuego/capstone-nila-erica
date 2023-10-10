<?php 

include('../connection.php');
session_start();

if(isset($_POST['patient_id'])){
    $patient_id = $_POST['patient_id'];
    $diagnosis = $_POST['diagnosis'];
    $note = $_POST['note'];
    $database->query("insert into prescription(patient_id, diagnosis, note, created_at) values('$patient_id', '$diagnosis', '$note', '$time')");
    $_SESSION['message'] = "Prescription added.";
    $_SESSION['show_modal'] = "myModal";
    header("location: add_prescription.php");

}
