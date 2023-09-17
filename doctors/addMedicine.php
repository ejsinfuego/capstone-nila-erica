<?php 
session_start();
require '../vendor/autoload.php';
use Carbon\Carbon;

include("../connection.php");

//post to add medicine
if($_POST){
    $currentNumber = $database->query("select med_qty from medicine_inventory where medicine_id=".$_POST['med_id'])->fetch_assoc()['med_qty'];
    $quantity=$_POST['addMed']+$currentNumber;
    $description=$_POST['description'];
    $timestamp= Carbon::now('Asia/Kolkata');
    
    $database->query("update medicine_inventory set med_qty='$quantity', updated_at='$timestamp' where medicine_id=".$_POST['med_id']);
    
}
    $_SESSION['message']="Medicine Added!";
    $_SESSION['show_modal'] = "myModal";
    header("location: medicine_inventory.php");