<?php 
$title = "Medicine Requests";
$border = "border-left: 3px solid #2E8B57;";

include(__DIR__ . '/../_header_v2.php');

    if( $_SESSION['usertype'] == 'p'){
        header('location: ../unauthorized.php');
    }

    //get available medicine list from database
    //an sql command which gets the med name and patient name in using request_medicine table using inner join
    $medicinerow = $database->query("select patient.f_name, patient.l_name, medicine_inventory.med_name, request_medicine.request_medicine_id, request_medicine.quantity, request_medicine.status from patient inner join request_medicine on patient.pid = request_medicine.patient_id inner join medicine_inventory on request_medicine.medicine_id = medicine_inventory.medicine_id;
    ");
?>
<div class="col-lg-8 col-xxl-9 d-lg-flex d-xxl-flex flex-column align-items-lg-center align-items-xxl-center ms-0" style="background: #f1f0f0; border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;height: auto;border: 1px solid #2E8B57;">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Medicine Requests</h1>
                <p>Patient's health information</p>
                <hr style="width: 535px;color: #2E8B57;">
                <div class="py-2" style="text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table style="border-radius: 6px;" class="table table-sm table-hover table-responsive" id="sortTable">
                        <thead>
                            <tr>
                                <th class="p-2" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                                <th class="p-2" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Medicine Name</th>
                                <th class="p-2" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                                <th class="p-2" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                                <th class="p-2" style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);"></th>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php foreach($medicinerow as $medicinefetch) : ?>
                            <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['f_name']." ".$medicinefetch['l_name']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['med_name']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['quantity']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo $medicinefetch['status']; ?></td>
                                <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                                <?php if($_SESSION['usertype'] == 'ph') :?><form method="GET" action="">
                                        <div class="">
                                            <?php if ($medicinefetch['status'] == 'pending' and $medicinefetch['status'] != 'approved') : ?>
                                            <small>
                                            <button class="btn btn-primary btn-sm" onclick="approveMedicineRequest(<?php echo $medicinefetch['request_medicine_id']; ?>)" style="background: transparent;font-family: Courier, monospace, sans-serif;color: #1e80c1;border: 1px solid #1e80c1;">Approve</button></small>
                                            <?php elseif ($medicinefetch['status'] == 'approved' and $medicinefetch['status'] != 'pending') : ?>
                                            <small><button onclick="claimMedicine(<?php echo $medicinefetch['request_medicine_id']; ?>)" class="btn btn-success btn-sm" style="background: transparent;font-family: Courier, monospace, sans-serif;color: #1e80c1;border: 1px solid #1e80c1;">Claimed</button></small>
                                            <?php else : ?>
                                            <input id="request_medicine" name="request_medicine_id" type="hidden" value="<?php echo $medicinefetch['request_medicine_id']; ?>">
                                            
                                        <?php endif; ?>
                                        <button id="deleteButton" onclick="deleteMedicineRequest(<?php echo $medicinefetch['request_medicine_id']; ?>)" class="btn btn-sm danger ms-sm-2"><svg class="bi bi-trash3-fill" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path></svg>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            <?php endif; ?>
                            </tr>  
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
<script>

function approveMedicineRequest(request_medicine_id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            location.reload();
        }
    };
    xhttp.open("GET", "approveMedicineRequest.php?request_medicine_id="+request_medicine_id, true);
    xhttp.send();
};

function claimMedicine(request_medicine_id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            location.reload();
        }
    };
    xhttp.open("GET", "claimMedicine.php?request_medicine_id="+request_medicine_id, true);
    xhttp.send();
};
</script>
<?php include(__DIR__ . '/../_footer.php') ?>
