
<?php 
$title = 'Appointments';
$border = "border-left: 3px solid #2E8B57;";

session_start();
if($_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == '') :
header("Location: ../login_v2.php");

 ?><?php else: ?>
<?php
session_abort();
include(__DIR__ . '/../_header_v2.php'); 
   
    //get available appointments list from database
    $appointments = $database->query("select consultation.*, patient.pid, patient.f_name, patient.l_name from consultation left join patient on consultation.patient_id = patient.pid order by time asc");

    $prescriptions = $database->query("select * from prescription inner join patient on prescription.patient_id = patient.pid");

?>
  <div class="modal" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Notice</h4>
          <button type="button" id="closeModal" class="closeModal" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            Are you sure you want to delete the appointments?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="deleteAppointment.php" onclick="" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</a>
          <button type="button" class="btn text-white closeModal" id="closeModal" style="background-color: #2E8B57;" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>


  <div class="col mx-3">
    <ul class="nav nav-tabs z-3 position-absolute" role="tablist">
    <li class="nav-item">
        <a class="nav-link active h6" data-toggle="tab" href="#home" style="color: #2E8B57; background-color: #f1f0f0;">Appointments</a>
    </li>
    <li class="nav-item h6">
        <a class="nav-link" data-toggle="tab" href="#menu1" style="color: #2E8B57; background-color: #f1f0f0;">Medicine Requests</a>
    </li>
    <li class="nav-item h6">
        <a class="nav-link" data-toggle="tab" href="#menu2" style="color: #2E8B57; background-color: #f1f0f0;">Prescriptions</a>
    </li>
    <li class="nav-item h6">
        <a class="nav-link" data-toggle="tab" href="#menu3" style="color: #2E8B57; background-color: #f1f0f0;">Patients</a>
    </li>
    <li class="nav-item h6">
        <a class="nav-link" data-toggle="tab" href="#menu4" style="color: #2E8B57; background-color: #f1f0f0;">Medicine Inventory</a>
    </li>
    
    </ul>
    
    <div class="tab-content mt-4">

    <div id="home" class="container tab-pane active" style="background: #f1f0f0;font-family: Montserrat, sans-serif;border-radius: 10px; border: 2px solid #2E8B57;">
    <div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" >
        <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Appointments Schedule</h1>
        <p>List of Appointments</p>
        <div class="py-2" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table table-sm appointment sortTable" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Type</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Time</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Note</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Updated On</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date Booked</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Action</th>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php foreach($appointments as $appointment):
                                $patient_name = $appointment['f_name']." ".$appointment['l_name'];
                                $appointment['type'] = ucfirst($appointment['type']);
                                $appointment['stat'] = ucfirst($appointment['stat']);
                                $appointment['time'] = date('h:i A', strtotime($appointment['time']));
                                $appointment['date'] = date('M d, Y', strtotime($appointment['date']));
                                ?>
                                <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0); font-weight: bold;'><?php echo $patient_name; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['type']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['stat']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['date']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['time']; ?>
                                </td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <?= $appointment['note'] ?? '' ;?>
                                
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <?= ($appointment['updated_at'] != '0000-00-00 00:00:00') ? date('M d, Y', strtotime($appointment['updated_at'])) : 'N/A' ;?>
                                </td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <?= date('M d, Y', strtotime($appointment['created_at'])) ?? '' ;?>
                                </td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>

                                <?php if($_SESSION['usertype'] == 'do') : ?>

                                    <?php if($appointment['stat'] != "Cancelled" and $appointment['stat'] != "Approved"): ?>
                                    <form method="GET" action="approveAppointment.php">
                                    <input type="hidden" id="id" name="appointment_id" value="<?php echo $appointment['consultation_id']; ?>">
                                    <button id="editAppointment" class='editAppointment btn btn-primary btn-sm' type='submit' style='background: #2ecc71;border-style: none;'>Approve</button>
                                    </form>
                                    <?php else : ?>

                                    <?php endif; ?>
                                <?php endif; ?>
                                </td>
                                </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <div id="menu1" class="container tab-pane fade">
        <?php include('medicine_requests.php'); ?>
    </div>
    <div id="menu2" class="container tab-pane fade">
    <div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;border-radius: 10px; border: 2px solid #2E8B57;">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Prescriptions</h1>
                <p>List your Prescriptions</p>
                <div class="py-2" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table table-sm sortTable" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Prescription ID</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Note</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Diagnosis</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date Prescribed</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Action</th>

                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
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
                            <button class='btn'style='background-color: #2E8B57; color: white;' type='submit' prescription_id=".$prescription['prescription_id']."'>Print</button>
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
    <div id="menu3" class="container tab-pane fade">
        <?php include('patients.php'); ?>
    </div>
    <div id="menu4" class="container tab-pane fade">
        <?php include('medicine_inventory.php'); ?>
    </div>
</div>
</div>
<!-- <div id='updateAppointment' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Update Appointment</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="edit_appointment.php">
                <label for="appointmentDate">Appointment Date</label>
                <input type="date" name="appointmentDate" id="appointmentDate" class="form-control">
                <label for="appointmentTime">Appointment Time</label>
                <input type="time" name="appointmentTime" id="appointmentTime" class="form-control">
                <input type="hidden" id="appointmentid" name="appointmentid">
                <label for="appointmentType">Appointment Type</label>
                <select class="form-control" name="appointmentType">
                    <optgroup>Types</optgroup>
                    <option value="consultation" selected="">Consultation</option>
                            <option value="xray">Xray</option>
                            <option value="urinalysis">Urinalysis</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div> -->
<div id="request_medicine" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php include('request_medicine.php'); ?>
            </div>
        </div>
    </div>
</div>

<div id="newMedModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php include('newMedTab.php'); ?>
            </div>
        </div>
    </div>
</div>

<!-- //scrpt for bootstrap tab -->
<script>
   
</script>

<?php  include(__DIR__ . '/../_footer.php'); ?>
<?php endif;?>
