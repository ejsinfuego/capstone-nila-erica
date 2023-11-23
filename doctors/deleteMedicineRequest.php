<?php

 session_start();
 if($_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == ''){
    header('Location: ../login_v2.php');
}

    include('../connection.php');
    //delete all picked appointments
    if(isset($_GET['request_medicine_id'])){
        $request_medicine_id = $_GET['request_medicine_id'];
        $database->query("DELETE FROM request_medicine WHERE request_medicine_id = '$request_medicine_id'");
       
        }
        $_SESSION['message'] = "Request deleted successfully";
        $_SESSION['show_modal'] = "myModal";
        header('location: request_medicine.php');    
