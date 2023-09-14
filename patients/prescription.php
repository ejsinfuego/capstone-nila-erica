<?php 
$title= 'Prescriptions';
$border = "border-left: 3px solid #2E8B57;";

include(__DIR__ . '/../_header_v2.php');

if( $_SESSION['usertype'] != 'p'){
    header('location: ../unauthorized.php');
}
$prescriptions = $database->query("select * from prescription where patient_id = ".$userid);
?>
<div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px; border: 2px solid #2E8B57;">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Prescriptions</h1>
                <p>List your Prescriptions</p>
                <div class="py-2" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Prescription ID</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Note</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Diagnosis</th>
                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php
                        if(mysqli_fetch_column($prescriptions) == 0){
                            echo "</p>No prescriptions found.</p>";
                        }else{
                        foreach($prescriptions as $prescription){
                            echo "<tr style='border-style: solid;background: rgba(255,255,255,0);'>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['prescription_id']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['note']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['diagnosis']."</td>";
                            echo "</tr>";
                        }
                    }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include(__DIR__ . '/../_footer.php'); ?>