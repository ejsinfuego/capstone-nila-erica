<?php 
$title = $title ??'RHUConnect';
session_start();
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo htmlspecialchars($title, ENT_QUOTES); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</head>
<style>
    .links:hover{
    background-color: rgba(46,139,87,0.47) !important;
    color: #fff!important;
    box-shadow: none!important;
    }
   
</style>
<script>
    // //fix delete appointment (deadline friday)
    function deleteAppointment(appointment_id){
        if(confirm("Sure to delete?") == true){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                   window.location.reload();
                }
            };
            xhttp.open("GET", "deleteAppointment.php?appointment_id="+appointment_id, true);
            xhttp.send();
        }
       
    };
        
    function deleteMedicineRequest(request_medicine_id){
        if(confirm("Sure to delete?") == true){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xhttp.open("GET", "deleteMedicineRequest.php?request_medicine_id="+request_medicine_id, true);
            xhttp.send();
        }

        };
        
    function approveAppointment(appointment_id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
            xhttp.open("GET", "approveAppointment.php?appointment_id="+appointment_id, true);
            xhttp.send();
    };
    function deletePrescription(prescription_id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
            xhttp.open("GET", "deletePrescription.php?prescription_id="+prescription_id, true);
            xhttp.send();
    };
    
  $(document).ready(function() {
    $('#sortTable').DataTable({
       destroy: true,
       responsive: true,
       select: true,
    });
      // Show the modal on button click
    $('.deleteButton').click(function() {
        $('#deleteModal').modal('show');

    });

    $('.closeModal').click(function(){
        $('.modal').modal('hide');
    });

    $('#myModal').modal('show');
    // Automatically close the modal after 2 seconds
    setTimeout(function() {
      $('#myModal').modal('hide');
    }, 2000);

        
  });
</script>
<?php

    if(isset($_SESSION["user"])){
        //check if the user is logged in and if the user is a patient or doctor
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p' and $_SESSION['usertype']!='d' and $_SESSION['usertype']!='a' and $_SESSION['usertype']!='ph' and $_SESSION['usertype']!='do'){
            header("location: ../login_v2.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login_v2.php");
    }

    if($_SESSION['usertype']=='p'){
        include("connection.php");
        $userrow = $database->query("select * from patient where pemail='$useremail'");
        $userfetch=$userrow->fetch_assoc();
        $userid= $userfetch["pid"];
        $username=$userfetch["f_name"];
        $med_link = "../patients/request_medicine.php";
        $med_link_sidebar = "../patients/medicine_requests.php";
        $appointment_link = "../patients/book_appointment.php";
        $appointment_link_sidebar = "../patients/appointments.php";
        $index = "../patients/index.php";
        $health_records = "Health_monitor.php";

    }else{
        //import database
        include("connection.php");
        if($_SESSION['usertype']=='d'){
            $userrow = $database->query("select * from doctor where docemail='$useremail'");
            $userfetch=$userrow->fetch_assoc();
            $userid= $userfetch["docid"];
            $username=$userfetch["docname"];
        }elseif($_SESSION['usertype']=='do'){
            $userrow = $database->query("select * from desk_officer where email='$useremail'");
            $userfetch=$userrow->fetch_assoc();
            $userid= $userfetch["id"];
            $username=$userfetch["f_name"].' '.$userfetch['l_name'];
        }elseif($_SESSION['usertype'] == 'ph'){
            $userrow = $database->query("select * from pharmacist where email='$useremail'");
            $userfetch=$userrow->fetch_assoc();
            $userid= $userfetch["id"];
            $username=$userfetch["f_name"].' '.$userfetch['l_name'];
        }
        $med_link = "../doctors/medicine_inventory.php";
        $appointment_link = "../doctors/appointments.php";
        $med_link_sidebar = "../doctors/medicine_requests.php";
        $appointment_link_sidebar = "../doctors/appointments.php";
        $index = "../doctors/index.php";
        $health_records = "patients.php";
    }
    //set links for sidebar depends on the user type;
    if($_SESSION['usertype']=='ph'){
        $first_side_link = "medicine_inventory.php";
        $second_side_link = "add_prescription.php";
    }elseif($_SESSION['usertype']=='p'){
        $first_side_link = "request_medicine.php";
        $second_side_link = "book_appointment.php";
    }elseif($_SESSION['usertype'] == 'do'){
        $first_side_link = "appointments.php";
    }elseif($_SESSION['usertype']=='d'){
        $first_side_link = "medicine_inventory.php";
        $second_side_link = "add_prescription.php";
    }
     if(isset($_SESSION['message']) && $_SESSION['message'] !='' && isset($_SESSION['show_modal']) && $_SESSION['show_modal'] !=''){
        $myModal = $_SESSION['show_modal'];
        unset($_SESSION['show_modal']);
        
    }

    $check_patients = "";
    ?>
