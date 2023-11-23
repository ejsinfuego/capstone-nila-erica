<?php 
$title = "Request Medicine";
if(!strpos($_SERVER['REQUEST_URI'], 'newMedTab.php')){
    
}else{
    include(__DIR__ . '/../_header_v2.php');
}

?>

            <div class="col" style="padding-left: 38px;padding-right: 88px;padding-top: 27px;background: #f1f0f0;border-radius: 10px;font-family: Montserrat, sans-serif;">
                <form method="POST" action="newMedicine.php" class="text-start" >
                    <h2 class="text-center justify-content-around" style="text-shadow: 0px 0px;padding-bottom: 0;">Add New Medicine</h2>
                        <h6 class="text-center">Fill out this form with necessary information request medicine.</h6>   
                    <input type="hidden" name="acquire_by" value="<?php echo $userid; ?>">
                    <label class="form-label" for="quantity">Medicine Name</label>
                    <input class="form-control" type="text" name="med_name" placeholder="Mefenamic, Paracetamol, etc">
                    <label class="form-label" for="quantity">Quantity<i><small>(per Capsule)</small></i></label>
                    <input class="form-control" type="number" name="med_qty">
                    <label class="form-label" for="med_unit">Medicine Dosage<i><small>(please enter only the number)</small></i></label>
                    <input class="form-control" type="number" name="med_dosage" placeholder="250, 500, etc">
                    <label class="form-label" for="med_unit">Medicine Unit<i><small>(please enter only the measure unit (example: mg, ml,))</small></i></label>
                    <input class="form-control" type="text" name="med_unit" placeholder="example: ml or mg or ml">
                    
                    <label class="form-label" for="note">Description</label>
                    <textarea class="form-control" name="med_desc" placeholder="Painkiller, for Colds, Antibiotic"></textarea>
                    <input type="submit" name="submit" value="submit" class="btn btn-md btn-primary py-md-0 my-md-0 my-sm-0 py-sm-5 my-lg-4 px-lg-3 py-lg-0" style="margin-top: 18px;margin-bottom: 18px;background: #2E8B57;padding-top: 0px;padding-bottom: 0px;height: 35px;">
                </form>
                <!-- <div>
                    <strong style="font-family: Montserrat, sans-serif;">Note: Please wait for the confirmation of the doctor.</strong>
                </div> -->
            </div>
        </div>
    </div>
  
<?php 
    if(!strpos($_SERVER['REQUEST_URI'], 'newMedTab.php')){
    
    }else{
        include(__DIR__ .'/../_footer.php');
    }
 ?>

