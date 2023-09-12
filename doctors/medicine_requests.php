<?php 
$title = "Medicine Requests";
$border = "border-left: 3px solid #2E8B57;";

include(__DIR__ . '/../_header_v2.php'); ?>
<?php 

    if( $_SESSION['usertype'] != 'd'){
        header('location: ../unauthorized.php');
    }

    //get available medicine list from database
    //an sql command which gets the med name and patient name in using request_medicine table using inner join
    $medicinerow = $database->query("select patient.pname, medicine_inventory.med_name, request_medicine.quantity, request_medicine.status from patient inner join request_medicine on patient.pid = request_medicine.patient_id inner join medicine_inventory on request_medicine.medicine_id = medicine_inventory.medicine_id where request_medicine.status ='pending';
    ");
    $medicinefetch=$medicinerow->fetch_assoc();
?>
            <div class="col" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;">
                <div class="table-responsive" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                <div class="container" style="padding-bottom: 9px;padding-top: 16px;">
                <h1 class="p-2"style="font-family: Montserrat, sans-serif; text-align: center;">Medicine Requests</h1>
                </div>
                    <table class="table table-hover" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Medicine Name</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php 
                        foreach($medicinerow as $medicinefetch) {
                            echo "<tr style='border-style: solid;background: rgba(255,255,255,0);'>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$medicinefetch['pname']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$medicinefetch['quantity']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$medicinefetch['status']."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include(__DIR__ . '/../_footer.php') ?>