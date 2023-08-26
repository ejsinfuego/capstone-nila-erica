
<?php 
$title = 'Appointments';
include(__DIR__ . '/../_header_v2.php');

if($_SESSION['usertype'] != 'd'){
    var_dump($_SESSION['usertype']);
    header('location: ../unauthorized.php');
}
    //get available medicine list from database
    $appointments = $database->query("select * from consultation");

    if($appointments->num_rows>0){
        $appointments = $appointments->fetch_all(MYSQLI_ASSOC);
        $appointments = array_chunk($appointments, 10);
        $appointments = $appointments[0];
    }else{
        $appointments = [];
    }

?>
<div class="col" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;">
    <h1 style="font-family: Montserrat, sans-serif;padding: 17px;padding-top: 20px;margin-left: 145px;margin-right: -3px;padding-left: 20px;padding-right: 20px;border-radius: 10px;background: #f1f0f0;margin-top: 10px;">Appointment Requests</h1>
    <div class="table-responsive" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Time</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);"></th>
                </tr>
            </thead>
            <tbody style="border-style: solid;background: rgba(255,255,255,0);">
              <?php 
                foreach($appointments as $appointment):

                    $patient_name = $database->query("select pname from patient where pid = ".$appointment['patient_id'])->fetch_assoc()['pname'];
                ?>
                <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0); font-weight: bold;'><?php echo $patient_name; ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo ucfirst($appointment['type']); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $appointment['stat']; ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo date('M d, Y', strtotime($appointment['date'])); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo date('h:i A', strtotime($appointment['time'])); ?></td>
                     <td style="font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);"><form method="post" action="deleteAppointment.php"><button class="btn btn-primary" type="submit" name="submit" style="background: transparent;font-family: Montserrat, sans-serif;color: #1e80c1;border: 1px solid #1e80c1;padding-bottom: 0px;padding-right: 12px;padding-top: 0px;margin-bottom: 0px;font-weight: bold; margin-right: 10px;">Approve</button>
                    <input type="hidden" name="approve" value="<?php echo $appointment['consultation_id']; ?>">
                    <input type="checkbox" name="appointment_ids[]" value="<?php echo $appointment['consultation_id']; ?>" >
                    </td>
                     </tr>
            <?php endforeach; ?>
            <?php
                (isset($_POST['approve'])) ? 
                $approve = $datatabase->query("update consultation set stat = 'approved' where patient_id = ".$appointment['consultation_id']."") 
                : null;
            ?>  
            </tbody>
        </table>
            <section class="py-4 py-xl-5" style="font-family: 'Montserrat', sans-serif;">
                <div class="container">
                <label class="my-2">This will delete all the rows that are checked.</label>
                        <div class="my-2"><input value="Delete" name="delete" class="danger ms-sm-2" type="submit"></input></div>
                    </form>
                </div>
                </section>
    </div>
</div>
        </div>
    </div>
<?php include(__DIR__ . '/../_footer.php'); ?>