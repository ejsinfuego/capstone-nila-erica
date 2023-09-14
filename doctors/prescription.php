<?php 
$title= 'Prescriptions';
$border = "border-left: 3px solid #2E8B57;";
include(__DIR__ . '/../_header_v2.php');

$prescriptions = $database->query('select patient.f_name, patient.l_name, prescription.prescription_id, prescription.note, prescription.status, prescription.diagnosis, prescription.patient_id, prescription.status, prescription.created_at from prescription inner join patient on prescription.patient_id = patient.pid')
?>
<div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px;padding-left: 15px;padding-right: 18px; border: 2px solid #2E8B57;">
    <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="mx-xxl-5">Prescriptions</h1>
    <p>List of Patients' Prescriptions</p>
    <div class="py-2" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
    <hr style="width: 535px; color: #2E8B57;">
        <table class="table table-bordered table-hover sortTable" id="sortTable">
            <thead>
                <tr>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Diagnosis</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Note</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date Prescribed</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);"></th>
                </tr>
            </thead>
            <tbody style="border-style: solid;background: rgba(255,255,255,0);">
              <?php foreach($prescriptions as $prescription): ?>
                <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0); font-weight: bold;'><?php echo $prescription['f_name']." ".$prescription['l_name']; ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo ucfirst($prescription['diagnosis']); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo ucfirst($prescription['note']); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo date('M d, Y', strtotime($prescription['created_at'])); ?></td>
                     <td style="font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);">
                      <form method="GET" action="">
                        <div class="">
                          <?php if ($prescription['status'] == 'pending'): ?>
                          <small>
                            <button class="btn btn-primary" onclick="approveAppointment(<?php echo $appointment['consultation_id']; ?>)" style="background: transparent;font-family: Montserrat, sans-serif;color: #1e80c1;border: 1px solid #1e80c1;">Approve</button></small>
                            <?php endif; ?>
                            <input id="appointment" name="appointment_id" type="hidden" value="<?php echo $appointment['consultation_id']; ?>">
                            <button id="deleteButton" onclick="deleteAppointment(<?php echo $appointment['consultation_id']; ?>)" class="btn btn-sm danger ms-sm-2" ><svg class="bi bi-trash3-fill" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" viewBox="0 0 16 16">
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
<?php include(__DIR__ . '/../_footer.php'); ?>