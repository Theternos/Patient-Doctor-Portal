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
    <?php
    include("./config.php");
    ?>
    <title><?php echo $lang['appointments-title'] ?></title>
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
                                    <a href="../logout.php"><input type="button" value="<?php echo $lang['logout'] ?>" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text"><?php echo $lang['home'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['alldoctors'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-session">
                        <a href="specialities.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['bookappoinments'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
                        <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text"><?php echo $lang['mybookings'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-recent">
                        <a href="recent.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['recentconsultancy'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-test">
                        <a href="recent_tests.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['analysishistory'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-payment">
                        <a href="payment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['payments'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['settings'] ?></p>
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
                        <a href="index.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:fit-content">
                                <font class="tn-in-text"><?php echo $lang['ddback'] ?></font>
                            </button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;"><?php echo $lang['my-bookings-history'] ?></p>

                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            <?php echo $lang['tddate'] ?>
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            echo $today;
                            ?>
                        </p>
                    </td>
                    <td width="7%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                    <td width="8.5%">
                        <div class="language-select" style="width: 70px;margin-right:30px">
                            <form action="donor_register.php" method="post">
                                <select name="language" id="language" style="font-size:13px">
                                    <option value="en"><?php echo $_SESSION['lang'] ?></option>
                                    <option value="en">English</option>
                                    <option value="tm">தமிழ்</option>
                                    <option value="ka">ಕನ್ನಡ</option>
                                    <option value="ml">മലയാളം</option>
                                    <option value="te">తెలుగు</option>
                                    <option value="hi">हिंदी</option>
                                </select><br>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <?php if ($test_result->num_rows > 0) { ?>
                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $lang['my-bookings'] ?> (<?php echo $result->num_rows + 1 ?>)</p>
                        <?php } else { ?>
                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $lang['my-bookings'] ?> (<?php echo $result->num_rows ?>)</p>
                        <?php } ?>
                    </td>
                </tr>
                <tr width="120%">
                    <td colspan="5">
                        <center>
                            <div class="abc scroll">
                                <table width="100%" class="sub-table scrolldown" border="0" style="border:none">
                                    <tbody>

                                        <?php
                                        if ($result->num_rows == 0 and $test_result->num_rows == 0) {
                                            echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">' . $lang["noresults-disclaimer"] . '</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; ' . $lang["show-all-appointments"] . ' &nbsp;</font></button>
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
                                                    <div style="width: 100%;">
                                                        <div class="dashboard-items search-items">
                                                            <div style="width:100%;">
                                                                <div style="display: flex; flex-direction:row; justify-content:space-between;">
                                                                    <div class="h1-search" style="display:flex; flex-direction:row; align-items:center; justify-content:center; font-size:17px; color:#006dd3; padding:5px 0 10px 0; letter-spacing:.5px;">
                                                                        <div>
                                                                            <?php echo $lang['medical-tests'] ?>
                                                                        </div>&nbsp;
                                                                        <a href="?action=view-tests" style="text-decoration: none;">
                                                                            <div class="h3-search flex-row tests-view" style=" color:#000; font-size:14px; margin-top:0;"> -
                                                                                <?php echo $test_result->num_rows . '&nbsp;' . $lang["tests"] ?>
                                                                                <img src="../img/down-arrow.svg" alt="Arrow Icon" width="15px" style="margin-left: 5px;">
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div>
                                                                        <div class=" h3-search" style="font-size: 12px; display:flex; flex-direction:row; align-items:center; justify-content:flex-end;">
                                                                            <?php echo $lang['booking-date'] ?> &nbsp;<b><?php echo substr($booked_time, 0, 10) ?></b></div>
                                                                        <div class="h3-search" style="font-size: 12px; display:flex; flex-direction:row; align-items:center; justify-content:flex-end;">
                                                                            <?php echo $lang['ref-number'] ?> <b><?php echo '&nbsp;MT-0' . $start_number . '-0' . $end_number ?></b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="h3-search" style="text-align: center; margin-bottom:2vh;font-size:14px; letter-spacing:1px;">
                                                                    <?php echo $lang['booking-prompt'] ?>
                                                                </div>
                                                                <a href="?action=drop-tests" style="text-decoration: none;">
                                                                    <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                        <font class="tn-in-text"><?php echo $lang['cancel-booking'] ?></font>
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
                                                    <div class="dashboard-items search-items" style="padding-left: 20px;">
                                                        <div style="width:100%;">
                                                            <div style="display: flex; flex-direction:row; justify-content:space-between;">
                                                                <div class="h1-search" style="display:flex; flex-direction:row; align-items:center; justify-content:center; font-size:17px; color:#006dd3; padding:5px 0 10px 0; letter-spacing:.5px;">
                                                                    <div><?php echo substr($lang[$title], 0, 30) ?></div>&nbsp;
                                                                    <div class="h3-search" style="color:#000; font-size:14px; margin-top:0;"> - <?php
                                                                                                                                                if ($mode == "Hospital Visit") {
                                                                                                                                                    echo $lang['hospital-visit'];
                                                                                                                                                } else {
                                                                                                                                                    echo $lang['video-conf'];
                                                                                                                                                } ?></div>
                                                                </div>
                                                                <div>
                                                                    <div class="h3-search" style="font-size: 12px; display:flex; flex-direction:row; align-items:center; justify-content:flex-end;">
                                                                        <?php echo $lang['booking-date'] ?> &nbsp;<b><?php echo substr($appodate, 0, 30) ?></b></div>
                                                                    <div class="h3-search" style="font-size: 12px; display:flex; flex-direction:row; align-items:center; justify-content:flex-end;">
                                                                        <?php echo $lang['ref-number'] ?> <b><?php if ($mode == "Hospital Visit") {
                                                                                                                    echo '&nbsp;DC-000-' . $appoid;
                                                                                                                } else {
                                                                                                                    echo '&nbsp;VC-000-' . $appoid;
                                                                                                                } ?></b>
                                                                    </div>
                                                                </div>
                                                            </div><br>
                                                            <div class="h3-search" style="display:flex; flex-direction:row; align-items:center;">
                                                                <w><?php echo $lang['appointment-number'] ?>: &nbsp;</w>
                                                                <w><b style=" padding:0 0 0 0">0<?php echo $apponum ?></b></w>
                                                            </div>
                                                            <div class="flex-column">
                                                                <div class="h3-search" style="font-size:15px;text-align:left">
                                                                    <?php echo $lang['doctor-name'] ?> <b><?php echo substr($docname, 0, 30) ?></b>
                                                                </div>
                                                                <div class="h3-search" style="font-size:15px;text-align:left">
                                                                    <?php echo $lang['scheduled-date'] ?> <b><?php echo $scheduledate ?></b>
                                                                </div>
                                                                <div class="h3-search" style="font-size:15px;text-align:left"><?php echo $lang['starts'] ?>: <b>@<?php echo substr($scheduletime, 0, 8) ?></b>
                                                                </div>
                                                                <br>
                                                                <div class="h3-search" style="text-align: center; margin-bottom:2vh;font-size:14px">
                                                                    <?php
                                                                    if ($mode == "Video Consultancy") {
                                                                        if ($roomid == NULL) { ?>
                                                                            <?php echo $lang['meetlink-two-hours'] ?>
                                                                    <?php
                                                                        } else {
                                                                            echo '&nbsp;';
                                                                        }
                                                                    } else {
                                                                        echo '&nbsp;';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            if ($mode == "Video Consultancy") {
                                                                if ($roomid == NULL) { ?>
                                                                    <a href="?action=drop&id=<?php echo $appoid ?>&title=<?php echo $title ?>&doc=<?php echo $docname ?>&mode=<?php echo $mode ?>">
                                                                        <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                            <font class="tn-in-text"><?php echo $lang['cancel-booking'] ?></font>
                                                                        </button>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <div style="display: flex; flex-direction:row; justify-content:space-around">
                                                                        <a href="?action=drop&id=<?php echo $appoid ?>&title=<?php echo $title ?>&doc=<?php echo $docname ?>&mode=<?php echo $mode ?>">
                                                                            <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                                <font class="tn-in-text"><?php echo $lang['cancel-booking'] ?></font>
                                                                            </button>
                                                                        </a>
                                                                        <a href='https://peercalls.com/call/<?php echo $roomid ?>' target="_blank">
                                                                            <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                                <font class="tn-in-text"><?php echo $lang['join-meeting'] ?></font>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                <?php    }
                                                            } else { ?>
                                                                <a href="?action=drop&id=<?php echo $appoid ?>&title=<?php echo $title ?>&doc=<?php echo $docname ?>&mode=<?php echo $mode ?>">
                                                                    <button class="login-btn btn-primary-soft btn " style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                        <font class="tn-in-text"><?php echo $lang['cancel-booking'] ?></font>
                                                                    </button>
                                                                </a>
                                                            <?php   } ?>

                                                        </div>

                                                    </div>
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
                        <h2>' . $lang['booked-success-popup'] . '.</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                        ' . $lang["appointment-number"] . ' ' . $id . '.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['ok'] . '&nbsp;&nbsp;</font></button></a>
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
            if ($mode == "Hospital Visit") {
                $mode1 =  $lang['hospital-visit'];
            } else {
                $mode1 = $lang['video-conf'];
            }
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>' . $lang["sure-confirmation"] . '</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            ' . $lang["cancel-appoint-ques"] . '<br>
                            <red style = "color:red; font-size:13px">' . $lang["refund-policy"] . ' </red><br><br>
                            ' . $lang['session-name'] . ' &nbsp;<b>' . substr($lang[$title], 0, 40) . '</b> - ' . substr($mode1, 0, 40) . '<br>
                            ' . $lang['dispdename'] . '&nbsp; : <b>' . substr($docname, 0, 40) . '</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;' . $lang['yes'] . '&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['no'] . '&nbsp;&nbsp;</font></button></a>

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
                        <h2>' . $lang['booking-cancelled-popup'] . '</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                        ' . $lang["amount-refunded"] . '<br>
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;' . $lang['ok'] . '&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;

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
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;"><?php echo $lang['booked-medical-tests'] ?></p><br><br>
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
                                                <p style="padding: 0; margin: 0; text-align: left; font-size: 25px; font-weight: 500;"><?php echo $lang['booked-medical-tests'] ?></p><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <div class="content" style="text-align: center; font-weight:500; font-size:15px;">
                                                <?php echo $lang['test-willbe-refunded'] ?><br>
                                                <red style="color:red; font-size:13px;font-weight:400;"><?php echo $lang['note-refund'] ?></red>
                                            </div>
                                        </tr>
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
                                                <?php if ($_SESSION['lang'] == "en") { ?>
                                                    <td class="label-td flex-row" style="width: 170%;">
                                                    <?php } else { ?>
                                                    <td class="label-td flex-row" style="width: 100%;">
                                                    <?php } ?>
                                                    <p class="form-label"><?php echo $test_row['tname'] ?></p>
                                                    <p style="margin-left: auto;" class="form-label"><?php echo '₹' . $test_row['price'] ?></p>
                                                    </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <button id="cancelButton" class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px; margin-top:10px; pointer-events: none; opacity: .7;" type="submit"><?php echo $lang['cancel-selected-seats'] ?></button>
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
<script>
    // Get a reference to the language dropdown
    const languageDropdown = document.getElementById("language");

    // Add an event listener to the dropdown
    languageDropdown.addEventListener("change", function() {
        // Get the selected language code
        const selectedLanguage = this.value;

        // Get the current URL
        const currentURL = "./appointment.php"

        // Check if there's already a query string in the URL
        const separator = currentURL.includes("?") ? "&" : "?";

        // Construct the new URL with the selected language
        const newURL = currentURL + separator + "lang=" + selectedLanguage;

        // Redirect to the new URL
        window.location.href = newURL;
    });
</script>

</html>