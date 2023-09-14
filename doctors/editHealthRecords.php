<?php

require '../vendor/autoload.php';
use Carbon\Carbon;

$timeNow = Carbon::now('Asia/Kolkata');


    include("../connection.php");
    //get all rows of date and time
    session_start();

    

    if(isset($_POST['submit'])){
        $weight=$_POST['weight'];
        $height=$_POST['height'];
        $bp=$_POST['bp'];
        $pid=$_POST['patient_id'];
        $note = $_POST['note'];
        $timestamp= $timeNow;

        $search = $database->query("select * from health_monitoring where patient_pid =".$pid);

        if($search->num_rows==0){
            $database->query("insert into health_monitoring(weight, height, blood_pressure, patient_pid, note, created_at, updated_at) values('$weight','$height','$bp','$pid','$note','$timestamp','$timestamp')");
        }else{
           $database->query("update health_monitoring set weight='$weight', height='$height', blood_pressure='$bp', note='$note', updated_at='$timestamp' where patient_pid='$pid'");
        }

        $_SESSION['message']="Health Records Update";
        header("location: patients.php");
        

     }
       
