<?php 
$title = "Medicine Requests";
$border = "border-left: 3px solid #2E8B57;";

include(__DIR__ . '/../_header_v2.php');

    if( $_SESSION['usertype'] != 'd'){
        header('location: ../unauthorized.php');
    }

    //get available medicine list from database
    //an sql command which gets the med name and patient name in using request_medicine table using inner join
    $medicinerow = $database->query("select patient.f_name, patient.l_name, medicine_inventory.med_name, request_medicine.request_medicine_id, request_medicine.quantity, request_medicine.status from patient inner join request_medicine on patient.pid = request_medicine.patient_id inner join medicine_inventory on request_medicine.medicine_id = medicine_inventory.medicine_id;
    ");
?>

            <div class="col" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;">
                <div class="table-responsive" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                <div class="container" style="padding-bottom: 9px;padding-top: 16px;">
                <h1 class="p-2"style="font-family: Montserrat, sans-serif; text-align: center;">Medicine Requests</h1>
                </div>
                    <table class="table table-hover" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Medicine Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);"></th>
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
                                    <form method="GET" action="">
                                        <div class="">
                                            <?php if ($medicinefetch['status'] == 'pending'): ?>
                                            <small>
                                            <button class="btn btn-primary" onclick="approveMedicineRequest(<?php echo $medicinefetch['request_medicine_id']; ?>)" style="background: transparent;font-family: Montserrat, sans-serif;color: #1e80c1;border: 1px solid #1e80c1;">Approve</button></small>
                                            <?php endif; ?>
                                            <input id="request_medicine" name="request_medicine_id" type="hidden" value="<?php echo $medicinefetch['request_medicine_id']; ?>">
                                            <button id="deleteButton" onclick="deleteMedicineRequest(<?php echo $medicinefetch['request_medicine_id']; ?>)" class="btn btn-sm danger ms-sm-2" ><svg class="bi bi-trash3-fill" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path></svg>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>  
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include(__DIR__ . '/../_footer.php') ?>