<body style="font-family: Montserrat, sans-serif;background: url(&quot;../assets/img/bg.jpg.png&quot;), #fbfff1;">
    <nav class="navbar navbar-expand-md shadow py-3" data-bs-theme="light" style="--bs-body-color: #212529;--bs-primary: #090c9b;--bs-primary-rgb: 9,12,155;background: linear-gradient(69deg, #2E8B57 56%, white 100%), var(--bs-primary);color: #fbfff1;border-color: #3c3744;border-bottom: 4.4px none #3c3744;font-family: Montserrat, sans-serif;">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="<?php echo $index; ?>"> <img style="width: 55px;" class="img-fluid" src="../assets/img/rhulogo.png"><span style="font-family: Montserrat, sans-serif;font-size: 25px;color: #fbfff1;font-weight: bold;">RHUConnect</span></a><button data-bs-toggle="collapse" class="navbar-toggler text-center" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="color: #fbfff1;font-family: Montserrat, sans-serif;">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" data-bss-hover-animate="jello" href="<?php echo $appointment_link; ?>" style="font-family: Montserrat, sans-serif;color: #fbfff1;">Appointment</a></li>
                    <li class="nav-item"><a class="nav-link" data-bss-hover-animate="jello" href="<?php echo $med_link; ?>" style="font-family: Montserrat, sans-serif;color: #fbfff1;">Medicine</a></li>

                    <li class="nav-item"><a class="nav-link" data-bss-hover-animate="wobble" href="#" style="font-family: Montserrat, sans-serif;color: rgb(251,255,241);">Health Records</a></li>
                </ul>
                <div class="justify-content-center me-3">
                    <strong><?php echo $username; ?></strong>
                </div>
                <a href="../logout.php" class="btn btn-primary" data-bss-hover-animate="bounce" type="button" style="font-family: Montserrat, sans-serif;color: #fbfff1;border-style: none; background-color: #2E8B57;">Logout</a>
            </div>
            <aside></aside>
        </div>
    </nav>
    
  <!-- The Modal -->
  <div class="modal" id="<?php echo $myModal; ?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Notice</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <?php echo $_SESSION['message']; unset($_SESSION['message'])?>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="closeModal btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    <?php if($title == "Index") : ?>
        <div class="container" style="margin-top: 45px;"></div>
        <?php if($_SESSION['usertype'] == 'd') { 
             $check_patients = '<a class="nav-link text-center d-flex d-lg-flex d-xxl-flex justify-content-center align-items-center flex-nowrap order-first align-items-lg-center align-items-xxl-center nav-sidebar" href="#" style="font-size: 0.7rem;border-style: none; padding: 7px 5px 7px 10px; border-radius: 1px;">
             <div class="d-lg-flex justify-content-center align-items-center align-content-center align-self-center flex-nowrap justify-content-lg-center align-items-lg-center" style="color:#2E8B57;padding: 0px;">
                 <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="d-lg-flex align-self-start order-first justify-content-lg-center align-items-lg-center" style="font-size: 46px;padding: 9px;padding-right: 0px;padding-left: 0px;width: 46px;margin-left: -3px;background: var(--bs-primary-bg-subtle);border-radius: 38px;">
                         <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                         <path d="M368 344h96c13.25 0 24-10.75 24-24s-10.75-24-24-24h-96c-13.25 0-24 10.75-24 24S354.8 344 368 344zM208 320c35.35 0 64-28.65 64-64c0-35.35-28.65-64-64-64s-64 28.65-64 64C144 291.3 172.7 320 208 320zM512 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V96C576 60.65 547.3 32 512 32zM528 416c0 8.822-7.178 16-16 16h-192c0-44.18-35.82-80-80-80h-64C131.8 352 96 387.8 96 432H64c-8.822 0-16-7.178-16-16V160h480V416zM368 264h96c13.25 0 24-10.75 24-24s-10.75-24-24-24h-96c-13.25 0-24 10.75-24 24S354.8 264 368 264z"></path>
                     </svg></div>
                 <div class="d-lg-flex justify-content-lg-center align-items-lg-center" style="width: 7px;"></div>
                 <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-start align-items-lg-center" style="padding-bottom: 0px;height: 35.6px;padding-top: 16px;width: 116.8px;">
                     <p class="d-lg-flex flex-column justify-content-lg-center align-items-lg-center"><strong>Patients</strong></p>
                 </div>
             </div>
         </a>' ;
        }?><?php else : ?> 
        <div class="container text-start" style="padding-bottom: 9px;padding-top: 16px;"></div>
        <div class="container">
            <div class="row gx-2">
                <div class="col-md-8 col-lg-1 col-xl-3 col-xxl-2 offset-xl-0 d-sm-flex d-lg-flex flex-column flex-nowrap align-items-sm-center justify-content-lg-start justify-content-xl-start" id="sidebar" style="background: transparent;border-radius: 23px;width: auto;height: auto;">
                    <ul class="nav nav-tabs d-flex d-lg-flex justify-content-center justify-content-lg-center align-items-lg-start" style="border-radius: 10px;background: #f1f0f0;height: auto;width: auto;">
                        <li class="nav-item d-lg-flex flex-column justify-content-lg-center align-items-lg-center" style="width: auto;height: auto;padding: 20px;border-radius: 10px;border: 1px solid #2E8B57;">
                        <a style="font-size: 0.7rem; padding: 7px 5px 7px 10px; <?php echo($title == 'Medicine Requests') ? $border : ''; ?>" class=" nav-link nav-sidebar text-center d-flex d-lg-flex d-xxl-flex justify-content-center align-items-center flex-nowrap order-first align-items-lg-center links align-items-xxl-center" href="<?php echo $med_link_sidebar; ?>">
                                <div class="d-lg-flex justify-content-center align-items-center align-content-center align-self-center flex-nowrap justify-content-lg-center align-items-lg-center :hover" style="color:#2E8B57;">
                                    <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-clipboard-pulse d-lg-flex align-self-start order-first justify-content-lg-center align-items-lg-center" style="font-size: 46px;padding: 9px;padding-right: 0px;padding-left: 0px;width: 46px;margin-left: -3px;background: var(--bs-primary-bg-subtle);border-radius: 38px;">
                                            <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Zm6.979 3.856a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.895-.133L4.232 10H3.5a.5.5 0 0 0 0 1h1a.5.5 0 0 0 .416-.223l1.41-2.115 1.195 3.982a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h1.5a.5.5 0 0 0 0-1h-1.128L9.979 5.356Z"></path>
                                        </svg></div>
                                    <div class="d-lg-flex justify-content-lg-center align-items-lg-center" style="width: 7px;"></div>
                                    <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-start align-items-lg-center" style="padding-bottom: 0px;height: 35.6px;padding-top: 16px;width: 116.8px;">
                                        <p class="d-lg-flex flex-column justify-content-lg-center align-items-lg-center"><strong>Medicine Requests</strong></p>
                                    </div>
                                </div>
                            </a>
                            <?php echo $check_patients; ?>
                            </a>
                            <a style="<?php echo($title == 'Appointments') ? $border : ''; ?> font-size: 0.7rem; padding: 7px 5px 7px 10px; border-radius: 3px;" class="nav-link text-center d-flex d-lg-flex d-xxl-flex justify-content-center align-items-center flex-nowrap order-first align-items-lg-center align-items-xxl-center hover nav-sidebar links" href="<?php echo $appointment_link_sidebar; ?>">
                                <div id="sidebar" class="d-lg-flex justify-content-center align-items-center align-content-center align-self-center flex-nowrap justify-content-lg-center align-items-lg-center" style="color:#2E8B57;">
                                    <div class=" d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-calendar-plus d-lg-flex align-self-start order-first justify-content-lg-center align-items-lg-center" style="font-size: 46px;padding: 11px;padding-right: 0px;padding-left: 0px;width: 46px;margin-left: -3px;background: var(--bs-primary-bg-subtle);border-radius: 38px;">
                                            <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"></path>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path>
                                        </svg></div>
                                    <div class="d-lg-flex justify-content-lg-center align-items-lg-center" style="width: 7px;"></div>
                                    <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-start align-items-lg-center" style="padding-bottom: 0px;height: 35.6px;padding-top: 16px;width: 116.8px;">
                                        <p class="d-lg-flex flex-column justify-content-lg-center align-items-lg-center"><strong>Appointments</strong></p>
                                    </div>
                                </div>
                            </a>
                            <a style="font-size: 0.7rem;border-style: none; padding: 7px 5px 7px 10px; border-radius: 1px; <?php echo($title == 'Health Monitor' || $title == 'Health Records') ? $border : ''; ?>" class="nav-link text-center links d-flex d-lg-flex d-xxl-flex justify-content-center align-items-center flex-nowrap order-first align-items-lg-center align-items-xxl-center nav-sidebar" href="<?php echo $health_records; ?>" >
                            <div class="d-lg-flex justify-content-center align-items-center align-content-center align-self-center flex-nowrap justify-content-lg-center align-items-lg-center" style="color:#2E8B57;">
                                <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"><svg class="bi bi-clipboard2-heart d-lg-flex align-self-start order-first justify-content-lg-center align-items-lg-center" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" style="font-size: 46px;padding: 9px;padding-right: 0px;padding-left: 0px;width: 46px;margin-left: -3px;background: var(--bs-primary-bg-subtle);border-radius: 38px;">
                                        <path d="M10.058.501a.501.501 0 0 0-.5-.501h-2.98c-.276 0-.5.225-.5.501A.499.499 0 0 1 5.582 1a.497.497 0 0 0-.497.497V2a.5.5 0 0 0 .5.5h4.968a.5.5 0 0 0 .5-.5v-.503A.497.497 0 0 0 10.555 1a.499.499 0 0 1-.497-.499Z"></path>
                                        <path d="M3.605 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5h-.5a.5.5 0 0 1 0-1h.5a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5h.5a.5.5 0 0 1 0 1h-.5Z"></path>
                                        <path d="M8.068 6.482c1.656-1.673 5.795 1.254 0 5.018-5.795-3.764-1.656-6.69 0-5.018Z"></path>
                                    </svg></div>
                                <div class="d-lg-flex links justify-content-lg-center align-items-lg-center" style="width: 7px;"></div>
                                <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-start align-items-lg-center" style="padding-bottom: 0px;height: 35.6px;padding-top: 16px;width: 116.8px;">
                                    <p class="d-lg-flex flex-column justify-content-lg-center align-items-lg-center"><strong>Health Records</strong></p>
                                </div>
                            </div>
                        </a><a style="font-size: 0.7rem;border-style: none; padding: 7px 5px 7px 10px; border-radius: 1px; <?php echo($title == 'Prescriptions' || $title == 'Edit Prescription') ? $border : ''; ?>" class="nav-link text-center d-flex d-lg-flex d-xxl-flex justify-content-center align-items-center flex-nowrap order-first align-items-lg-center align-items-xxl-center nav-sidebar links" href="prescription.php" >
                                <div class="d-lg-flex justify-content-center align-items-center align-content-center align-self-center flex-nowrap justify-content-lg-center align-items-lg-center" style="color:#2E8B57;">
                                    <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-capsule d-lg-flex align-self-start order-first justify-content-lg-center align-items-lg-center" style="font-size: 46px;padding: 9px;padding-right: 0px;padding-left: 0px;width: 46px;margin-left: -3px;background: var(--bs-primary-bg-subtle);border-radius: 38px;">
                                            <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z"></path>
                                        </svg></div>
                                    <div class="d-lg-flex justify-content-lg-center align-items-lg-center" style="width: 7px;"></div>
                                    <div class="d-lg-flex justify-content-center align-items-center justify-content-lg-start align-items-lg-center" style="padding-bottom: 0px;height: 35.6px;padding-top: 16px;width: 116.8px;">
                                        <p class="d-lg-flex flex-column justify-content-lg-center align-items-lg-center"><strong>Prescriptions</strong></p>
                                    </div>
                                </div>
                            </a></li>
                    </ul>
                        <hr class="d-lg-flex align-items-center align-self-center justify-content-lg-center align-items-lg-center" style="width: 212px; color: #212529; border-top: 2px solid #2E8B57;">
                        <div class="d-flex d-sm-flex justify-content-center justify-content-sm-center flex-lg-column" style="width: auto;height: auto;"><a class="d-lg-flex justify-content-lg-center" href="<?php echo $first_side_link; ?>" style="padding: 15px;border-radius: 6px;background: rgba(46,139,87,0.47);border-color:#2E8B57;width: auto;margin: 10px;margin-right: 20px;margin-left: 20px;">
                        <strong>
                            <span style="color: #2E8B57;"><?php if($_SESSION['usertype']=='p'){
                                echo "Request Medicine Here";
                            }elseif($_SESSION['usertype']=='ph'){
                                echo "Medicine Inventory";
                            }elseif($_SESSION['usertype']=='do'){
                                $pending_appointment = $database->query("select * from consultation where stat='pending'")->fetch_all();
                                echo count($pending_appointment)." Pending Appointments";
                            }elseif($_SESSION['usertype']=='d'){
                                echo "Available Medicines";
                            }?></span></strong></a>
                        <a class="d-lg-flex justify-content-lg-center" href="<?php echo $second_side_link; ?>" style="padding: 15px;font-size: 16px;border-radius: 6px;background: rgba(46,139,87,0.47);border-color:#2E8B57;width: auto;margin: 10px;margin-right: 20px;margin-left: 20px;"><strong><span style="color: #2E8B57;"><?php echo($_SESSION['usertype'] == 'd'|| $_SESSION['usertype']=='ph') ? 'Add Prescription Here' : 'Book an appointment here...'; ?></span></strong></a><a class="d-lg-flex justify-content-lg-center" href="#" style="padding: 15px;font-size: 16px;border-radius: 6px;background: rgba(46,139,87,0.47);border-color: #2E8B57; width: auto;margin: 10px;margin-right: 20px;margin-left: 20px;"><strong><span style="color: #2E8B57">Check you health record..</span></strong></a></div>
                </div>
<?php endif; ?>
