<?php 
$title = "Health Monitor";
$border = "border-left: 3px solid #2E8B57;";
include(__DIR__ . '/../_header_v2.php'); 


if(isset($_GET['pid'])){
    $patients = $database->query('select patient.pid, patient.f_name, patient.l_name, health_monitoring.weight, health_monitoring.height, health_monitoring.blood_pressure, health_monitoring.patient_pid, health_monitoring.note from health_monitoring inner join patient on health_monitoring.patient_pid = patient.pid where pid='.$_GET['pid']);
    if($patients->num_rows==0){
        $patients = $database->query('select * from patient where pid='.$_GET['pid']);
    }

    $patients = $patients->fetch_assoc();

}
?>
            <div class="col-lg-8 col-xxl-9 d-lg-flex d-xxl-flex flex-column align-items-lg-center justify-content-xxl-center align-items-xxl-center ms-0" style="background: rgba(241,240,240,0.6);font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;height: auto;border: 1px solid rgba(30,128,193,0.52) ;">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Health Records</h1>
                <p>Patient's health information</p>
                <hr style="width: 535px;margin-top: 0px;color: #1e80c1;">
                <div class="card mb-5" style="width: auto;">
                    <div class="card-body d-flex flex-row flex-nowrap justify-content-lg-start align-items-lg-center" style="width: auto;margin-left: 6px;">
                        <form method="post" action="editHealthRecords.php" style="width: 489px;margin-left: 0px;margin-top: 20px;" class="text-center d-flex flex-row flex-wrap justify-content-lg-start align-items-lg-center ms-2" >
                            <input class="form-control" type="hidden" name="patient_id" value="<?php echo $patients['pid']; ?>"/>
                            <div class="mb-3" style="margin-right: 12px;"><label class="form-label d-lg-flex justify-content-lg-start">First Name</label>
                            
                            <input class="form-control" type="text" name="first_name" placeholder="<?php echo $patients['f_name']; ?>">
                            </div>
                            <div class="mb-3"><label class="form-label d-lg-flex justify-content-lg-start">Last Name</label>
                            <input class="form-control" type="text" name="lastname" placeholder="<?php echo $patients['l_name']; ?>">
                            </div>
                            <div class="mb-3" style="margin-right: 12px;"><label class="form-label text-center d-lg-flex justify-content-lg-start">Weight</label>
                            <input class="form-control" type="text" name="weight" placeholder="<?php echo (isset($patients['weight'])) ?$patients['weight'] : "";?>"></div>
                            <div class="mb-3"><label class="form-label d-lg-flex justify-content-lg-start">Height</label>
                            <input class="form-control" type="text" name="height" placeholder="<?php echo (isset($patients['height'])) ?$patients['height'] : "";?>"></div>
                            <div class="mb-3" style="margin-right: 12px;"><label class="form-label d-lg-flex justify-content-lg-start">Blood Pressure</label>
                            <input class="form-control" type="text" name="bp" placeholder="<?php echo (isset($patients['blood_pressure'])) ?$patients['blood_pressure'] : "";?>">
                            </div>
                            <div class="mb-3" style="width: 100%;"><label class="form-label d-lg-flex justify-content-lg-start">Note</label>
                            <textarea class="form-control form-control-lg" type="text" name="note" placeholder="<?php echo (isset($patients['note'])) ?$patients['note'] : "";?>"></textarea>
                            </div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100" name="submit" type="submit" style="background: #1e80c1;margin-left: 0px;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php include(__DIR__ . '/../_footer.php'); ?>