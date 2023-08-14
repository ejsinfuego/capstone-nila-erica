<?php 
$title = "Index";
include(__DIR__ . "/../_header_v2.php"); 

$appointments = count($database->query("select * from consultation where patient_id = ".$userid)->fetch_all());
$medicine_requests_count = count($database->query("select * from request_medicine where patient_id = ".$userid)->fetch_all());


?>
    <div class="container py-4 py-xl-2" style="height: 300.3px;">
        <div class="row mb-5" style="border-radius: 10px;padding: 23px;background: url('../assets/img/IMG_20230814_112809.jpg') center / cover no-repeat, #fbfff1;">
            <section class="py-4 py-xl-5">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div>
                                <h2 class="text-uppercase fw-bold mb-3" style="text-shadow: 2px 3px 4px rgb(255,255,255);">Book medical appointment online</h2>
                                <p class="mb-4" style="text-shadow: 2px 1px 3px rgb(255,255,255);">Reach out to your Rural Health Unit without leaving your doorstep.</p><button class="btn btn-primary fs-5 me-2 py-2 px-4" type="button" style="background: #1e80c1;">Book an Appointment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container py-4 py-xl-5" style="background: #ffffff;margin-top: 44px;border-radius: 10px;color: #3c3744;height: 274.4px;">
        <div class="row gy-4 row-cols-2 row-cols-md-4">
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg" data-bss-hover-animate="tada" style="background: #1e80c1;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 248H128V192H48V248zM48 296V360H128V296H48zM176 296V360H272V296H176zM320 296V360H400V296H320zM400 192H320V248H400V192zM400 408H320V464H384C392.8 464 400 456.8 400 448V408zM272 408H176V464H272V408zM128 408H48V448C48 456.8 55.16 464 64 464H128V408zM272 192H176V248H272V192z"></path>
                        </svg></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0"><?php echo $appointments ?></h2>
                        <p class="mb-0">Appointments</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg" data-bss-hover-animate="tada" style="background: #1e80c1;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-prescription">
                            <path d="M5.5 6a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 1 0V9h.293l2 2-1.147 1.146a.5.5 0 0 0 .708.708L9 11.707l1.146 1.147a.5.5 0 0 0 .708-.708L9.707 11l1.147-1.146a.5.5 0 0 0-.708-.708L9 10.293 7.695 8.987A1.5 1.5 0 0 0 7.5 6h-2ZM6 7h1.5a.5.5 0 0 1 0 1H6V7Z"></path>
                            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v10.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 14.5V4a1 1 0 0 1-1-1V1Zm2 3v10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V4H4ZM3 3h10V1H3v2Z"></path>
                        </svg></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0">45+</h2>
                        <p class="mb-0">Prescriptions</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg" data-bss-disabled-mobile="true" data-bss-hover-animate="tada" style="background: #1e80c1;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person-vcard-fill">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z"></path>
                        </svg></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0">67+</h2>
                        <p class="mb-0">Patients</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                    <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg" data-bss-hover-animate="tada" style="background: #1e80c1;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-capsule">
                            <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z"></path>
                        </svg></div>
                    <div class="px-3">
                        <h2 class="fw-bold mb-0"><?php echo $appointments; ?></h2>
                        <p class="mb-0">Medicine Requests</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4 py-xl-5">
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3 fs-6 fw-lighter flex-shrink-0 justify-content-center">
            <div class="col">
                <div class="card flex-grow-0">
                    <div class="card-body d-flex flex-column align-items-center p-4" style="margin-left: 59px;margin-right: 59px;">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon" style="background: #1e80c1;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-capsule">
                                <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z"></path>
                            </svg></div>
                        <h4 class="card-title" style="font-weight: bold;">Medicine</h4>
                        <p class="card-text" style="padding-left: 0px;padding-right: 0px;">You can book your test here.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-xxl-flex flex-column align-items-center align-content-center justify-content-xxl-center p-4">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon" style="background: #1e80c1;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M480 112c-44.18 0-80 35.82-80 80c0 32.84 19.81 60.98 48.11 73.31v78.7c0 57.25-50.25 104-112 104c-60 0-109.3-44.1-111.9-99.23C296.1 333.8 352 269.3 352 191.1V36.59c0-11.38-8.15-21.38-19.28-23.5L269.8 .4775c-13-2.625-25.54 5.766-28.16 18.77L238.4 34.99c-2.625 13 5.812 25.59 18.81 28.22l30.69 6.059L287.9 190.7c0 52.88-42.13 96.63-95.13 97.13c-53.38 .5-96.81-42.56-96.81-95.93L95.89 69.37l30.72-6.112c13-2.5 21.41-15.15 18.78-28.15L142.3 19.37c-2.5-13-15.15-21.41-28.15-18.78L51.28 12.99C40.15 15.24 32 25.09 32 36.59v155.4c0 77.25 55.11 142 128.1 156.8C162.7 439.3 240.6 512 336 512c97 0 176-75.37 176-168V265.3c28.23-12.36 48-40.46 48-73.25C560 147.8 524.2 112 480 112zM480 216c-13.25 0-24-10.75-24-24S466.7 168 480 168S504 178.7 504 192S493.3 216 480 216z"></path>
                            </svg></div>
                        <h4 class="card-title" style="font-weight: bold;">Consultation</h4>
                        <p class="card-text">Booked an appointment for consultation</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center align-content-center p-4">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon" style="background: #1e80c1;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M352 128C352 198.7 294.7 256 223.1 256C153.3 256 95.1 198.7 95.1 128C95.1 57.31 153.3 0 223.1 0C294.7 0 352 57.31 352 128zM287.1 362C260.4 369.1 239.1 394.2 239.1 424V448C239.1 452.2 241.7 456.3 244.7 459.3L260.7 475.3C266.9 481.6 277.1 481.6 283.3 475.3C289.6 469.1 289.6 458.9 283.3 452.7L271.1 441.4V424C271.1 406.3 286.3 392 303.1 392C321.7 392 336 406.3 336 424V441.4L324.7 452.7C318.4 458.9 318.4 469.1 324.7 475.3C330.9 481.6 341.1 481.6 347.3 475.3L363.3 459.3C366.3 456.3 368 452.2 368 448V424C368 394.2 347.6 369.1 320 362V308.8C393.5 326.7 448 392.1 448 472V480C448 497.7 433.7 512 416 512H32C14.33 512 0 497.7 0 480V472C0 393 54.53 326.7 128 308.8V370.3C104.9 377.2 88 398.6 88 424C88 454.9 113.1 480 144 480C174.9 480 200 454.9 200 424C200 398.6 183.1 377.2 160 370.3V304.2C162.7 304.1 165.3 304 168 304H280C282.7 304 285.3 304.1 288 304.2L287.1 362zM167.1 424C167.1 437.3 157.3 448 143.1 448C130.7 448 119.1 437.3 119.1 424C119.1 410.7 130.7 400 143.1 400C157.3 400 167.1 410.7 167.1 424z"></path>
                            </svg></div>
                        <h4 class="card-title" style="font-weight: bold;">Doctor</h4>
                        <p class="card-text">Book a check up with your doctor.</p>
                    </div>
                </div>
            </div>
        </div>
<?php include(__DIR__ . '/../_footer.php'); ?>