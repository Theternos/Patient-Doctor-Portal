<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Sessions</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
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
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];
    $phone_number = $userfetch["ptel"];


    date_default_timezone_set('Asia/Kolkata');

    $today = date('Y-m-d');


    if ($_GET) {
        $id = $_GET['id'];
        $payment_id = $_GET['payment_id'];
        setcookie("id", $id, time() + (60 * 5), "/"); // 60 = 1 minute
        $urlid = $_COOKIE['id'];
        if ($payment_id !== NULL) {
            $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduleid=? order by schedule.scheduledate desc";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $urlid);
            $stmt->execute();
            $result = $stmt->get_result();
            //echo $sqlmain;
            $row = $result->fetch_assoc();
            $scheduleid = $row["scheduleid"];
            $title = $row["title"];
            $docname = $row["docname"];
            $docemail = $row["docemail"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];
            $sql2 = "select * from appointment where scheduleid=$urlid";
            //echo $sql2;
            $result12 = $database->query($sql2);
            $apponum = ($result12->num_rows) + 1;
            $command = "python ../python/sms_confirmation.py " . escapeshellarg($docname) . "  " . escapeshellarg($scheduledate) . " " . escapeshellarg($scheduletime) . " " . escapeshellarg($phone_number)  . " " . escapeshellarg($apponum);
            $output = shell_exec($command);
            // echo $command;
            $sql2 = "insert into appointment(pid,apponum,scheduleid,appodate) values ($userid,$apponum,$scheduleid,'$date')";
            $result = $database->query($sql2);

            header("location: appointment.php?action=booking-added&id=" . $apponum . "&titleget=none");
        }
    }
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
        <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
            <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active">
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
            </a></div>
        </td>
    </tr>
    </table>
    </div>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <form action="schedule.php" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="doctors">';
                        $list11 = $database->query("select DISTINCT * from  doctor;");
                        $list12 = $database->query("select DISTINCT * from  schedule GROUP BY title;");





                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["docname"];

                            echo "<option value='$d'><br/>";
                        };


                        for ($y = 0; $y < $list12->num_rows; $y++) {
                            $row00 = $list12->fetch_assoc();
                            $d = $row00["title"];

                            echo "<option value='$d'><br/>";
                        };

                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                    </form>
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
                    <!-- <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49);font-weight:400;">Scheduled Sessions / Booking / <b>Review Booking</b></p> -->

                </td>

            </tr>



            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">

                                <tbody>

                                    <?php

                                    if (($_GET)) {


                                        if (isset($_GET["id"])) {


                                            $id = $_GET["id"];

                                            $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduleid=? order by schedule.scheduledate desc";
                                            $stmt = $database->prepare($sqlmain);
                                            $stmt->bind_param("i", $id);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            //echo $sqlmain;
                                            $row = $result->fetch_assoc();
                                            $scheduleid = $row["scheduleid"];
                                            $title = $row["title"];
                                            $docname = $row["docname"];
                                            $docemail = $row["docemail"];
                                            $scheduledate = $row["scheduledate"];
                                            $scheduletime = $row["scheduletime"];
                                            $sql2 = "select * from appointment where scheduleid=$id";
                                            //echo $sql2;
                                            $result12 = $database->query($sql2);
                                            $apponum = ($result12->num_rows) + 1;


                                            echo '
                                        <td style="width: 50%;" rowspan="2">
                                            <div  class="dashboard-items search-items"  >
                                                <div style="width:100">
                                                    <div class="h1-search" style="font-size:25px;">
                                                        Session Details
                                                    </div><br>
                                                    <div class="h3-search" style="font-size:18px;line-height:30px">
                                                        Doctor name:  &nbsp;&nbsp;<b>' . $docname . '</b><br>
                                                        Doctor Email:  &nbsp;&nbsp;<b>' . $docemail . '</b> 
                                                    </div>
                                                    <div class="h3-search" style="font-size:18px;">
                                                        
                                                    </div><br>
                                                    <div class="h3-search" style="font-size:18px;">
                                                        Session Title: ' . $title . '<br>
                                                        Session Scheduled Date: ' . $scheduledate . '<br>
                                                        Session Starts : ' . $scheduletime . '<br>
                                                        Booking fee : <b>INR. 100 </b><black style= "color:#000; font-size:13px">[</black><red style= "color:red; font-size:13px"> Non-refundable </red><black style= "color:#000; font-size:13px">]</black>
                                                    </div>
                                                        <br>  
                                                </div>      
                                            </div>
                                        </td>
                                        
                                        <td style="width: 25%;">
                                            <div  class="dashboard-items search-items"  >
                                                <div style="width:100%;padding-top: 15px;padding-bottom: 15px;">
                                                        <div class="h1-search" style="font-size:20px;line-height: 35px;margin-left:8px;text-align:center;">
                                                            Your Appointment Number
                                                        </div>
                                                        <center>
                                                        <div class=" dashboard-icons" style="margin-left: 0px;width:90%;font-size:70px;font-weight:800;text-align:center;color:var(--btnnictext);background-color: var(--btnice)">' . $apponum . '</div>
                                                    </center>
                                                       
                                                        </div><br>
                                                        
                                                        <br>
                                                        <br>
                                                </div>
                                                        
                                            </div>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <form style="margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:100%;text-align: center;">
                                                <script src="../js/payment-button.js" data-payment_button_id="pl_MQciFl4IXO0PBg" async> </script> </form>
                                            </td>
                                        </tr>
                                        ';
                                        }
                                    } else { ?>
                                        <td style="width: 50%;" rowspan="2">
                                            <div class="dashboard-items search-items">
                                                <div style="width:100%; margin-top:0">
                                                    <div class="h3-search" style="font-size:18px;line-height:30px">
                                                        <center>
                                                            <br><br>
                                                            <img src="../img/notfound.svg" width="25%">
                                                            <br><br>
                                                            <p class="heading-main12" style="margin-left: 30px;font-size:20px;color:rgb(49, 49, 49)">No Schedule found !</p>
                                                            <a class="non-style-link" href="schedule.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Check Again! &nbsp;</font></button>
                                                            </a>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </td> <?php
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
    </div>

</body>


</html>