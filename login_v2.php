<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>RhuConnect</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

//import database
include("connection.php");


if($_POST){

    $email=$_POST['useremail'];
    $password=$_POST['userpassword'];
    
    $error='<label for="promter" class="form-label"></label>';

    $result=$database->query("select * from webuser where email='$email'");
    if($result->num_rows==1){
        $utype=$result->fetch_assoc()['usertype'];
        if ($utype=='p'){
            $checker = $database->query("select * from patient where pemail='$email' and ppassword='$password'");
            if ($checker->num_rows==1){

                //   Patient dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='p';
                
                header('location: ./patients/appointments.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }

        }elseif($utype=='a'){
            $checker = $database->query("select * from admin where aemail='$email' and apassword='$password'");
            if ($checker->num_rows==1){


                //   Admin dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='a';
                
                header('location: admin/index.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }


        }elseif($utype=='d'){
            $checker = $database->query("select * from doctor where docemail='$email' and docpassword='$password'");
            if ($checker->num_rows==1){

                //   doctor dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='d';
                header('location: ./doctors/index.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }

        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
    }

    
}else{
    $error='<label for="promter" class="form-label">&nbsp;</label>';
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
                <div class="col-xxl-3">
                    <div class="row mb-5">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <h2>Log in</h2>
                            <p class="w-lg-50">You have to log in first to book an appointment so that we can serve your better.<p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">
                            <?php (isset($error)) ? print($error) : print('<label for="promter" class="form-label">&nbsp;</label>'); ?>
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4" style="background: #2E8B57;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
                                </svg></div>
                            <form class="text-center" method="POST" action="login_v2.php">
                                <div class="mb-3"><input class="form-control" type="email" name="useremail" placeholder="Email"></div>
                                <div class="mb-3"><input class="form-control" type="password" name="userpassword" placeholder="Password"></div>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: #2E8B57;">Login</button></div>
                            </form>
                            <div class="mb-3"><a class="btn btn-primary d-block w-100" href="signup.php" style="background: #2E8B57;">Sign Up</a></div>
                                <p class="text-muted">Forgot your password?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>