<?php include '../ui/header.php'; ?>
    <div class="container">
        <?php if(isset($_SESSION['message']) && $_SESSION['message'] !=''){
            echo '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>';
            unset($_SESSION['message']);
        } ?>
        <div class="row gx-2" style="margin-top: 45px;">
            <div class="col-12 col-md-8 col-xl-4 col-xxl-2 offset-0 offset-xl-0" style="background: #f1f0f0;border-radius: 23px;">
                <ul class="nav nav-tabs" style="border-radius: 10px;">
                    <li class="nav-item"><a class="nav-link active text-center d-xxl-flex flex-wrap order-first align-items-xxl-center" href="#" style="background: rgba(255,255,255,0);font-size: 0.7rem;border-style: none;padding-top: 21px;"><strong>Medicine Requests</strong><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="align-self-start order-first" style="font-size: 30px;padding-right: 0px;padding-left: 0px;width: 46px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M128 192C110.3 192 96 177.7 96 160C96 142.3 110.3 128 128 128C145.7 128 160 142.3 160 160C160 177.7 145.7 192 128 192zM200 160C200 146.7 210.7 136 224 136H448C461.3 136 472 146.7 472 160C472 173.3 461.3 184 448 184H224C210.7 184 200 173.3 200 160zM200 256C200 242.7 210.7 232 224 232H448C461.3 232 472 242.7 472 256C472 269.3 461.3 280 448 280H224C210.7 280 200 269.3 200 256zM200 352C200 338.7 210.7 328 224 328H448C461.3 328 472 338.7 472 352C472 365.3 461.3 376 448 376H224C210.7 376 200 365.3 200 352zM128 224C145.7 224 160 238.3 160 256C160 273.7 145.7 288 128 288C110.3 288 96 273.7 96 256C96 238.3 110.3 224 128 224zM128 384C110.3 384 96 369.7 96 352C96 334.3 110.3 320 128 320C145.7 320 160 334.3 160 352C160 369.7 145.7 384 128 384zM0 96C0 60.65 28.65 32 64 32H512C547.3 32 576 60.65 576 96V416C576 451.3 547.3 480 512 480H64C28.65 480 0 451.3 0 416V96zM48 96V416C48 424.8 55.16 432 64 432H512C520.8 432 528 424.8 528 416V96C528 87.16 520.8 80 512 80H64C55.16 80 48 87.16 48 96z"></path>
                            </svg></a><a class="nav-link text-center d-xxl-flex flex-wrap order-first align-items-xxl-center" href="#" style="background: rgba(255,255,255,0);font-size: 0.7rem;border-style: none;color: #3c3744;"><strong>Prescriptions</strong><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-prescription align-self-start order-first" style="font-size: 30px;padding-right: 0px;padding-left: 0px;width: 46px;">
                                <path d="M5.5 6a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 1 0V9h.293l2 2-1.147 1.146a.5.5 0 0 0 .708.708L9 11.707l1.146 1.147a.5.5 0 0 0 .708-.708L9.707 11l1.147-1.146a.5.5 0 0 0-.708-.708L9 10.293 7.695 8.987A1.5 1.5 0 0 0 7.5 6h-2ZM6 7h1.5a.5.5 0 0 1 0 1H6V7Z"></path>
                                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v10.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 14.5V4a1 1 0 0 1-1-1V1Zm2 3v10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V4H4ZM3 3h10V1H3v2Z"></path>
                            </svg></a><a class="nav-link text-center d-xxl-flex flex-wrap order-first align-items-xxl-center" href="#" style="background: rgba(255,255,255,0);font-size: 0.7rem;border-style: none;color: #3c3744;"><strong>Check Patients</strong><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="align-self-start order-first" style="font-size: 30px;padding-right: 0px;padding-left: 0px;width: 46px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M208 256c35.35 0 64-28.65 64-64c0-35.35-28.65-64-64-64s-64 28.65-64 64C144 227.3 172.7 256 208 256zM464 232h-96c-13.25 0-24 10.75-24 24s10.75 24 24 24h96c13.25 0 24-10.75 24-24S477.3 232 464 232zM240 288h-64C131.8 288 96 323.8 96 368C96 376.8 103.2 384 112 384h192c8.836 0 16-7.164 16-16C320 323.8 284.2 288 240 288zM464 152h-96c-13.25 0-24 10.75-24 24s10.75 24 24 24h96c13.25 0 24-10.75 24-24S477.3 152 464 152zM512 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V96C576 60.65 547.3 32 512 32zM528 416c0 8.822-7.178 16-16 16H64c-8.822 0-16-7.178-16-16V96c0-8.822 7.178-16 16-16h448c8.822 0 16 7.178 16 16V416z"></path>
                            </svg></a><a class="nav-link text-center d-xxl-flex flex-wrap order-first align-items-xxl-center" href="#" style="background: rgba(255,255,255,0);font-size: 0.7rem;border-style: none;color: #3c3744;padding-bottom: 21px;"><strong>Appointments</strong><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" class="align-self-start order-first" style="font-size: 30px;padding-right: 0px;padding-left: 0px;width: 46px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 248H128V192H48V248zM48 296V360H128V296H48zM176 296V360H272V296H176zM320 296V360H400V296H320zM400 192H320V248H400V192zM400 408H320V464H384C392.8 464 400 456.8 400 448V408zM272 408H176V464H272V408zM128 408H48V448C48 456.8 55.16 464 64 464H128V408zM272 192H176V248H272V192z"></path>
                            </svg></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
            </div>
            <div class="col" style="padding-left: 38px;padding-right: 88px;padding-top: 27px;background: #f1f0f0;margin-left: 22px;border-radius: 10px;font-family: Montserrat, sans-serif;">
                <?php
                            
                    //get available medicine list from database
                    $medicinerow = $database->query("select * from medicine_inventory where med_qty >0");
                    $medicinefetch=$medicinerow->fetch_assoc();
                    $medicineid= $medicinefetch["medicine_id"];
                    $medicinename=$medicinefetch["med_name"];

                ?>
                <form method="POST" action="submit_requests_medicine.php" class="text-start" >
                        <h2 class="text-center justify-content-around" style="text-shadow: 0px 0px;padding-bottom: 0;">Request Medicine</h2>
                        <h6 class="text-center">Fill out this form with necessary information request medicine.</h6><label class="form-label">Available Medicine</label>
                        <input type="hidden" name="patient_id" value="<?php echo $userid; ?>">
                        <select class="form-select" name="medicine_id">
                            <?php
                            foreach($medicinerow as $medicinefetch){
                                echo "<option value=".$medicinefetch['medicine_id'].">".$medicinefetch['med_name']."</option>";
                            }?>
                        </select>
                    <label class="form-label" for="quantity">Quantity</label>
                    <input class="form-control" type="number" name="quantity">
                    <label class="form-label" for="note">Note</label>
                    <textarea class="form-control" name="note"></textarea>
                    <label class="form-label">Prescription ID</label>
                    <input class="form-control" type="text"  name="prescription_id">
                    <input type="submit" name="submit" value="submit" class="btn btn-lg btn-primary py-md-0 my-md-0 my-sm-0 py-sm-5 my-lg-4 px-lg-3 py-lg-0" style="margin-top: 18px;margin-bottom: 18px;background: #3d52d5;padding-top: 0px;padding-bottom: 0px;height: 49px;">
                </form>
            </div>
        </div>
    </div>
  
<?php include '../ui/footer.php' ?>