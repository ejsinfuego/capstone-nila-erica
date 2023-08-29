<?php 

$title = 'Appointments';

include(__DIR__ . '/../_header_v2.php');


if($_SESSION['usertype'] != 'p'){
    header('location: ../unauthorized.php');
}
    //get available medicine list from database
    $appointments = $database->query("select * from consultation where patient_id = $userid");
    $appointments_booked=$appointments->fetch_assoc();

    
?>
<script>
//ajax script to cancel appointment
function cancel_appointment(id){
    $.ajax({
        url: 'cancel_appointment.php',
        type: 'POST',
        data: {appointment_id: id},
        success: function(response){
            alert(response);
            location.reload();
        }
    });
}
</script>
<div class="col" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;">
    <h1 style="font-family: Montserrat, sans-serif;padding: 17px;padding-top: 20px;margin-left: 150px;margin-right: -3px;padding-left: 20px;padding-right: 20px;border-radius: 10px;background: #f1f0f0;margin-top: 10px;">Appointments Schedule</h1>
    <div class="table-responsive" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Type</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Time</th>
                </tr>
            </thead>
            <tbody style="border-style: solid;background: rgba(255,255,255,0);">
              <?php 
                foreach($appointments as $appointment){

                    $patient_name = $database->query("select pname from patient where pid = ".$appointment['patient_id'])->fetch_assoc()['pname'];

                    $patient_name = ucfirst($patient_name);
                    $appointment['type'] = ucfirst($appointment['type']);
                    $appointment['stat'] = ucfirst($appointment['stat']);
                    $appointment['time'] = date('h:i A', strtotime($appointment['time']));
                    
                    echo "<tr style='border-style: solid;background: rgba(255,255,255,0);'>";
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0); font-weight: bold;'>".$patient_name."</td>";
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$appointment['type']."</td>";
                    echo (($appointment['stat']=='approved') ? "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(163,207,187,0.67);'>".$appointment['stat']."</td>" : "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(30,128,193,0.2);'>".$appointment['stat']."</td>");
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$appointment['date']."</td>";
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$appointment['time']."
                    </td>
                    <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                    <a href='edit_appointment.php' class='btn btn-primary btn-sm' type='button' style='background: #2ecc71;border-style: none;'>Update</a>
                    <a href='' onClick='cancel_appointment()' id='cancel' class='danger btn-sm' type='button' style='border-style: none; margin-left: 10px;'>Cancel</a>
                    <input type='checkbox' name='appointment_ids[]' value=".$appointment['patient_id']." style='margin-left: 20px;'></td>
                    </td>";
                    echo "</tr>";
                }?>
            </tbody>
        </table>
    </div>
</div>
    </div>
    </div>
<?php  include(__DIR__ . '/../_footer.php'); ?>