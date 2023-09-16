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

?>

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
</script>
<div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px; border: 2px solid #2E8B57;">
        <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Appointments Schedule</h1>
        <p>List of Appointments</p>
        <div class="py-2" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table table-sm" id="sortTable">
                        <thead>
                            <tr>
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
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(163,207,187,0.67);'><?php echo $appointment['stat']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['date']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['time']; ?>
                                </td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <form method="GET" action="">
                                <a href='edit_appointment.php' class='btn btn-primary btn-sm' type='button' style='background: #2ecc71;border-style: none;'>Update</a>
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['consultation_id']; ?>">
                                <?php if($appointment['stat'] == 'cancelled'): ?>
                                <button type="submit" onclick="cancelAppointment(<?php echo $appointment['consultation_id']; ?>)" class='text-danger' type='button' style='border-style: none; margin-left: 10px;'>Cancel</button>
                                <?php endif; ?>
                                </form>
                                </td>
                                </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

<?php  include(__DIR__ . '/../_footer.php'); ?>