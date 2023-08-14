<?php 
$title= 'Prescription';
include(__DIR__ . '/../_header_v2.php');

if( $_SESSION['usertype'] != 'p'){
    header('location: ../unauthorized.php');
}
$prescriptions = $database->query("select * from prescription where patient_id = ".$userid);
?>
            <div class="col" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px;">
                <div class="table-responsive" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                <div class="container" style="padding-bottom: 9px;padding-top: 16px;">
                <h1 style="font-family: Montserrat, sans-serif;padding: 17px;padding-top: 20px;margin-left: 239px;margin-right: -3px;padding-left: 20px;padding-right: 20px;border-radius: 10px;background: #f1f0f0;margin-top: 10px;">Prescriptions</h1>
                </div>
                    <table class="table">
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