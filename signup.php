<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Sign Up</title>
    
</head>
<body>
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


    <center>
    <div class="container">
        <table border="0">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">Add Your Personal Details to Continue</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Name: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                </td>
                <td class="label-td">
                    <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label">Address</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label">Province</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <select name="province" id="province" class="input-text" required>
                        <option value="Camarines Sur">Camarines Sur</option>
                        <option value="Camarines Norte">Camarines Norte</option>
                        <option value="Albay">Albay</option>
                        <option value="Masbate">Masbate</option>
                        <option value="Catanduanes">Catanduanes</option>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="town" class="form-label">Town</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="town" class="input-text" placeholder="Town" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="brgy" class="form-label">Barangay</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="brgy" class="input-text" placeholder="Town" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="street" class="form-label">Street</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="street" class="input-text" placeholder="Street" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="sex" class="form-label">Sex</label>
                </td>
            </tr>
            <tr>
            <td class="label-td" colspan="2">
            <select name="sex" id="sex" class="input-text" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>       
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="dob" class="form-label">Date of Birth: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="date" name="dob" class="input-text" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="father" class="form-label">Father's Name</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="father" class="input-text" placeholder="Father's Complete Name" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="mother" class="form-label">Mother's Name</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="mother" class="input-text" placeholder="Mother's Complete Name" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label">Marital Status</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <select name="marital" id="province" class="input-text" required>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Separated">Separated</option>
                        <option value="Annuled">Annuled</option>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                </td>
            </tr>
            

            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Next" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>

                    </form>
            </tr>
        </table>

    </div>
</center>
</body>
</html>