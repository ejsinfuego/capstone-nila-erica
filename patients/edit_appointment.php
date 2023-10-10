<?php 

require '../vendor/autoload.php';
use Carbon\Carbon;
session_start();
$timeNow = Carbon::now('Asia/Kolkata');

include('../connection.php');
//edit appointment
$appointment = $database->query("select * from consultation where consultation_id={$_POST['appointmentid']}");
$appointment = $appointment->fetch_assoc();


if($_POST){
    //if there is a variable post if not leave it blank
    $appointmentid = $_POST['appointmentid'];
    $type = empty($_POST['appointmentType']) ? $appointment['type'] : $_POST['appointmentType'];
    $date = empty($_POST['appointmentDate']) ? $appointment['date'] : $_POST['appointmentDate'];
    $time = empty($_POST['appointmentTime']) ? $appointment['time'] : $_POST['appointmentTime'];
    $timestamp = $timeNow;

    $database->query("update consultation set type='$type', date='$date', time='$time', updated_at='$timestamp' where consultation_id='$appointmentid'");
    $_SESSION['message']="Appointment Updated!";
    $_SESSION['show_modal'] = "myModal";
    header("location: appointments.php");
}   