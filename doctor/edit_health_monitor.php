<?php 
include('../connection.php');
include('../vendor/autoload.php');
use Carbon\Carbon;


session_start();

//get the post data
$weight = $_POST['weight'];
$height = $_POST['height'];
$bp = $_POST['bp'];
$note = $_POST['note'];
$patient_id= $_POST['patient_id'];
$doctor_id = $_SESSION['doctor_id'];
$status = $_POST['status'];
$type = $_POST['insertOrUpdate'];
$created_at = Carbon::now();

if($type == 'insert'){
        $database->query("insert into health_monitoring (patient_id,weight,height,blood_pressure,note,created_at) values ('$patient_id','$weight','$height','$bp','$note','$created_at')");
        header("location: patient.php?pid=".$patient_id);
}else{
    $database->query("update health_monitoring set weight='$weight',height='$height',blood_pressure='$bp',note='$note', updated_at='$created_at' where patient_id='$patient_id'");
    header("location: patient.php?pid=".$patient_id);
}
?>