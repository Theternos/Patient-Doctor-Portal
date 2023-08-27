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

    $sqlmain .= " order by appointment.appodate asc";
    $result = $database->query($sqlmain);
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
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
        <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
            <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
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
        <td class="menu-btn menu-icon-assistant">
            <a href="assistant.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Assistant</p>
            </a></div>
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
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">My Bookings history</p>

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

                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Bookings (<?php echo $result->num_rows; ?>)</p>
                </td>

            </tr>
            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0">
                            <tr>
                                <td width="10%">

                                </td>
                                <td width="5%" style="text-align: center;">
                                    Date:
                                </td>
                                <td width="30%">
                                    <form action="" method="post">

                                        <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                                </td>

                                <td width="12%">
                                    <input type="submit" name="filter" value=" Filter" class=" btn-primary-soft btn button-icon btn-filter" style="padding: 15px; margin :0;width:100%">
                                    </form>
                                </td>

                            </tr>
                        </table>

                    </center>
                </td>

            </tr>



            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0" style="border:none">

                                <tbody>

                                    <?php
                                    if ($result->num_rows == 0) {
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
                                        for ($x = 0; $x < ($result->num_rows); $x++) {
                                            echo "<tr>";
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
                                                $scheduletime = date("h:i A", strtotime($twentyfourHourtime));
                                                $apponum = $row["apponum"];
                                                $appodate = $row["appodate"];
                                                $appoid = $row["appoid"];
                                                $mode = $row["mode"];
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
        } elseif ($action == 'view') {
            $sqlmain = "select * from doctor where docid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $name = $row["docname"];
            $email = $row["docemail"];
            $spe = $row["specialties"];

            $sqlmain = "select sname from specialties where id=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("s", $spe);
            $stmt->execute();
            $spcil_res = $stmt->get_result();
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["sname"];
            $nic = $row['docnic'];
            $tele = $row['doctel'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            eDoc Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $email . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIC: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $nic . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialties: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $spcil_name . '<br><br>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }
    }

    ?>
    </div>

</body>

</html>