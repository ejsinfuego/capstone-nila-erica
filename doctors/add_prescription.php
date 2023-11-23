<?php 
$title= 'Edit Prescription';
$border = "border-left: 3px solid #2E8B57;";

if(!strpos($_SERVER['REQUEST_URI'], 'add_prescription.php')){
    
}else{
    if($_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == ''){
        header('Location: ../login_v2.php');
    }
    session_abort();
    include(__DIR__ . '/../_header_v2.php');
}


require '../vendor/autoload.php';
use Carbon\Carbon;

$time = Carbon::now('Asia/Kolkata');

if(isset($_GET['patient_id'])){
$patient_name = $database->query("select f_name, l_name from patient where pid = ".$_GET['patient_id']);
}else{
    $patient_name = $database->query("select pid, f_name, l_name from patient");
}
?>
<div class="col" style="padding-top: 27px;background: #f1f0f0;border-radius: 10px;">
    <form method="POST" action="addPrescription.php" class="text-start" style="border-radius: 10px;">
        <h2 class="text-center justify-content-around" style="text-shadow: 0px 0px;padding-bottom: 0;">Prescriptions</h2>
        <h6 class="text-center">Fill out with necessary information about</h6>
        <label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Patient Name</label>
        <select class="form-select" name="patient_id" style="margin-bottom: 18px;">
            <?php foreach($patient_name as $patient): ?>
            <option value="<?php echo $patient['pid']; ?>"><?php echo $patient['f_name']." ".$patient['l_name']; ?></option>
        <?php endforeach; ?>
        </select>
        <label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Diagnosis</label>
        <input class="form-control" name="diagnosis" type="text" /><label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Notes (Medicines, dosage, etc.)</label><textarea class="form-control" name="note"></textarea>
        <input class="btn btn-sm btn-primary p-3" type="submit" style="margin-top: 18px;margin-bottom: 18px;background: #2E8B57;" />
    </form>
</div>
<?php 
if(!strpos($_SERVER['REQUEST_URI'], 'add_prescription.php')){
    
}else{
    include(__DIR__ . '/../_footer.php');
}
 ?>

