<?php 
$title = "Request Medicine";
// include(__DIR__ . '/../_header_v2.php'); 
if(strpos($_SERVER['REQUEST_URI'], 'request_medicine.php')){
    session_start();
    if( $_SESSION['usertype'] == 'd' or $_SESSION['usertype'] == ''){
    header('location: ../login_v2.php');
    }
    session_abort();
    include(__DIR__ . '/../_header_v2.php');
}else{ 
    
}
?>

            <div class="col" style="padding-left: 38px;padding-right: 88px;padding-top: 27px;background: #f1f0f0;border-radius: 10px;font-family: Montserrat, sans-serif;">
                <?php
                    //get available medicine list from database
                    $medicinerow = $database->query("select * from medicine_inventory where med_qty >0");
                    $medicinefetch=$medicinerow->fetch_assoc();
                    if($medicinerow->num_rows > 0){
                    $medicineid= $medicinefetch["medicine_id"];
                    $medicinename=$medicinefetch["med_name"];
                    }
                    $prescriptions = $database->query('select * from prescription where patient_id = '.$userid);

                ?>
                <form method="POST" action="submit_requests_medicine.php" class="text-start" >
                        <h2 class="text-center justify-content-around" style="text-shadow: 0px 0px;padding-bottom: 0;">Request Medicine</h2>
                        <h6 class="text-center">Fill out this form with necessary information request medicine.</h6><label class="form-label">Available Medicine</label>
                        <input type="hidden" name="patient_id" value="<?php echo $userid; ?>">
                        <select class="form-select" name="medicine_id">
                        <?php
                                if($medicinerow->num_rows==0){
                                    echo "<option value=''>No Medicine Available</option>";
                                }else{
                                    foreach($medicinerow as $medicinefetch){
                                    echo "<option value=".$medicinefetch['medicine_id'].">".$medicinefetch['med_name']."</option>";
                                }
                            }?>
                        </select>
                    <label class="form-label" for="quantity">Quantity</label>
                    <input class="form-control" type="number" name="quantity">
                    <label class="form-label" for="note">Note</label>
                    <textarea class="form-control" name="note"></textarea>
                    <label class="form-label">Prescription ID</label>
                    <select class="form-control" name="prescription_id">
                        <option class="form-control" value="">No Prescription</option>
                        <?php foreach($prescriptions as $prescription): ?>
                        <option value="<?php echo $prescription['prescription_id']; ?>"><?php echo $prescription['prescription_id']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="py-1">
                    <a href="prescription.php">
                        Check lists of your prescription.
                    </a>
                    </div>
                    <input type="submit" name="submit" value="submit" class="btn btn-md btn-primary py-md-0 my-md-0 my-sm-0 py-sm-5 my-lg-4 px-lg-3 py-lg-0" style="margin-top: 18px;margin-bottom: 18px;background: #2E8B57;padding-top: 0px;padding-bottom: 0px;height: 35px;">
                </form>
                <div>
                    <strong style="font-family: Montserrat, sans-serif;">Note: Please wait for the confirmation of the doctor.</strong>
                </div>
            </div>
        </div>
    </div>
  
<?php if(strpos($_SERVER['REQUEST_URI'], 'request_medicine.php')){
    include(__DIR__ .'/../_footer.php');
}else{} ;?> 