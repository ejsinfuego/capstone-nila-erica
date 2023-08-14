
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
        
        //get available medicine list from database
        $medicinerow = $database->query("select * from medicine_inventory where med_qty >0");

        $medicinefetch=$medicinerow->fetch_assoc();
        $medicineid= $medicinefetch["medicine_id"];
        $medicinename=$medicinefetch["med_name"];


        ?>

        <div class="dash-body">
        <div><?php if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }?></div>
        <form method="POST" action="submit_requests_medicine.php" enctype="multiform">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td>
                        <lable for="medicine_name">Medicine</lable>
                    </td>
                </tr>
                <input type="hidden" name="patient_id" value="<?php echo $userid ?>">
                <tr>
                    <td>
                       <select name="medicine_id">
                            <?php
                            foreach($medicinerow as $medicinefetch){
                                echo "<option value=".$medicinefetch['medicine_id'].">".$medicinefetch['med_name']."</option>";
                            }?>
                       </select>
                    </td>
                </tr>
                <tr>
                        <td>
                        <label>Quantity</label>
                        </td>
                        <td>
                        <input type="number" name="quantity" placeholder="Quantity">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Prescription ID</label>
                        </td>
                        <td>
                        <input type="number" name="prescription_id" placeholder="prescription_id">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>note</label>
                        </td>
                        <td>
                        <input type="text" name="note" placeholder="note">
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