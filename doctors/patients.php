<?php 
$title = "Health Records";
$border = "border-left: 3px solid #2E8B57;";

include(__DIR__ . '/../_header_v2.php'); 

if($_SESSION['usertype'] == 'p'){
    header('location: ../unauthorized.php');
}
    //get available medicine list from database
    $patients = $database->query("select * from patient");

    if($patients->num_rows>0){
        $patients = $patients->fetch_all(MYSQLI_ASSOC);
    }else{
        $patients = [];
    }

?>
<div class="py-3 col-lg-8 col-xxl-9 d-lg-flex d-xxl-flex flex-column align-items-lg-center justify-content-xxl-center align-items-xxl-center ms-0" style="background: rgba(241,240,240,0.6);font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;height: auto;border: 2px solid #2E8B57;">
    <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Patients</h1>
        <p>List of Patient's Information</p>
        <small>Click the name of patient for more information.</small>
        <hr style="width: 535px;margin-top: 0px;color: #1e80c1;">
    <table class="table table-bordered table-hover" id="sortTable" style="font-size: 15px;">
            <thead>
                <tr>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Sex</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date of Birth</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Address</th>
                </tr>
            </thead>
            <tbody style="border-style: solid;background: rgba(255,255,255,0);">
              <?php 
                foreach($patients as $patient):
                    $address = $patient['ptown'].", ".$patient['pbrgy'].", ".$patient['pstreet'];
                ?>
                <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0); font-weight: bold;'><form method="GET" action="Health_monitor.php"><input type="hidden" name="pid" value="<?php echo $patient['pid']; ?>"><input name="submit" type="submit" style="border: none; background: none;" value="<?php echo $patient['f_name'].' '.$patient['l_name']; ?>"></form></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo ucfirst($patient['psex']); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo date('M-d-Y', strtotime($patient['pdob'])); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $address; ?></td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
    </table>
</div>

<?php include(__DIR__ . '/../_footer.php'); ?>