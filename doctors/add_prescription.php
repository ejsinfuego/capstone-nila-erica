<?php 
$title= 'Edit Prescription';
$border = "border-left: 3px solid #2E8B57;";
include(__DIR__ . '/../_header_v2.php');

require '../vendor/autoload.php';
use Carbon\Carbon;

$time = Carbon::now('Asia/Kolkata');

if(isset($_GET['patient_id'])){
$patient_name = $database->query("select f_name, l_name from patient where pid = ".$_GET['patient_id']);
}else{
    $patient_name = $database->query("select pid, f_name, l_name from patient");
}
?>
<div class="col" style="padding-left: 38px;padding-right: 88px;padding-top: 27px;background: #f1f0f0;margin-left: 22px;border-radius: 10px;">
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
        <input class="btn btn-lg btn-primary py-md-0 my-md-0 my-sm-0 py-sm-5 my-lg-4 px-lg-3 py-lg-0" type="submit" style="margin-top: 18px;margin-bottom: 18px;background: #3d52d5;padding-top: 0px;padding-bottom: 0px;height: 49px;" />
    </form>
</div>
<?php include(__DIR__ . '/../_footer.php'); ?>

