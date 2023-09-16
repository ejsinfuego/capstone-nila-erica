
<?php 
$title = 'Appointments';
$border = "border-left: 3px solid #2E8B57;";

include(__DIR__ . '/../_header_v2.php');

if($_SESSION['usertype'] == 'p' and $_SESSION['usertype'] == 'd'){
  header('location: ../unauthorized.php');
}


    //get available appointments list from database
    $appointments = $database->query("select consultation.consultation_id,consultation.stat, consultation.date, consultation.type, consultation.time, consultation.created_at, patient.pid, patient.f_name, patient.l_name from consultation left join patient on consultation.patient_id = patient.pid");

?>
  <div class="modal" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Notice</h4>
          <button type="button" id="closeModal" class="closeModal" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            Are you sure you want to delete the appointments?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="deleteAppointment.php" onclick="" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</a>
          <button type="button" class="btn text-white closeModal" id="closeModal" style="background-color: #2E8B57;" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>


<div class="py-3 col d-lg-flex flex-column align-items-lg-center justify-content-xxl-center align-items-xxl-center" style="background: #f1f0f0; margin-left: 24px;border-radius: 10px;padding-top: 9px;padding-left: 15px;padding-right: 18px; border: 2px solid #2E8B57;">
    <h1 style="border-radius: 10px;background: transparent;text-align: center;margin-top: 13px;margin-bottom: 2px;font-weight: bold;text-shadow: 2px 2px #abb2b9;" class="px-xxl-5 mx-xxl-5">Appointment Requests</h1>
    <p>List of Patients' Appointments</p>
    <div class="py-2" style="text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
    <hr style="width: 535px; color: #2E8B57;">
        <table class="table table-bordered table-hover table-sm" id="sortTable">
            <thead>
                <tr>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Patient Name</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Quantity</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Status</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Time</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date Booked</th>
                    <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);"></th>
                </tr>
            </thead>
            <tbody style="border-style: solid;background: rgba(255,255,255,0);">
              <?php foreach($appointments as $appointment): ?>
                <tr style='border-style: solid;background: rgba(255,255,255,0);'>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0); font-weight: bold;'><?php echo $appointment['f_name']." ".$appointment['l_name']; ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo ucfirst($appointment['type']); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo ucfirst($appointment['stat']); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo date('M d, Y', strtotime($appointment['date'])); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo date('h:i A', strtotime($appointment['time'])); ?></td>
                     <td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'><?php echo date('M d, Y', strtotime($appointment['created_at'])); ?></td>
                     <td style="font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);">
                     <?php if($_SESSION['usertype'] == 'do') : ?>
                      <form method="GET" action="">
                        <div class="">
                          <?php if ($appointment['stat'] == 'pending'): ?>
                          <small>
                            <button class="btn btn-primary btn-sm" onclick="approveAppointment(<?php echo $appointment['consultation_id']; ?>)" style="background: transparent;font-family: 'Gill Sans', sans-serif ;color: #1e80c1;border: 1px solid #1e80c1; font-size: 12px;">Approve</button></small>
                            <?php endif; ?>
                            <input id="appointment" name="appointment_id" type="hidden" value="<?php echo $appointment['consultation_id']; ?>">
                            <button id="deleteButton" onclick="deleteAppointment(<?php echo $appointment['consultation_id']; ?>)" class="btn btn-sm danger ms-sm-2" ><svg class="bi bi-trash3-fill" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path></svg>
                            </button>
                        </div>
                      </form>
                    </td>
                    <?php endif ;?>
                  </tr>
               <?php endforeach; ?>
              </tbody>
        </table>
                
            </div>
        </div>
        </div>
<?php include(__DIR__ . '/../_footer.php');