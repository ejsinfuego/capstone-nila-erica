<?php 

$title = 'Appointments';

$border = "border-left: 3px solid #2E8B57;";

include(__DIR__ . '/../_header_v2.php');


if($_SESSION['usertype'] != 'p'){
    header('location: ../unauthorized.php');
}
    //get available medicine list from database
    $appointments = $database->query("select patient.f_name, patient.l_name, patient.pid, consultation.consultation_id, consultation.type, consultation.patient_id, consultation.date, consultation.time, consultation.stat from consultation inner join patient on consultation.patient_id = patient.pid where patient_id = $userid");
    $appointments_booked=$appointments->fetch_assoc();

    $services = $database->query("select * from services");

    //get available medicine list from database
    //sql command which gets the med name and patient name in using request_medicine table using inner join
    $medicinerow = $database->query("select patient.f_name, patient.l_name, medicine_inventory.med_name, request_medicine.quantity, request_medicine.status from patient inner join request_medicine on patient.pid = request_medicine.patient_id inner join medicine_inventory on request_medicine.medicine_id = medicine_inventory.medicine_id where patient_id = $userid;
    ");
    $medicinefetch=$medicinerow->fetch_assoc();

    $prescriptions = $database->query("select * from prescription where patient_id = ".$userid);

?>
<style>
    .btn {
        background-color:#2E8B57!important;
        color: white;
    }
</style>
<script>
//ajax script to cancel appointment
function cancelAppointment(appointment_id){
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            location.reload();
        }
    };
    xhttp.open("GET", "cancel_appointment.php?appointment_id="+appointment_id, true);
    xhttp.send();
}


$(document).ready(function(){
    $('.editAppointment').click(function(){
        $('#updateAppointment').modal('show');
        let appointmentid = document.getElementById('id').value;
        $('#appointmentid').val(appointmentid);
        
    })
});
</script>
<!-- required bootstrap js -->
<div class="col">
    <ul class="nav nav-tabs" role="tablist" s>
    <li class="nav-item">
        <a class="nav-link active h5" data-toggle="tab" href="#home" style="color: #2E8B57;">Appointments</a>
    </li>
    <li class="nav-item h5">
        <a class="nav-link" data-toggle="tab" href="#menu1" style="color: #2E8B57;">Medicine Requests</a>
    </li>
    <li class="nav-item h5">
        <a class="nav-link" data-toggle="tab" href="#menu2" style="color: #2E8B57;">Prescriptions</a>
    </li>
    </ul>

    <div class="tab-content">
    <div id="home" class="container tab-pane active">
    <div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px; border: 2px solid #2E8B57;">
        <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Appointments Schedule</h1>
        <p>List of Appointments</p>
        <div class="py-2" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table table-sm" id="sortTable">
                        <thead>
                            <tr></tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Type</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Time</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);"></th>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
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
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <?php if($appointment['stat'] != "Cancelled"): ?>
                                <button id="editAppointment" class='editAppointment btn btn-primary btn-sm' type='button' style='background: #2ecc71;border-style: none;'>Update</button>
                                <input type="hidden" id="id" name="appointmentid" value="<?php echo $appointment['consultation_id']; ?>">
                                <button type="submit" onclick="cancelAppointment(<?php echo $appointment['consultation_id']; ?>)" class='text-danger' type='button' style='border-style: none; margin-left: 10px;'>Cancel</button>
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
    <div class="col" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;">
            <div class="table-responsive" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                <div class="container" style="padding-bottom: 9px;padding-top: 16px;">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Medicine Requests</h1>
                </div>
                    <table class="table table-sm" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Medicine Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php
                        if($medicinerow->num_rows==0){
                            echo "<tr style='border-style: solid;background: rgba(255,255,255,0);'>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>No Medicine Requests</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'></td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'></td>";
                            echo "</tr>";
                        }else
                        foreach($medicinerow as $medicinefetch) {
                            echo "<tr style='border-style: solid;background: rgba(255,255,255,0);'>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$medicinefetch['med_name']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$medicinefetch['quantity']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$medicinefetch['status']."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <div id="menu2" class="container tab-pane fade">
    <div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px; border: 2px solid #2E8B57;">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Prescriptions</h1>
                <p>List your Prescriptions</p>
                <div class="py-2" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Prescription ID</th>
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
</div>

</div>
<div id='updateAppointment' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
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
</div>
<div id="request_medicine" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php include('request_medicine.php'); ?>
            </div>
        </div>
    </div>
</div>

<!-- //scrpt for bootstrap tab -->
<script>
    $(document).ready(function(){
        $('.nav-tabs a').click(function(){
            $(this).tab('show');
        });

        $("#reqmed").click(function(){
            $("#request_medicine").modal('show');
        });
    });
</script>

<?php  include(__DIR__ . '/../_footer.php'); ?>