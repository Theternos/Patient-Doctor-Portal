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

    <title>Appointments</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .h3-search {
            font-family: 'Montserrat', sans-serif;
            margin-top: 5px;
        }

        .h3-search b {
            font-style: italic;
            letter-spacing: 1px;
        }

        w {
            text-align: right;
        }

        .dashboard-items {
            box-shadow: 0;
            transition: .1s;
        }

        .dashboard-items:hover {
            box-shadow: 0 0px 2px 0 #ff000033, 0 0px 3px #00000030;
            transition: .1s;
        }

        .tests-view {
            cursor: pointer;
        }

        .view-tests {
            max-height: 60vh !important;
            min-height: fit-content;
            overflow-y: scroll;
            width: 80%;
            text-align: left;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            letter-spacing: 1px;
        }

        /* Style for checkboxes */
        .checkbox-container {
            display: inline-block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 18px;
        }

        /* Hide the default checkbox */
        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Custom checkbox design */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border-radius: 3px;
        }

        /* Style the checked state */
        .checkbox-container input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Style the checkmark/indicator */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked~.checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();
    error_reporting(0);
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
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];


    //echo $userid;
    //echo $username;

    date_default_timezone_set('Asia/Kolkata');

    $today = date('Y-m-d');
    //TODO
    $sqlmain = "select appointment.roomid,schedule.mode, appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  patient.pid=$userid and appointment.status = 0 and schedule.scheduledate >= '$today'";
    if ($_POST) {
        //print_r($_POST);
        if (!empty($_POST["sheduledate"])) {
            $sheduledate = $_POST["sheduledate"];
            $sqlmain .= " and schedule.scheduledate='$sheduledate'";
        };
    }
    $sqlmain .= " order by schedule.scheduledate asc";
    $result = $database->query($sqlmain);


    $test_result = $database->query("SELECT * FROM test_booking INNER JOIN medical_test ON medical_test.mtid= test_booking.mtid WHERE pid = '$userid' and `status` = 0");
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
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Home</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">All Doctors</p>
                            </div>
                        </a>
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
                    <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
                        <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">My Bookings</p>
                            </div>
                        </a>
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
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Settings</p>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td width="13%">
                        <a href="index.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">My Bookings History</p>

                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            echo $today;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <?php if ($test_result->num_rows > 0) { ?>
                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Bookings (<?php echo $result->num_rows + 1 ?>)</p>
                        <?php } else { ?>
                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Bookings (<?php echo $result->num_rows ?>)</p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0" style="border:none">
                                    <tbody>

                                        <?php
                                        if ($result->num_rows == 0 and $test_result->num_rows == 0) {
                                            echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                        } else {
                                            if ($test_result->num_rows > 0) {
                                                $start_number = 0;
                                                $a = 0;
                                                for ($x = 0; $x < ($test_result->num_rows); $x++) {
                                                    $test_row = $test_result->fetch_assoc();
                                                    $booked_time = $test_row['booked_time'];
                                                    if ($a == 0) {
                                                        $start_number = $test_row['tid'];
                                                        $a = 1;
                                                    }
                                                    $end_number = $test_row['tid'];
                                                }
                                        ?>
                                                <div>
                                                    <div style="width: 95%;">
                                                        <div class="dashboard-items search-items">
                                                            <div style="width:100%;">
                                                                <div style="display: flex; flex-direction:row; justify-content:space-between;">
                                                                    <div class="h1-search" style="display:flex; flex-direction:row; align-items:center; justify-content:center; font-size:17px; color:#006dd3; padding:5px 0 10px 0; letter-spacing:.5px;">
                                                                        <div>
                                                                            <?php echo substr('Medical Tests', 0, 30) ?>
                                                                        </div>&nbsp;
                                                                        <a href="?action=view-tests" style="text-decoration: none;">
                                                                            <div class="h3-search flex-row tests-view" style=" color:#000; font-size:14px; margin-top:0;"> -
                                                                                <?php echo substr($test_result->num_rows . '&nbsp;Tests', 0, 30) ?>
                                                                                <img src="../img/down-arrow.svg" alt="Arrow Icon" width="15px" style="margin-left: 5px;">
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div>
                                                                        <div class=" h3-search" style="font-size: 12px; display:flex; flex-direction:row; align-items:center; justify-content:flex-end;">
                                                                            Booking Date: &nbsp;<b><?php echo substr($booked_time, 0, 10) ?></b></div>
                                                                        <div class="h3-search" style="font-size: 12px; display:flex; flex-direction:row; align-items:center; justify-content:flex-end;">
                                                                            Ref. Number: <b><?php echo '&nbsp;MT-0' . $start_number . '-0' . $end_number ?></b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="h3-search" style="text-align: center; margin-bottom:2vh;font-size:14px; letter-spacing:1px;">
                                                                    You can visit any day this week to get the tests done.<br>
                                                                    General lab visiting timings: 10am to 4pm
                                                                </div>
                                                                <a href="?action=drop-tests" style="text-decoration: none;">
                                                                    <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                        <font class="tn-in-text">Cancel Booking</font>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }
                                            for ($x = 0; $x < ($result->num_rows); $x++) {
                                                echo '<tr>';
                                                for ($q = 0; $q < 2; $q++) {
                                                    $row = $result->fetch_assoc();
                                                    if (!isset($row)) {
                                                        break;
                                                    };
                                                    $scheduleid = $row["scheduleid"];
                                                    $title = $row["title"];
                                                    $docname = $row["docname"];
                                                    $scheduledate = $row["scheduledate"];
                                                    $twentyfourHourtime = $row["scheduletime"];
                                                    $mode = $row["mode"];
                                                    $apponum = $row["apponum"];
                                                    if ($mode == 'Video Consultancy') {
                                                        $timestamp = strtotime($twentyfourHourtime);
                                                        $updatedTimestamp = $timestamp + (10 * 60 * ($apponum - 1));
                                                        $scheduletime = date("h:i A", $updatedTimestamp);
                                                    } else
                                                        $scheduletime = date("h:i A", strtotime($twentyfourHourtime));
                                                    $appodate = $row["appodate"];
                                                    $appoid = $row["appoid"];
                                                    $roomid = $row['roomid'];

                                                    if ($scheduleid == "") {
                                                        break;
                                                    }

                                                ?>
                                                    <td style="width: 25%;">
                                                        <div class="dashboard-items search-items">
                                                            <div style="width:100%;">
                                                                <div style="display: flex; flex-direction:row; justify-content:space-between;">
                                                                    <div class="h1-search" style="display:flex; flex-direction:row; align-items:center; justify-content:center; font-size:17px; color:#006dd3; padding:5px 0 10px 0; letter-spacing:.5px;">
                                                                        <div><?php echo substr($title, 0, 30) ?></div>&nbsp;
                                                                        <div class="h3-search" style="color:#000; font-size:14px; margin-top:0;"> - <?php echo substr($mode, 0, 30) ?></div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="h3-search" style="font-size: 12px; display:flex; flex-direction:row; align-items:center; justify-content:flex-end;">
                                                                            Booking Date: &nbsp;<b><?php echo substr($appodate, 0, 30) ?></b></div>
                                                                        <div class="h3-search" style="font-size: 12px; display:flex; flex-direction:row; align-items:center; justify-content:flex-end;">
                                                                            Ref. Number: <b><?php if ($mode == "Hospital Visit") {
                                                                                                echo '&nbsp;DC-000-' . $appoid;
                                                                                            } else {
                                                                                                echo '&nbsp;VC-000-' . $appoid;
                                                                                            } ?></b>
                                                                        </div>
                                                                    </div>
                                                                </div><br>
                                                                <div class="h3-search" style="display:flex; flex-direction:row; align-items:center;">
                                                                    <w>Appointment Number: &nbsp;</w>
                                                                    <w><b style=" padding:0 0 0 0">0<?php echo $apponum ?></b></w>
                                                                </div>
                                                                <div class="h3-search" style="font-size:15px">
                                                                    Doctor Name: <b><?php echo substr($docname, 0, 30) ?></b>
                                                                </div>
                                                                <div class="h3-search" style="font-size:15px">
                                                                    Scheduled Date: <b><?php echo $scheduledate ?></b>
                                                                </div>
                                                                <div class="h3-search" style="font-size:15px">Starts: <b>@<?php echo substr($scheduletime, 0, 8) ?></b>
                                                                </div>
                                                                <br>
                                                                <div class="h3-search" style="text-align: center; margin-bottom:2vh;font-size:14px">
                                                                    <?php
                                                                    if ($mode == "Video Consultancy") {
                                                                        if ($roomid == NULL) { ?>
                                                                            Meeting link will be shared 2 hours before the scheduled time!
                                                                    <?php
                                                                        } else {
                                                                            echo '&nbsp;';
                                                                        }
                                                                    } else {
                                                                        echo '&nbsp;';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <?php
                                                                if ($mode == "Video Consultancy") {
                                                                    if ($roomid == NULL) { ?>
                                                                        <a href="?action=drop&id=<?php echo $appoid ?>&title=<?php echo $title ?>&doc=<?php echo $docname ?>&mode=<?php echo $mode ?>">
                                                                            <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                                <font class="tn-in-text">Cancel Booking</font>
                                                                            </button>
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <div style="display: flex; flex-direction:row; justify-content:space-around">
                                                                            <a href="?action=drop&id=<?php echo $appoid ?>&title=<?php echo $title ?>&doc=<?php echo $docname ?>&mode=<?php echo $mode ?>">
                                                                                <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                                    <font class="tn-in-text">Cancel Booking</font>
                                                                                </button>
                                                                            </a>
                                                                            <a href='https://peercalls.com/call/<?php echo $roomid ?>' target="_blank">
                                                                                <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                                    <font class="tn-in-text">Join Meeting</font>
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    <?php    }
                                                                } else { ?>
                                                                    <a href="?action=drop&id=<?php echo $appoid ?>&title=<?php echo $title ?>&doc=<?php echo $docname ?>&mode=<?php echo $mode ?>">
                                                                        <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                            <font class="tn-in-text">Cancel Booking</font>
                                                                        </button>
                                                                    </a>
                                                                <?php   } ?>

                                                            </div>

                                                        </div>
                                                    </td>
                                        <?php
                                                }
                                                echo "</tr>";
                                            }
                                        }


                                        ?>

                                    </tbody>

                                </table>
                            </div>
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
        if ($action == 'booking-added') {

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Booking Successfully.</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                        Your Appointment number is ' . $id . '.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'drop') {
            $title = $_GET["title"];
            $docname = $_GET["doc"];
            $modee = $_GET["mode"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            You want to Cancel this Appointment?<br>
                            <red style = "color:red; font-size:13px">No Refund will be initiated! </red><br><br>
                            Session Name : &nbsp;<b>' . substr($title, 0, 40) . '</b> - ' . substr($modee, 0, 40) . '<br>
                            Doctor name&nbsp; : <b>' . substr($docname, 0, 40) . '</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'removed-test') {
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="margin-top:33vh;">
                    <center>
                        <h2>Your booking has been successfully cancelled!</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                        Corresponding amount has been credited to your wallet.<br>
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Ok&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view-tests') {
    ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <a class="close" href="appointment.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                            <div class="sub-table scrolldown add-doc-form-container view-tests" border="0">
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Booked Medical Tests.</p><br><br>
                                    </td>
                                </tr>
                                <?php
                                $test_result = $database->query("SELECT * FROM test_booking INNER JOIN medical_test ON medical_test.mtid= test_booking.mtid WHERE pid = '$userid' and `status` = 0 ORDER BY tname ASC");
                                for ($x = 1; $x < ($test_result->num_rows + 1); $x++) {
                                    $test_row = $test_result->fetch_assoc(); ?>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <p class="form-label"><?php echo "$x ) " . $test_row['tname'] ?></p>
                                        </td>
                                    </tr>
                                <?php    }
                                ?>

                            </div>
                        </div>
                    </center>
                </div>
            </div>
        <?php    } elseif ($action == 'drop-tests') {
        ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <form method="post" action="cancel_tests.php"> <!-- Assuming 'cancel_tests.php' is the page that handles test cancellations -->
                            <a class="close" href="appointment.php">&times;</a>
                            <div style="display: flex; justify-content: center;">
                                <div class="sub-table scrolldown add-doc-form-container view-tests" border="0">
                                    <table>
                                        <tr>
                                            <td colspan="2">
                                                <p style="padding: 0; margin: 0; text-align: left; font-size: 25px; font-weight: 500;">Booked Medical Tests.</p><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <div class="content" style="text-align: center; font-weight:500; font-size:15px;">
                                                Your Test fee will be refunded.<br>
                                                <red style="color:red; font-size:13px;font-weight:400;">Note: Your refund will refelct into your wallet not your bank account</red>
                                            </div>
                                            <br>
                                            <?php
                                            $test_result = $database->query("SELECT * FROM test_booking INNER JOIN medical_test ON medical_test.mtid = test_booking.mtid WHERE pid = '$userid' AND `status` = 0");
                                            for ($x = 0; $x < ($test_result->num_rows); $x++) {
                                                $test_row = $test_result->fetch_assoc(); ?>
                                        <tr>
                                            <td class="label-td">
                                                <label class="checkbox-container">
                                                    <input type="checkbox" name="selected_tests[]" value="<?php echo $test_row['mtid']; ?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="label-td flex-row" style="width: 170%;">
                                                <p class="form-label"><?php echo $test_row['tname'] ?></p>
                                                <p style="margin-left: auto;" class="form-label"><?php echo '₹' . $test_row['price'] ?></p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <button id="cancelButton" class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px; margin-top:10px; pointer-events: none; opacity: .7;" type="submit">Cancel Selected Tests</button>
                        </form>
                    </center>
                </div>
            </div>

    <?php    }
    }

    ?>
    </div>

</body>
<script>
    const cancelButton = document.getElementById('cancelButton');
    const checkboxes = document.querySelectorAll('input[name="selected_tests[]"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const atLeastOneChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

            // Toggle cursor and appearance based on checkbox selection
            if (atLeastOneChecked) {
                cancelButton.style.pointerEvents = "auto";
                cancelButton.style.opacity = "1";
            } else {
                cancelButton.style.pointerEvents = "none";
                cancelButton.style.opacity = ".7";
            }
        });
    });
</script>

</html>