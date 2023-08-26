<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PEW</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
</head>

<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


if($_POST){
    
    $_SESSION["personal"]=array(
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'province'=>$_POST['province'],
        'town'=>$_POST['town'],
        'brgy'=>$_POST['brgy'],
        'street'=>$_POST['street'],
        'dob'=>$_POST['dob'],
        'mother'=>$_POST['mother'],
        'father'=>$_POST['father'],
        'marital'=>$_POST['marital'],
        'sex'=>$_POST['sex']

    );

    print_r($_SESSION["personal"]);
    header("location: create-account.php");


}

?>
<body>
<section class="position-relative py-4 py-xl-5" style="font-family: Montserrat, sans-serif;">
        <section class="py-4 py-xl-5">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div>
                            <h2 class="text-uppercase fw-bold mb-3">rHUCONNECT</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xxl-4">
                    <div class="row mb-5">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <h2>Let's get started</h2>
                            <p class="w-lg-50">Fill out necessary information to sign-up</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 col-xl-4 col-xxl-5">
                    <div class="card mb-5" style="width: 532.987px;">
                        <div class="card-body d-flex flex-row justify-content-start flex-nowrap justify-content-lg-start align-items-lg-center" style="width: 508.987px;margin-left: 6px;">
                    <form class="text-center d-flex flex-row flex-wrap justify-content-lg-start align-items-lg-center" method="POST" style="width: 489px;margin-left: 21px;margin-top: 20px;" action="">
                                <div class="mb-3" style="margin-right: 12px;">
                                <label class="form-label d-lg-flex justify-content-lg-start">First Name</label>
                                <input class="form-control" type="text" name="fname" placeholder="First Name"
                                ></div>
                                <div class="mb-3">
                                    <label class="form-label d-lg-flex justify-content-lg-start">Last Name</label>
                                    <input class="form-control" type="text" name="lname" placeholder="Last Name">
                                </div>
                                <div class="mb-3" style="margin-right: 12px;">
                                <label class="form-label text-center d-lg-flex justify-content-lg-start" for="province">Province</label
                                ><input class="form-control" type="text" name="province" placeholder="Province">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-lg-flex justify-content-lg-start">Town</label><input class="form-control" type="text" name="town" placeholder="Town">
                                </div>
                                <div class="mb-3" style="margin-right: 12px;">
                                <label class="form-label d-lg-flex justify-content-lg-start">Barangay</label>
                                <input class="form-control" type="text" name="brgy" placeholder="Barangay">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-lg-flex justify-content-lg-start">Street</label>
                                    <input class="form-control" type="text" name="street" placeholder="Street">
                                </div>
                                <div class="mb-3" style="margin-right: 12px ;"><label class="form-label d-lg-flex justify-content-lg-start">Sex</label>
                                    <select class="dropdown form-control d-lg-flex justify-content-lg-start" name="sex">
                                        <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="background: var(--bs-card-cap-bg);color: var(--bs-gray-dark);">Female</button>
                                        <div class="dropdown-menu">
                                            <option class="dropdown-item form-control" href="male">Male</option>
                                            <option class="dropdown-item" href="female">Female</option>
                                        </div>
                                    </select>
                                </div>
                                <div class="mb-3" style="margin-right: 13px;"><label class="form-label d-lg-flex justify-content-lg-start">Marital Status</label>
                                <select class="dropdown form-control d-lg-flex justify-content-lg-start" name="marital">
                                        <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="background: var(--bs-card-cap-bg);color: var(--bs-gray-dark);">Female</button>
                                        <div class="dropdown-menu">
                                            <option class="dropdown-item form-control" href="single">Single</option>
                                            <option class="dropdown-item" href="married">Married</option>
                                            <option class="dropdown-item" href="Widowed">Widowed</option>
                                            <option class="dropdown-item" href="Separated">Separated</option>
                                        </div>
                                    </select>
                                </div>
                                <div class="mb-3" style="margin-right: 0px;margin-bottom: 8px;padding-bottom: 0px;">
                                <label class="form-label d-lg-flex justify-content-lg-start">Date of Birth</label>
                                <input class="form-control" name="dob" placeholder="date of birth" type="date">
                                </div>
                                <div class="mb-3" style="margin-right: 13px;"><label class="form-label d-lg-flex justify-content-lg-start">Father's Name</label>
                                <input class="form-control" type="text" name="father" placeholder="Fathers Name">
                                </div>
                                <div class="mb-3">
                                <label class="form-label d-lg-flex justify-content-lg-start">Mother's Name</label>
                                <input class="form-control" type="text" name="mother" placeholder="Mothers Name">
                                </div>
                                <div class="mb-3">
                                <input class="btn btn-primary btn-lg d-block w-100" name="submit" style="background: #1e80c1;margin-left: 0px;" type="submit"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/js/script.min.js"></script>
</body>

</html>