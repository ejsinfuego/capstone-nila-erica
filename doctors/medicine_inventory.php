
<?php 

    $title = 'Medicine Inventory';

    if(!strpos($_SERVER['REQUEST_URI'], 'medicine_inventory.php')){
    
    }else{
        session_start();
        if( $_SESSION['usertype'] == 'p' or $_SESSION['usertype'] == ''){
        header('location: ../login_v2.php');
        }
        session_abort();
        include(__DIR__ . '/../_header_v2.php');
    }

    

    //get available medicine list from database
    $medicinerow = $database->query("select * from medicine_inventory inner join pharmacist where med_qty > 0");
    $medicinefetch=$medicinerow->fetch_assoc();
?>
            <div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center
            <?php if(strpos($_SERVER['REQUEST_URI'], 'medicine_inventory.php')){
                echo "mx-5";
            }?>"  style="background: #f1f0f0;font-family: Montserrat, sans-serif;border-radius: 10px; border: 2px solid #2E8B57;">
                <h1 style="border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Medicine Inventory</h1>
                <p>List of Available Medicines</p>
                <div class="py-2" style="text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table table-sm sortTable" id="">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Medicine Name</th>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Stocks <i><small>(capsules)</small></i></th>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Amount per Capsule <i><small>(/ml)</small></i></th>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Measure Unit<i><small>(mg, ml, mL, etc.)</small></i></th>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Acquired by</th>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Recent Acquisition</th>
                              
                              
                                <?php if($_SESSION['usertype'] == 'ph'): ?>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php $med = 0; foreach ($medicinerow as $medicinefetch) : $med = +1 ?>
                            <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                            <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['med_name']; ?></td>
                            <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['med_qty'] ?></td>

                            <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?= $medicinefetch['med_dosage'] ?></td>
                            <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?= $medicinefetch['med_unit'] ?></td>
                            <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?= $medicinefetch['f_name'].' '.$medicinefetch['l_name'] ; ?></td>
                            <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php
                            if($medicinefetch['recent_acquired'] == null){
                                echo date('M d, y',strtotime($medicinefetch['created_at']));
                            }else{
                                echo date('M d, Y', strtotime($medicinefetch['recent_acquired']));
                            }
                        
                            ?></td>

                            <?php if($_SESSION['usertype'] == 'ph'): ?>
                                <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <input class="btn" placeholder="Add Medicine" value="<?php echo $medicinefetch['medicine_id']; ?>" type="hidden" name="med_id" id="med_id">
                                <button data-id="<?php echo $medicinefetch['medicine_id']; ?>" class="btn btn-primary btn-sm addMed" style="background-color: #2E8B57;" type="button">Add</button> 
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    <div class="modal" id="addMedicine">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Notice</h4>
          <button type="button" class="closeModal"  data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST" action="addMedicine.php" class="form">
                <label class="form-label "id="med_name" for="addMed"></label>
                <input type="hidden" id="inputMedId" name="med_id">
                <input class="form-control" name="addMed" type="number">
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
        <button class="btn btn-primary btn-sm" style="background-color: #2E8B57;" type="submit">Add</button>
        </form>
          <button type="button" class="closeModal btn-sm" style="color: #2E8B57; background-color: none; border: none; font-weight:bolder;" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
    <script>
        $(document).ready(function(){
            $('.addMed').click(function(){
                var med_id = $(this).data('id');
                var med_name = $(this).parent().siblings().first().text();
                $('#inputMedId').val(med_id);
                $('#med_name').text(med_name);
                $('#addMedicine').modal('show');
            });
        });
    </script>

<?php
if(!strpos($_SERVER['REQUEST_URI'], 'medicine_inventory.php')){
    }else{
        include(__DIR__ . '/../_footer.php');   
    }
?>