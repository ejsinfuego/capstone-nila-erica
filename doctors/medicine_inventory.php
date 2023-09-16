
<?php 

    $title = 'Medicine Inventory';
    include(__DIR__ . '/../_header_v2.php');

    if( $_SESSION['usertype'] == 'p'){
        header('location: ../unauthorized.php');
    }

    //get available medicine list from database
    $medicinerow = $database->query("select * from medicine_inventory where med_qty >0");
    $medicinefetch=$medicinerow->fetch_assoc();
    
?>
            <div class="py-3 col d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0; margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px; border: 2px solid #2E8B57;">
                <h1 style="border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Medicine Inventory</h1>
                <p>List of Available Medicines</p>
                <div class="py-2" style="text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table table-sm" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Medicine Name</th>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                                <th style="border-style: solid;font-family: Calibri, sans-serif;background: rgba(255,255,255,0);"></th>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php $med = 0; foreach ($medicinerow as $medicinefetch) : $med = +1 ?>
                            <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                            <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['med_name']; ?></td>
                            <td style='font-family: Calibri, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['med_qty'] ?></td>
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
<?php include(__DIR__ . '/../_footer.php') ?>