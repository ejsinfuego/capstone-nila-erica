
<?php 
$title = 'Appointments';
include(__DIR__ . '/../_header_v2.php');

if($_SESSION['usertype'] != 'd'){
    var_dump($_SESSION['usertype']);
    header('location: ../unauthorized.php');
}
    //get available medicine list from database
    $appointments = $database->query("select * from consultation");
    $appointments_booked=$appointments->fetch_assoc();
    
?>
<div class="col" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;">
    <h1 style="font-family: Montserrat, sans-serif;padding: 17px;padding-top: 20px;margin-left: 239px;margin-right: -3px;padding-left: 20px;padding-right: 20px;border-radius: 10px;background: #f1f0f0;margin-top: 10px;">Appointment Requests</h1>
    <div class="table-responsive" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
        <table class="table">
            <thead>
                <tr>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Medicine Name</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Time</th>
                </tr>
            </thead>
            <tbody style="border-style: solid;background: rgba(255,255,255,0);">
              <?php 
                foreach($appointments as $appointment){

                    $patient_name = $database->query("select pname from patient where pid = ".$appointment['patient_id'])->fetch_assoc()['pname'];
                
                    echo "<tr style='border-style: solid;background: rgba(255,255,255,0);'>";
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$patient_name."</td>";
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$appointment['type']."</td>";
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$appointment['stat']."</td>";
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$appointment['date']."</td>";
                    echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$appointment['time']."</td>";
                    echo "</tr>";
                }
?>
            </tbody>
        </table>
    </div>
</div>
        </div>
    </div>
<?php include(__DIR__ . '/../_footer.php'); ?>