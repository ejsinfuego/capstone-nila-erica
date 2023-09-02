<?php 
#code to from the request_medicine user input and store in the database

require '.\vendor\autoload.php';
use Carbon\Carbon;
session_start();
$timeNow = Carbon::now('Asia/Kolkata');


         //code that post the request to the database for medicine request
         include("connection.php");
         
         
 
       
         $getNumbers = $database->query("select med_qty from medicine_inventory where medicine_id = '".$_POST['medicine_id']."'");
         if(isset($_POST["submit"])){
          
               $medicineid=$_POST['medicine_id'];
               $quantity=$_POST['quantity'];
               $prescriptionid=$_POST['prescription_id'];
               $patientid=$_POST['patient_id'];
               $note = $_POST['note'];
               $status="pending";
               $date= $timeNow;  
   
               if($getNumbers->fetch_assoc()['med_qty'] >= $quantity){
                  $database->query("update medicine_inventory set med_qty = med_qty - $quantity where medicine_id = '".$_POST['medicine_id']."'");
                  $database->query("insert into request_medicine(medicine_id, quantity, prescription_id, patient_id, status, note, created_at, updated_at) values('$medicineid','$quantity','$prescriptionid','$patientid','$status','$note','$date','$date')");
                  $_SESSION['message']="Request sent!";
                  $_SESSION['show_modal'] = "myModal";
                  header("location: ./patients/requests_medicine.php");
             }
                  header("location: ./patients/medicine_requests.php");
          }else{
               $_SESSION['message']="There's no enough stock in the inventory!";
               $_SESSION['show_modal'] = "myModal";
               header("location: ./patients/requests_medicine.php");
          }echo "failed";



?>