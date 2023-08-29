<?php

//cancel appointment
if(isset($_POST['appointment_ids'])){
    $appointment_ids = $_POST['appointment_ids'];
    foreach($appointment_ids as $appointment_id){
        $database->query("update consultation set stat = 'cancelled' where id = $appointment_id");
    }
    echo "Appointment(s) cancelled successfully";
}