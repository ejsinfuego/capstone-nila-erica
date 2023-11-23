<?php 
session_start();
require '../vendor/autoload.php';
use Carbon\Carbon;

include("../connection.php");

$userid = $_SESSION['userid'];
//post to add medicine
if($_POST){
    //insert new med
    $med_name = $_POST['med_name'];
    $med_qty = $_POST['med_qty'];
    $med_desc = $_POST['med_desc'];
    $med_dosage = $_POST['med_dosage'];
    $med_unit = $_POST['med_unit'];
    $med_acquired = Carbon::now('Asia/Kolkata');
    $acquired_by = $userid;

    $database->query("insert into medicine_inventory (med_name, med_qty, med_desc, med_dosage, med_unit, acquired_by, created_at) values ('$med_name', '$med_qty', '$med_desc', '$med_dosage', '$med_unit', '$acquired_by', '$med_acquired')");
    
}
    $_SESSION['message']="Medicine Added!";
    $_SESSION['show_modal'] = "myModal";
    header("location: medicine_inventory.php");