<?php 
$title = "Health Monitor";
$border = "border-left: 3px solid #2E8B57;";


session_start();
if($_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == ''){
    header('Location: ../login_v2.php');
}
session_abort();
include(__DIR__ . '/../_header_v2.php');



if(isset($_GET['pid'])){
    $patients = $database->query('select * from patient inner join health_monitoring on patient.pid = health_monitoring.patient_pid where patient_pid='.$_GET['pid']);

    $patients = $patients->fetch_assoc();

    $prescriptions = $database->query("select * from prescription inner join patient on prescription.patient_id = patient.pid where patient_id=".$_GET['pid']);

    $appointments = $database->query("select * from consultation inner join patient on consultation.patient_id = patient.pid where patient_id =".$_GET['pid']);
    $appointments_booked=$appointments->fetch_assoc();

    $medicinerow = $database->query("select patient.pid, patient.f_name, patient.l_name, medicine_inventory.med_name, request_medicine.request_medicine_id, request_medicine.quantity, request_medicine.approved_by, request_medicine.updated_at, request_medicine.status from patient inner join request_medicine on patient.pid = request_medicine.patient_id inner join medicine_inventory on request_medicine.medicine_id = medicine_inventory.medicine_id where patient.pid=".$_GET['pid']);

}
?>
<div class="col col-xxl-9 d-lg-flex d-xxl-flex flex-column align-items-lg-center justify-content-xxl-center align-items-xxl-center py-2" style="background: rgba(241,240,240,0.6);font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px; height: auto;border: 1px solid rgba(30,128,193,0.52);">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Health Records
                <?php if(isset($_GET['pid'])): ?>
                <?php echo 'of '.$patients['f_name'].' '.$patients['l_name']; ?>
                <?php endif; ?>
                </h1>
                <p>Patient's health information</p>
                <hr style="width: 535px;margin-top: 0px;color: #2E8B57;">
