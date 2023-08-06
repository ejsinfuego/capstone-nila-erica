<?php

include('../connection.php');
use Carbon\Carbon;

session_start();



if(isset($_GET['pid'])){
    $getHealthRecord = $database->query("select * from health_monitoring where patient_id=".$_GET['pid']);
    $getPatient = $database->query("select * from patient where pid=".$_GET['pid']);
    $patientfetch=$getPatient->fetch_assoc();
    if($getHealthRecord->num_rows >= 1){
        $healthRecord = $getHealthRecord->fetch_assoc();?>
        <form method="POST" action="edit_health_monitor.php">
        <label><?php echo $patientfetch['pname']; ?></label>
        <label>Weight</label>
        <input type="text" name="weight" value="<?php echo $healthRecord['weight']; ?>">
        <label>Height</label>
        <input type="text" name="height" value="<?php echo $healthRecord['height']; ?>">
        <label>Blood Pressure</label>
        <input type="text" name="bp" value="<?php echo $healthRecord['blood_pressure']; ?>">
        <label>Note</label>
        <input type="text" name="note" value="<?php echo $healthRecord['note']; ?>">
        <input type="hidden" name="insertOrUpdate" value="update">
        <input type="hidden" name="patient_id" value="<?php $_GET['pid']?>">
        <input type="hidden" name="status" value="ok">
        <input type="submit" name="submit">
        </form>
     <?php  
    }else{?>
        <form method="POST" action="edit_health_monitor.php">
        <label><?php echo $patientfetch['pname']; ?></label>
        <label>Weight</label>
        <input type="text" name="weight" value="">
        <label>Height</label>
        <input type="text" name="height" value="">
        <label>Blood Pressure</label>
        <input type="text" name="bp" value="">
        <label>Note</label>
        <input type="text" name="note" value="">
        <input type="hidden" name="insertOrUpdate" value="insert">
        <input type="hidden" name="patient_id" value="<?php echo $_GET['pid']?>">
        <input type="hidden" name="status" value="ok">
        <input type="submit" name="submit">
        </form>
        <?php       
    }}?>