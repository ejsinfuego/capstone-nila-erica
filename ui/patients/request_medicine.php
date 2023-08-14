<?php include '../header_v2.php'; ?>

            <div class="col" style="padding-left: 38px;padding-right: 88px;padding-top: 27px;background: #f1f0f0;margin-left: 22px;border-radius: 10px;font-family: Montserrat, sans-serif;">
                <?php
                            
                    //get available medicine list from database
                    $medicinerow = $database->query("select * from medicine_inventory where med_qty >0");
                    $medicinefetch=$medicinerow->fetch_assoc();
                    $medicineid= $medicinefetch["medicine_id"];
                    $medicinename=$medicinefetch["med_name"];

                ?>
                <form method="POST" action="submit_requests_medicine.php" class="text-start" >
                        <h2 class="text-center justify-content-around" style="text-shadow: 0px 0px;padding-bottom: 0;">Request Medicine</h2>
                        <h6 class="text-center">Fill out this form with necessary information request medicine.</h6><label class="form-label">Available Medicine</label>
                        <input type="hidden" name="patient_id" value="<?php echo $userid; ?>">
                        <select class="form-select" name="medicine_id">
                        <?php
                                foreach($medicinerow as $medicinefetch){
                                    echo "<option value=".$medicinefetch['medicine_id'].">".$medicinefetch['med_name']."</option>";
                                }?>
                        </select>
                    <label class="form-label" for="quantity">Quantity</label>
                    <input class="form-control" type="number" name="quantity">
                    <label class="form-label" for="note">Note</label>
                    <textarea class="form-control" name="note"></textarea>
                    <label class="form-label">Prescription ID</label>
                    <input class="form-control" type="text"  name="prescription_id">
                    <input type="submit" name="submit" value="submit" class="btn btn-lg btn-primary py-md-0 my-md-0 my-sm-0 py-sm-5 my-lg-4 px-lg-3 py-lg-0" style="margin-top: 18px;margin-bottom: 18px;background: #3d52d5;padding-top: 0px;padding-bottom: 0px;height: 49px;">
                </form>
            </div>
        </div>
    </div>
  
<?php include '../footer.php' ?>