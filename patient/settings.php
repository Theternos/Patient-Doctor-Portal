<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <title>Settings</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-X 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .display-text {
            height: 35px;
            margin-bottom: 1vh;
            border: 0;
            cursor: pointer;
            letter-spacing: 1px;
            font-style: italic;
            font-weight: 400;
        }

        /* Style for the container */
        .radio-container {
            display: flex;
            flex-direction: column;
            justify-content: start;
            font-family: Arial, sans-serif;
        }

        /* Hide the default radio button input */
        .radio-label input[type="radio"] {
            display: none;
        }

        /* Style for the custom radio button */
        .radio-custom {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #3498db;
            border-radius: 50%;
            margin-right: 10px;
            margin-bottom: 0;
            transition: border-color 0.3s ease, transform 0.3s ease;
        }

        /* Style for the label text */
        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        /* Change the custom radio button's color when checked */
        .radio-label input[type="radio"]:checked+.radio-custom {
            border: 5px solid #3498db;
            transition: 0.1s;
        }

        /* Style for label text */
        .radio-label span {
            margin-left: 10px;
            font-size: 16px;
        }

        /* Optional: Add a transition effect for label text */
        .radio-label span {
            transition: color 0.3s ease;
        }

        /* Optional: Change label text color on hover */
        .radio-label:hover span {
            color: #3498db;
        }

        .radio-label w {
            margin-top: 22px;
        }


        .donation-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }



        .donation-form {
            text-align: left;
        }

        .donation-item {
            margin-bottom: 20px;
        }


        .radio-custom-group {
            display: flex;
            align-items: center;
        }

        .custom-radio {
            display: none;
        }

        .custom-label {
            margin-right: 10px;
            cursor: pointer;
            padding: 5px 10px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .custom-radio:checked+.custom-label {
            background-color: #27ae60;
        }

        .custom-button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-button:hover {
            background-color: #2980b9;
        }
    </style>


</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");
    $sqlmain = "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);  // Bind the variable $useremail as a string parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];


    if ($_POST) {

        $_SESSION["donate_organs"] = array(
            'organ_selection' => $_POST['organ_selection'],
        );
        $donate_type = $_SESSION['donate_organs']['organ_selection'];

        print_r($_SESSION["donate_organs"]);
        header("location: settings.php?action=donate_next&id=$userid&error=0");
    }

    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container" style="padding-top: 4vh">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Home</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="doctors.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">All Doctors</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="specialities.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Book Appointment</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Bookings</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-recent">
            <a href="recent.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Recent Consultancy</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-test">
            <a href="recent_tests.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Analysis History</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-payment">
            <a href="payment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Payments</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings  menu-active menu-icon-settings-active">
            <a href="settings.php" class="non-style-link-menu  non-style-link-menu-active">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>
    </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <td width="13%">
                    <a href="settings.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Settings</p>

                </td>

                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php
                        date_default_timezone_set('Asia/Kolkata');

                        $today = date('Y-m-d');
                        echo $today;


                        $patientrow = $database->query("select  * from  patient;");
                        $doctorrow = $database->query("select  * from  doctor;");
                        $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                        $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>
            <tr>
                <td colspan="4">

                    <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <?php
                                    $result = $database->query("SELECT * FROM organ_donation WHERE pid = '$userid'");
                                    if ($result->num_rows == null) {
                                    ?>
                                        <div style="width:91.7%; margin-left: 2vw;">
                                            <div class="flex-row" style="justify-content:space-between;">
                                                <div>
                                                    <a href="?action=donate&id=<?php echo $userid ?>&error=0" class="non-style-link">
                                                        <div class="dashboard-items setting-tabs" style="padding:20px;width:110%;display:flex; margin-left: 0;">
                                                            <div class="btn-icon-donation"><img src="../img/icons/donate-iceblue.svg" alt="" width="28px"></div>
                                                            <div>
                                                                <div class="h1-dashboard">
                                                                    Donate Organ &nbsp;
                                                                </div><br>
                                                                <div class="h3-dashboard" style="font-size: 15px;">
                                                                    Donate organs to live in Others
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="?action=donate&id=<?php echo $userid ?>&error=0" class="non-style-link">
                                                        <div class="dashboard-items setting-tabs" style="padding:20px;width:102%;display: flex; margin-left:20px ;">
                                                            <div class="btn-icon-donation"><img src="../img/icons/withdraw-iceblue.svg" alt="" width="28px"></div>
                                                            <div>
                                                                <div class="h1-dashboard" style="color: #ff5050;">
                                                                    Withdraw &nbsp;
                                                                </div><br>
                                                                <div class="h3-dashboard" style="font-size: 14px;">
                                                                    Choose this option to remove your existing registration from the register
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div>
                                            <div>
                                                <a href="?action=donate&id=<?php echo $userid ?>&error=0" class="non-style-link">
                                                    <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div class="btn-icon-donation"><img src="../img/icons/donate-iceblue.svg" alt="" width="28px"></div>
                                                        <div>
                                                            <div class="h1-dashboard">
                                                                Donate Organ &nbsp;
                                                            </div><br>
                                                            <div class="h3-dashboard" style="font-size: 15px;">
                                                                Donate organs to live in Others
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=edit&id=<?php echo $userid ?>&error=0" class="non-style-link">
                                        <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex">
                                            <div class="btn-icon-back dashboard-icons-setting" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                            <div>
                                                <div class="h1-dashboard">
                                                    Account Settings &nbsp;
                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px;">
                                                    Edit your Account Details & Change Password
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=view&id=<?php echo $userid ?>" class="non-style-link">
                                        <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex;">
                                            <div class="btn-icon-back dashboard-icons-setting " style="background-image: url('../img/icons/view-iceblue.svg');"></div>
                                            <div>
                                                <div class="h1-dashboard">
                                                    View Account Details

                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px;">
                                                    View Personal information About Your Account
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=drop&id=<?php echo $userid . '&name=' . $username ?>" class="non-style-link">
                                        <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex;">
                                            <div class="btn-icon-back dashboard-icons-setting" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                            <div>
                                                <div class="h1-dashboard" style="color: #ff5050;">
                                                    Delete Account

                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px;">
                                                    Will Permanently Remove your Account
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </td>

                            </tr>
                        </table>
                    </center>
                </td>
            </tr>

        </table>
    </div>
    </div>
    <?php
    if ($_GET) {

        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            You want to delete Your Account<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-account.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from patient where pid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $name = $row["pname"];
            $email = $row["pemail"];
            $address = $row["paddress"];
            $b_group = $row["blood_group"];
            $dob = $row["pdob"];
            $nic = $row['pnic'];
            $tele = $row['ptel'];
            echo '
            <div id="popup1" class="overlay">
                <div class="popup" style="transform: scale(.95); margin-top: 2vh">
                    <center>
                        <h2></h2>
                        <a class="close" href="settings.php">&times;</a>

                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Details of Me !</p><br><br>
                                    </td>
                                </tr>
                                
                                <tr>
                                    
                                    <td class="td-label" colspan="2">
                                        <label for="name" class="form-label">Name: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                        ' . $name . '<br><br>
                                    </td>
                                    
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="Email" class="form-label">Email: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                    ' . $email . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="nic" class="form-label">Aadhar: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                    ' . $nic . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="b_group" class="form-label">Blood Group: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                    ' . $b_group . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="Tele" class="form-label">Telephone: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                    ' . $tele . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="address" class="form-label">Address: </label>
                                        
                                    </td>
                                </tr>
                                <tr>
                                <td class="label-td display-text" colspan="2">
                                ' . $address . '<br><br>
                                </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="spec" class="form-label">Date of Birth: </label>
                                    </td>
                                </tr>
                                <tr>
                                <td class="label-td display-text" colspan="2">
                                ' . $dob . '<br><br>
                                </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <center><a href="settings.php"><input type="button" value="Okay" class="login-btn btn-primary-soft btn" ></a></center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>
            ';
        } elseif ($action == 'donate') {
            $sqlmain = "select * from patient where pid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $name = $row["pname"];
            $email = $row["pemail"];
            $address = $row["paddress"];
            $b_group = $row["blood_group"];
            $dob = $row["pdob"];
            $nic = $row['pnic'];
            $tele = $row['ptel']; ?>
            <div id="popup1" class="overlay">
                <div class="popup" style="transform: scale(.95); margin-top: 2vh">
                    <center>
                        <h2></h2>
                        <a class="close" href="settings.php">&times;</a>

                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">

                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Donate Organs.</p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-label" colspan="2">
                                        <label for="Tele" class="form-label">I want to donate * </label>
                                    </td>
                                </tr>
                                <form action="" method="post">
                                    <tr>
                                        <td>
                                            <div class="radio-container">
                                                <label class="radio-label">
                                                    <input type="radio" name="organ_selection" value="1">
                                                    <span class="radio-custom"></span>
                                                    <w class="display-text" style="font-size: 14px;">All my organs and tissue</w>
                                                </label>
                                                <label class="radio-label">
                                                    <input type="radio" name="organ_selection" value="0">
                                                    <span class="radio-custom"></span>
                                                    <w class="display-text" style="font-size: 14px;">Some organs and tissue</w>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center><button type="submit" class="login-btn btn-primary-soft btn">Next</button></center>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>
        <?php
        } elseif ($action == 'donate_next') {
            $sqlmain = "select * from patient where pid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $name = $row["pname"];
            $email = $row["pemail"];
            $address = $row["paddress"];
            $b_group = $row["blood_group"];
            $dob = $row["pdob"];
            $nic = $row['pnic'];
            $tele = $row['ptel']; ?>
            <div id="popup1" class="overlay">
                <div class="popup" style="transform: scale(.95); margin-top: 2vh">
                    <center>
                        <h2></h2>
                        <a class="close" href="settings.php">&times;</a>

                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">

                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Donate Organs.</p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-label" colspan="2">
                                        <label for="Tele" class="form-label">I want to donate * </label>
                                    </td>
                                </tr>
                                <form action="" method="post">
                                    <tr>
                                        <td>
                                            <div class="radio-container">
                                                <label class="radio-label">
                                                    <input type="radio" name="organ_selection" value="1">
                                                    <span class="radio-custom"></span>
                                                    <w class="display-text" style="font-size: 14px;">All my organs and tissue</w>
                                                </label>
                                                <label class="radio-label">
                                                    <input type="radio" name="organ_selection" value="0">
                                                    <span class="radio-custom"></span>
                                                    <w class="display-text" style="font-size: 14px;">Some organs and tissue</w>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center><button type="submit" class="login-btn btn-primary-soft btn">Next</button></center>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>
    <?php
        } elseif ($action == 'edit') {
            $sqlmain = "select * from patient where pid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $name = $row["pname"];
            $email = $row["pemail"];



            $address = $row["paddress"];
            $nic = $row['pnic'];
            $tele = $row['ptel'];

            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );

            if ($error_1 != '4') {
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="settings.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">' .
                    $errorlist[$error_1]
                    . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit User Account Details.</p>
                                        User ID : ' . $id . ' (Auto Generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-user.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="' . $id . '" name="id00">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="hidden" name="oldemail" value="' . $email . '" >
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="' . $email . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="' . $name . '" required><br>
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="nic" class="form-label">Aadhar: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="nic" class="input-text" placeholder="NIC Number" value="' . $nic . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Telephone: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="' . $tele . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Address</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="text" name="address" class="input-text" placeholder="Address" value="' . $address . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">Conform Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
            } else {
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Edit Successfully!</h2>
                            <a class="close" href="settings.php">&times;</a>
                            <div class="content">
                                If You change your email also Please logout and login again with your new email
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                            <a href="../logout.php" class="non-style-link"><button  class="btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;Log out&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';
            };
        }
    }
    ?>

</body>
<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="organ"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach(otherCheckbox => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        });
    });
    // Add animation for form submission (optional)
    document.querySelector('.donation-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent actual form submission
        // You can add animation or other actions here
        alert('Form submitted successfully!');
    });
</script>

</html>