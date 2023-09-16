<?php 
$title = "Health Monitor";
$border = "border-left: 3px solid #2E8B57;";
include(__DIR__ . '/../_header_v2.php'); 

    $patients = $database->query('select patient.pid, patient.f_name, patient.l_name, health_monitoring.weight, health_monitoring.height, health_monitoring.blood_pressure, health_monitoring.patient_pid, health_monitoring.note from health_monitoring inner join patient on health_monitoring.patient_pid = patient.pid where pid='.$userid);
    $patients = $patients->fetch_assoc();

?>
            <div class="col-lg-8 col-xxl-9 d-lg-flex d-xxl-flex flex-column align-items-lg-center justify-content-xxl-center align-items-xxl-center ms-0" style="background: rgba(241,240,240,0.6);font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;height: auto;border: 1px solid #2E8B57;">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Health Records</h1>
                <p>Patient's health information</p>
                <hr style="width: 535px;margin-top: 0px;color: #1e80c1;">
                <div class="card mb-5" style="width: auto;">
                    <div class="card-body d-flex flex-row flex-nowrap justify-content-lg-start align-items-lg-center" style="width: auto;margin-left: 6px;">
                        <form method="post" action="editHealthRecords.php" style="width: 489px;margin-left: 0px;margin-top: 20px;" class="text-center d-flex flex-row flex-wrap justify-content-lg-start align-items-lg-center ms-2">
                            <div class="mb-3 d-flex flex-column w-100" style="margin-right: 12px;"><label class="form-label justify-content-lg-start">First Name</label> 
                            <p class="form-control" name="first_name"><?php echo $patients['f_name']; ?></p>
                            <label class="form-label justify-content-lg-start">Last Name</label>
                            <p class="form-control" name="lastname"><?php echo $patients['l_name']; ?></p>
                            </div>
                            <div class="mb-3" style="margin-right: 12px;" >
                            </div>
                            <div class="mb-3" style="margin-right: 12px;"><label class="form-label d-lg-flex justify-content-lg-start">Weight</label>
                            <p class="form-control" name="weight"><?php echo $patients['weight']; ?>kg</p></div>
                            <div class="mb-3" style="margin-right: 12px;"><label class="form-label d-lg-flex justify-content-lg-start">Height</label>
                            <p class="form-control" name="height"><?php echo $patients['height']; ?>cm</p></div>
                            <div class="mb-3" style="margin-right: 12px;"><label class="form-label d-lg-flex justify-content-lg-start">Blood Pressure</label>
                            <p class="form-control" name="bp"><?php echo $patients['blood_pressure']; ?></p>
                            </div>
                            <div class="mb-3" style="width: 100%;"><label class="form-label d-lg-flex justify-content-lg-start">Note</label>
                            <p class="form-control form-control-lg" name="note">
                            <?php echo $patients['note']; ?>
                            </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php include(__DIR__ . '/../_footer.php'); ?>