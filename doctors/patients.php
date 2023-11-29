<?php 
$title = "Health Records";
$border = "border-left: 3px solid #2E8B57;";


if(!strpos($_SERVER['REQUEST_URI'], 'patients.php')){
    
}else{
    session_start();
    if($_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == ''){
        header('Location: ../login_v2.php');
    }
    session_abort();
    include(__DIR__ . '/../_header_v2.php');
}


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
<div class="col d-lg-flex flex-column align-items-lg-center <?php if(!strpos($_SERVER['REQUEST_URI'], 'patients.php')){
    echo "ms-auto";
}else{
    echo "ms-5";

}?>" style="background: #f1f0f0;font-family: Montserrat, sans-serif;border-radius: 10px; border: 2px solid #2E8B57;">
    <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Patients</h1>
        <p>List of Patient's Information</p>
        <small>Click the name of patient for more information.</small>
        <hr style="width: 535px;margin-top: 0px;color: #1e80c1;">
    <div class="py-2 w-100" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
    <table class="table table-sm patient sortTable" id="sortTable" style="font-size: 15px;">
            <thead>
                <tr>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Sex</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date of Birth</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Address</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Age</th>
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
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo  date_diff(date_create($patient['pdob']), date_create('now'))->y; ?></td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
     //reintialize table
     
</script>
<?php 
if(!strpos($_SERVER['REQUEST_URI'], 'add_prescription.php')){
    
}else{
  include(__DIR__ . '/../_footer.php');
}

 ?>