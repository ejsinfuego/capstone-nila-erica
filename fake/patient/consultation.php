
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Doctors</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com
    require '../vendor/autoload.php';
    use Carbon\Carbon;

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Home</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor menu-active menu-icon-doctor-active">
                        <a href="doctors.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">All Doctors</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Scheduled Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <?php
        if(isset($_SESSION['message'])){
            ?> <div><p><?php  echo $_SESSION['message'];?></p></div>
            <?php unset($_SESSION['message']); 
        }else{
            unset($_SESSION['message']);

        }
        ?>
        <div class="dash-body">
       
        <form method="POST" action="submitConsultation.php">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td
                        <lable for="type">Type</lable>
                    </td>
                </tr>
                <input type="hidden" name="patient_id" value="<?php echo $userid ?>">
                <tr>
                    <td>
                       <select name="type">
                       <option value="xray">xray</option>
                        <option value="blood">blood</option>
                        <option value ="urine">urine</option>
                        <option value="doctor">doctor</option>
                        <option value="vitals">vitals</option>
                        <option value="other">other</option>
                       </select>
                    </td>
                </tr>
                <tr>
                        <td>
                        <label>date</label>
                        </td>
                        <td>
                        <input type="date" name="date">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>time</label>
                        </td>
                        <td>
                        <input type="time" name="time">
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="stat" value="pending">
                        </td>
                    </tr>
                    <tr></tr>
                        <td>
                        <input type="submit" name="submit" value="submit">
                        </td>
                </form>       
                        
            </table>
        </div>
    </div>

</div>

</body>
</html>