<div class="container-fluid">
  <div class="row">
    <!-- Box 1 -->
    <div class="col-md-4">
      <div class="box">
      <div class="card mb-5">
                    <div class="card-body d-flex flex-row flex-nowrap justify-content-lg-start align-items-lg-center" style="font-size: 0.9rem;">
                        <form method="post" action="editHealthRecords.php" style="width: 489px;margin-left: 0px;margin-top: 20px;" class="d-flex flex-row flex-wrap justify-content-lg-start align-items-lg-center ms-2" >
                            <input class="form-control" type="hidden" name="patient_id" value="<?php echo $patients['pid']; ?>"/>
                            <div class="mb-3" style="margin-right: 12px;"><label class="form-label d-lg-flex justify-content-lg-start">Weight <i><small>(kilogram/kg)</small></i></label>
                            <input class="form-control" type="text" name="weight" placeholder="<?php echo (isset($patients['weight'])) ?$patients['weight'] : "";?>"
                            value="<?php echo(isset($patients['weight'])) ?$patients['weight'] : "";?>"></div>
                            <div class="mb-3"><label class="form-label d-lg-flex justify-content-lg-start">Height <i><small> (centimeter/cm)</small></i></label>
                            <input class="form-control" type="text" name="height" placeholder="<?php echo (isset($patients['height'])) ?$patients['height'] : "";?>"
                            value="<?php echo (isset($patients['height'])) ?$patients['height'] : "";?>"
                            /></div>
                            <div class="mb-3" style="margin-right: 12px;"><label class="form-label d-lg-flex justify-content-lg-start">Blood Pressure</label>
                            <input class="form-control" type="text" name="bp" placeholder="<?php echo (isset($patients['blood_pressure'])) ?$patients['blood_pressure'] : "";?>"
                            value="<?php echo (isset($patients['blood_pressure'])) ?$patients['blood_pressure'] : "";?>
                            ">
                            </div>
                            <div class="mb-3" style="width: 100%;"><label class="form-label d-lg-flex justify-content-lg-start">Health Analysis</label>
                            <textarea class="form-control form-control-lg" type="text" name="note" placeholder="<?php echo (isset($patients['note'])) ?$patients['note'] : "";?>"></textarea>
                            </div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100" name="submit" type="submit" style="background: #2E8B57;margin-left: 0px;">Save</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
      </div>
    </div>

    <!-- Box 2 -->
    <div class="col-md-8">
      <div class="box">
      <div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;border-radius: 10px; border: 2px solid #2E8B57;">
                <h4 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Prescriptions</h4>
                <p>List your Prescriptions</p>
                <div class="col" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table id="prescriptionTable" class="table sortTable table-sm compact hover table-responsive">
                        <thead>
                            <tr style="border-style: solid;background: rgba(255,255,255,0); font-size: 0.8rem;">
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Prescription ID</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Note</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Diagnosis</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date Prescribed</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Action</th>

                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0); font-size: 0.8rem;">
                        <?php
                        if(mysqli_fetch_column($prescriptions) == 0){
                            echo "</p>No prescriptions found.</p>";
                        }else{
                        foreach($prescriptions as $prescription){
                            echo "<tr style='border-style: solid;background: rgba(255,255,255,0);'>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['prescription_id']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['f_name'].' '.$prescription['l_name']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['note']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['diagnosis']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".date('M d, Y', strtotime($prescription['created_at']))."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                            <form method='get'action='generateReport.php'>
                            <input type='hidden' name='prescription_id' value='".$prescription['prescription_id']."'>
                            <button class='btn btn-sm'style='background-color: #2E8B57; color: white; font-size: 0.8rem;' type='submit' prescription_id=".$prescription['prescription_id']."'>Print</button>
                            </form>
                            </td>";
                            echo "</tr>";

                        }
                    }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
    </div>

    <!-- Box 3 -->
    <div class="col-md-6">
    <div class="box" id="appointmentsBox">
      <div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;border-radius: 10px; border: 2px solid #2E8B57;">
                <h4 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Appointments</h4>
                <p>List of Appointments</p>
                <div class="col" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);border-radius: 15px; background: #f1f0f0;">
                    <table id="appointmentTable" class="table sortTable table-sm compact hover table-responsive" id="sortTable" style="font-size: 0.8rem;">
                        <thead style="border-style: solid;background: rgba(255,255,255,0); font-size: 0.8rem;">
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Type</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Time</th>
                                <?php if($_SESSION['usertype'] == 'do') : ?>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0); font-size: 0.8rem;">
                        <?php foreach($appointments as $appointment):
                                $patient_name = $appointment['f_name']." ".$appointment['l_name'];
                                $appointment['type'] = ucfirst($appointment['type']);
                                $appointment['stat'] = ucfirst($appointment['stat']);
                                $appointment['time'] = date('h:i A', strtotime($appointment['time']));
                                ?>
                                <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0); font-weight: bold;'><?php echo $patient_name; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['type']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['stat']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['date']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['time']; ?>
                                </td>
                                <?php if($_SESSION['usertype'] == 'do') : ?>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <?php if($appointment['stat'] != "Cancelled"): ?>
                                <button id="editAppointment" class='editAppointment btn btn-primary btn-sm' type='button' style='background: #2ecc71;border-style: none;'>Update</button>
                                <input type="hidden" id="id" name="appointmentid" value="<?php echo $appointment['consultation_id']; ?>">
                                <button type="submit" onclick="cancelAppointment(<?php echo $appointment['consultation_id']; ?>)" class='text-danger' type='button' style='border-style: none; margin-left: 10px;'>Cancel</button>
                                <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
    </div>

    <!-- Box 4 -->
    <div class="col-md-6">
      <div class="box" id="medRequestBox">
      <div id="appsBox" class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;border-radius: 10px; border: 2px solid #2E8B57;">
                <h4 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Medicine Requests</h4>
                <p>List of Medicine Requests</p>
                <hr style="width: auto; color: #2E8B57;">
                <div class="py-2 w-100" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table id="medicineRequestTable" style="border-radius: 6px; font-size: 15px;" class="table table-responsive table-sm compact sortTable" style="width: 500px;">
                        <thead>
                            <tr>
                                <th class="" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                                <th class="" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Medicine Name</th>
                                <th class="" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                                <th class="" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                                <?php if($_SESSION['usertype'] == 'ph') :?>
                                <th class="" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);"></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php foreach($medicinerow as $medicinefetch) : ?>
                            <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <form method="GET" action="Health_monitor.php"><input type="hidden" name="pid" value="<?php echo $medicinefetch['pid']; ?>"><input name="submit" type="submit" style="border: none; background: none;" value="<?php echo $medicinefetch['f_name'].' '.$medicinefetch['l_name']; ?>"></form>
                                </td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['med_name']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['quantity']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0); font-size: 12px;'><?php
                                if($medicinefetch['status'] == 'approved'){
                                    echo ucfirst($medicinefetch['status']).' by '.$medicinefetch['approved_by'].' on '.date('M d, y',strtotime($medicinefetch['updated_at']));
                                }else{

                                    echo ucfirst($medicinefetch['status']);
                                }
                                ?></td>
                                <?php if($_SESSION['usertype'] == 'ph') :?>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <form method="GET" action="">
                                        <div class="">
                                            <?php if ($medicinefetch['status'] == 'pending' and $medicinefetch['status'] != 'approved') : ?>
                                            <small>
                                            <button class="btn btn-primary btn-sm" onclick="approveMedicineRequest(<?php echo $medicinefetch['request_medicine_id']; ?>)" style="background: transparent;font-family: Courier, monospace, sans-serif;color: #1e80c1;border: 1px solid #1e80c1;">Approve</button></small>
                                            <?php elseif ($medicinefetch['status'] == 'approved' and $medicinefetch['status'] != 'pending') : ?>
                                            <small><button onclick="claimMedicine(<?php echo $medicinefetch['request_medicine_id']; ?>)" class="btn btn-success btn-sm" style="background: transparent;font-family: Courier, monospace, sans-serif;color: #1e80c1;border: 1px solid #1e80c1;">Claimed</button></small>
                                            <?php else : ?>
                                            <input id="request_medicine" name="request_medicine_id" type="hidden" value="<?php echo $medicinefetch['request_medicine_id']; ?>">
                                        <?php endif; ?>
                                        <button id="deleteButton" onclick="deleteMedicineRequest(<?php echo $medicinefetch['request_medicine_id']; ?>)" class="btn btn-sm danger ms-sm-2"><svg class="bi bi-trash3-fill" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path></svg>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            <?php endif; ?>
                            </tr>  
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
      </div>
    </div>
    </div>
  </div>
<?php include(__DIR__ . '/../_footer.php'); ?>