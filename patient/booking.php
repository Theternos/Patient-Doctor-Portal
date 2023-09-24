<!DOCTYPE html>
<html lang="en">
<script>
    const apiKey = ''; // The Razor API key must me included here
</script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <script src="../js/checkout.js"></script>
    <?php include("./config.php") ?>
    <title><?php echo $lang['bsessions'] ?></title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .pop-up {
            position: relative;
            width: 110px;
            left: -20%;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1;
            display: none;
        }

        .time_slot:hover .pop-up {
            display: block;
        }

        .time_slot {
            cursor: pointer;
            border: 1px solid transparent;
        }

        .time_slot.selected {
            border-color: #1e40a0;
            transform: scale(1.03);
        }

        #payButton {
            pointer-events: none;
            opacity: .7;
        }

        /* Style for checkboxes */
        .checkbox-container {
            display: inline-block;
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 2.5vh;
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

        .billing-disclaimer {
            background-color: #4ecdc440;
            color: #292D32;
            padding: 1px 15px 0 20px;
            margin: 3vh 0 2vh 0 !important;
            font-size: 14px;
            letter-spacing: 1px;
            border-radius: 5px;
            height: 20vh;
            text-align: left;
        }

        .billing-disclaimer h6 {
            font-size: 13px;
            margin-left: 5px;
        }

        .billing-disclaimer p {
            margin-left: 30px;
            margin-top: 0;
        }


        .bill-details h5 {
            font-family: 'Josefin Sans', sans-serif;
            letter-spacing: 1px;
            text-align: left;
            font-size: 18px;
            color: #202020;
        }

        .bill-details p {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            letter-spacing: 1px;
        }

        .bill-details {
            width: 23vw;
            height: 70vh;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0px 20px 10px 20px;
            margin-left: auto;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com


    date_default_timezone_set('UTC');

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
    setcookie('checkboxState', 0, time() + (3600), "/"); // 3600 = 1 hr


    date_default_timezone_set('Asia/Kolkata');

    $today = date('Y-m-d');


    if ($_GET) {
        $payment_id = $_GET['payment_id'];
        $urlid = $_COOKIE['id'];
        if ($payment_id !== NULL) {
            $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduleid=? order by schedule.scheduledate desc";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $urlid);
            $stmt->execute();
            $result = $stmt->get_result();
            echo $sqlmain;
            $row = $result->fetch_assoc();
            $scheduleid = $row["scheduleid"];
            $title = $row["title"];
            $docname = $row["docname"];
            $docemail = $row["docemail"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];
            $mode_result = $database->query("SELECT mode from schedule where scheduleid='$scheduleid'");
            $mode_row = $mode_result->fetch_assoc();
            $mode = $mode_row['mode'];
            if ($mode == 'Video Consultancy') {
                $price = 250;
            } else {
                $price = 100;
            }
            $org_price = $price;
            $sql2 = "select * from appointment where scheduleid=$urlid";
            //echo $sql2;
            $result12 = $database->query($sql2);
            $apponum = ($result12->num_rows) + 1;
            if (!isset($_COOKIE['insert_flag'])) {
                $command = "python ../python/sms_confirmation.py " . escapeshellarg($docname) . "  " . escapeshellarg($scheduledate) . " " . escapeshellarg($scheduletime) . " " . escapeshellarg($phone_number)  . " " . escapeshellarg($apponum);
                $output = shell_exec($command);
                // echo $command . '<br>';
                $sql2 = "INSERT into appointment(pid,apponum,scheduleid,appodate, payment_id) values ($userid,$apponum,$scheduleid,'$today', '$payment_id')";
                $result = $database->query($sql2);
                // echo $sql2 . '<br>';
                $appo_result = $database->query("SELECT appoid from appointment where scheduleid='$scheduleid' and pid = '$userid' and payment_id='$payment_id'");
                $appo_row = $appo_result->fetch_assoc();
                $appoid = $appo_row['appoid'];
                setcookie('insert_flag', '1', time() + (10), "/");
    ?>
                <span id="balance">
                    <?php
                    // echo $_COOKIE['checkboxState'] . '<br>';
                    $toggle = $_COOKIE['checkboxState'];
                    $balance = 0;
                    if ($toggle == 1) {
                        $result34 = $database->query("SELECT balance from wallet WHERE pid = '$userid'");
                        $row34 = $result34->fetch_assoc();
                        $balance = $row34['balance'];
                        $price  -= $balance;
                        $discount = ($price / 100) * 2.5;
                    } else
                        $discount = ($price / 100) * 2.5;
                    $result45 = $database->query("SELECT balance from wallet WHERE pid = '$userid'");
                    $row45 = $result45->fetch_assoc();
                    $fetch_balance = $row45['balance'];
                    $price  -= $fetch_balance;
                    $org_balance = $fetch_balance - ($org_price - $price);
                    $insert_balance = $org_balance + $discount;
                    ?>
                </span>
        <?php
                $database->query("UPDATE wallet SET balance = '$insert_balance', bonus = bonus + '$discount' WHERE pid = '$userid'");
                $database->query("INSERT INTO payment_history (pid, appoid, discount, amount, title, payment_id, total_paid) VALUES ('$userid', '$appoid', '$fetch_balance', '$price', '$title','$payment_id', '$price')");
                // echo "INSERT INTO payment_history (pid, appoid, discount, amount, title, payment_id, total_paid) VALUES ('$userid', '$appoid', '$fetch_balance', '$price', '$title','$payment_id', '$price')" . "<br>";
            }
        } ?>
        <script>
            window.location.href = "appointment.php?action=booking-added&id=<?php echo $apponum ?>&titleget=none";
        </script>
    <?php
        header("location : appointment.php?action=booking-added&id=.$apponum.&titleget=none");
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
                                    <a href="../logout.php"><input type="button" value=<?php echo $lang['logout'] ?> class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text"><?php echo $lang['bhome'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['ball-doctors'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>

                <tr class="menu-row">
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="specialities.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text"><?php echo $lang['bbook-appointment'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['bmy-booking'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-recent">
                        <a href="recent.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['brecent-consultancy'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-test">
                        <a href="recent_tests.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['banalysis'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-payment">
                        <a href="payment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['bpayments'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['bsettings'] ?></p>
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
                        <a href="specialities.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text"><?php echo $lang['bback'] ?></font>
                            </button></a>
                    </td>
                    <td>
                        <form action="schedule.php" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="<?php echo $lang['bbodentry'] ?>" list="doctors">&nbsp;&nbsp;

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


                            <input type="Submit" value="<?php echo $lang['bsearch'] ?>" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            <?php echo $lang['btodaysdate'] ?>
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
                    <td colspan="4">
                        <center>
                            <div class="">
                                <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submitButton'])) {
                                            $mode = $_POST['modeSelect'];
                                            $id = $_POST['scheduleid'];
                                            $docid = $_POST['docid'];
                                            $sqlmain1 = "SELECT * FROM doctor INNER JOIN `schedule` on doctor.docid = `schedule`.docid WHERE `schedule`.title = (SELECT sname from specialties where id = '$id') and doctor.docid = '$docid' and `schedule`.scheduledate >= '$today';";
                                            $result = $database->query($sqlmain1);
                                            //echo $sqlmain;
                                            $row = $result->fetch_assoc();
                                            $title = $row["title"];
                                            $docname = $row["docname"];
                                            $docemail = $row["docemail"];
                                            $docnic = $row["docnic"];
                                            $sql2 = "select * from appointment where scheduleid=$id";
                                            //echo $sql2;
                                            $result12 = $database->query($sql2);
                                            $apponum = ($result12->num_rows) + 1;
                                            $schedule_sql = "select * from schedule where docid='$docid' and schedule.scheduledate >= '$today'";
                                            //echo $sql2;
                                            $schedule_result = $database->query($schedule_sql);
                                            if ($mode == 'Video Consultancy') {
                                                $mode1 = $lang['hpvc'];
                                            } else {
                                                $mode1 = $lang['hpv'];
                                            }
                                        ?>
                                            <td style="width: 50%;" rowspan="2">
                                                <div class="dashboard-items search-items" style="width: 45vw; min-height:fit-content; max-height:70vh">
                                                    <div style="width:100">
                                                        <div class="h1-search" style="font-size:25px;display: flex; flex-direction:row; align-items:center">
                                                            <div><?php echo $lang[$title] ?></div>
                                                            <div style="font-size: 15px; color:#6a6a6a; font-weight:500;">&nbsp;[<?php echo  substr($mode1, 0, 40) ?>]</div>
                                                        </div>
                                                        <div class="h3-search" style="font-size:16px;line-height:30px">
                                                            <?php echo $lang['bdoctor-name'] ?>&nbsp;&nbsp;<b><?php echo $docname ?></b><br>
                                                            <?php echo $lang['bdoctor-email'] ?>&nbsp;&nbsp;<b><?php echo $docemail ?></b><br>
                                                            <?php
                                                            if ($mode == 'Video Consultancy') {
                                                                echo '' . $lang["bconsultfee"] . '';
                                                            } else {
                                                                echo '' . $lang["bbookingfee"] . '';
                                                            } ?>&nbsp;
                                                            <black style=" color:#000; font-size:13px">[</black>
                                                            <red style="color:red; font-size:13px"><?php echo $lang['bnon-refundable'] ?></red>
                                                            <black style="color:#000; font-size:13px">]</black>
                                                            <div>
                                                                <?php
                                                                $sql = "SELECT scheduledate, scheduletime FROM schedule where docid = '$docid' and scheduledate >= '$today'";
                                                                $result = $database->query($sql);

                                                                // Create an associative array to store schedule times by date
                                                                $scheduleByDate = array();
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $scheduleByDate[$row['scheduledate']][] = $row['scheduletime'];
                                                                }
                                                                ?>
                                                                <form method="POST" action="">
                                                                    <input type="hidden" name="selected_time" id="selected_time_input">
                                                                    <table class="slot_booking">
                                                                        <tr>
                                                                            <?php
                                                                            $days = array($lang['btoday'],  $lang['btomorrow'], "&nbsp;", "&nbsp;", "&nbsp;");
                                                                            date_default_timezone_set("Asia/Kolkata");

                                                                            for ($i = 0; $i < 5; $i++) {
                                                                                $timestamp = strtotime("+$i days"); // Calculate the timestamp for the current day + $i days
                                                                                $dayName = date("l", $timestamp);
                                                                                $date = date("Y-m-d", $timestamp);
                                                                            ?>
                                                                                <th>
                                                                                    <div class="date_day_detail">
                                                                                        <p class="small_p"><?php echo $days[$i]; ?></p>
                                                                                        <p class="day_p"><?php echo $dayName; ?></p>
                                                                                        <p class="small_p"><?php echo $date; ?></p>
                                                                                    </div>
                                                                                </th>
                                                                            <?php } ?>
                                                                        </tr>
                                                                        <?php
                                                                        $sql = "SELECT scheduledate, scheduletime FROM schedule WHERE docid = '$docid' AND title = '$title' AND `mode` = '$mode' AND scheduledate >= '$today'";
                                                                        $result = $database->query($sql);

                                                                        // Create an associative array to store schedule times by date
                                                                        $scheduleByDate = array();
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $twentyfourHourtime = $row["scheduletime"];
                                                                            $scheduletime = date("h:i A", strtotime($twentyfourHourtime));
                                                                            $scheduleByDate[$row['scheduledate']][] = $row["scheduletime"];
                                                                        }

                                                                        for ($rowIndex = 0; $rowIndex < 2; $rowIndex++) { ?>
                                                                            <tr>
                                                                                <?php for ($colIndex = 0; $colIndex < 5; $colIndex++) {
                                                                                    $dateToDisplay = date("Y-m-d", time() + ($colIndex + $rowIndex * 5) * 24 * 60 * 60);

                                                                                    $time_slots = isset($scheduleByDate[$dateToDisplay]) ? $scheduleByDate[$dateToDisplay] : array();
                                                                                ?>
                                                                                    <td class="date_day_detailed">
                                                                                        <center>
                                                                                            <?php
                                                                                            foreach ($time_slots as $time_slot) {
                                                                                                $sqlSeatsLeft = "SELECT nop, scheduleid FROM schedule WHERE docid = '$docid' AND scheduledate = '$dateToDisplay' AND scheduletime = '$time_slot'";
                                                                                                $resultSeatsLeft = $database->query($sqlSeatsLeft);
                                                                                                $rowSeatsLeft = $resultSeatsLeft->fetch_assoc();
                                                                                                $totalbooked = $rowSeatsLeft['nop'];
                                                                                                $scid = $rowSeatsLeft['scheduleid'];

                                                                                                $sqlmain12 = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.scheduleid='$scid';";
                                                                                                $result12 = $database->query($sqlmain12);
                                                                                                $seatbooked = $result12->num_rows;
                                                                                                if ($seatbooked != 0) {
                                                                                                    $seatsLeft = $totalbooked - $seatbooked;
                                                                                                } else {
                                                                                                    $seatsLeft = $totalbooked;
                                                                                                }
                                                                                                $apponum = $seatbooked + 1;
                                                                                                if ($seatsLeft <= 10)
                                                                                                    $a = 'Only ';
                                                                                                else
                                                                                                    $a = '';

                                                                                            ?>
                                                                                                <div class="select_time_slot" data-scid="<?php echo $scid; ?>">
                                                                                                    <?php if ($seatsLeft > 0) { ?>
                                                                                                        <p id="slot_booking_time" class="time_slot" data-seats="<?php echo $a . $seatsLeft; ?>" data-apponum="<?php echo $apponum; ?>">
                                                                                                            <?php $time_slot;
                                                                                                            if ($mode == 'Video Consultancy') {
                                                                                                                $timestamp = strtotime($time_slot);
                                                                                                                $updatedTimestamp = $timestamp + (10 * 60 * ($apponum - 1));
                                                                                                                $scheduletime = date("h:i A", $updatedTimestamp);
                                                                                                                echo $scheduletime;
                                                                                                            } else {
                                                                                                                $scheduletime = date("h:i A", strtotime($time_slot));
                                                                                                                echo $scheduletime;
                                                                                                            } ?>
                                                                                                        </p>
                                                                                                    <?php } ?>
                                                                                                </div><?php
                                                                                                    }
                                                                                                        ?>
                                                                                        </center>
                                                                                    </td>
                                                                                <?php } ?>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </table>
                                                                </form>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td style=" width: 25%;">
                                                <div class="bill-details">
                                                    <div class="billing-disclaimer">
                                                        <div style="width:100%;padding-top: 15px;padding-bottom: 15px;">
                                                            <div class="h1-search" style="font-size:17px;text-align:center;">
                                                                <?php echo $lang['byour-appointmentnuml'] ?>
                                                            </div>
                                                            <center>
                                                                <div id="apponum" style="margin-left: 0px; font-size: 50px; font-weight: 800; text-align: center; color: var(--btnnictext);"><?php echo $apponum ?></div>
                                                            </center>
                                                        </div>
                                                    </div>
                                                    <div class="flex-row" style="justify-content:start;">
                                                        <img src="../img/icons/discount.svg" alt="discount image" width="25px">
                                                        <p style="margin-left: 10px; color: green;"> <?php echo $lang['bcashback-prompt'] ?> </p>
                                                    </div>
                                                    <div style="border-top: 1px solid #292D32; margin-top: 2vh; font-weight:500;">
                                                        <?php
                                                        $result12 = $database->query("SELECT * FROM wallet WHERE pid = '$userid'");
                                                        $row12 = $result12->fetch_assoc();
                                                        $balance = $row12['balance'];
                                                        if ($mode == 'Video Consultancy') {
                                                            $total_amount = 250;
                                                        } else {
                                                            $total_amount = 100;
                                                        }
                                                        ?>
                                                        <h5 style="margin:2vh 0 2vh 0"><?php echo $lang['bbilldetails'] ?></h5>
                                                        <div class="flex-row" style="justify-content: flex-start;">
                                                            <label class="checkbox-container">
                                                                <input type="checkbox" id="subtractBalanceCheckbox" onchange="toggleCheckbox()">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <p style="text-align: left; margin-left: 5px"><?php echo $lang['bpeas-creditor'] ?><br>
                                                                <w style="font-size: 11px; font-weight: 400;"><?php echo $lang['bavailable-balance'] ?><?php echo $balance; ?></w>
                                                            </p>
                                                        </div>

                                                        <div class="flex-row">
                                                            <p style="text-align: left;"><?php echo $lang['bitem-total'] ?></p>
                                                            <p style="margin-left: auto; margin-right:15px;"><?php echo '₹' . $total_amount ?></p>
                                                        </div>
                                                        <div class="flex-row">
                                                            <p style="text-align: left;"><?php echo $lang['bpayable-amount'] ?></p>
                                                            <p id="payableAmount" style="margin-left: auto; margin-right:15px;"><?php echo '₹' . ($total_amount + 110) ?></p>
                                                        </div>
                                                        <p id="payButton" class="login-btn btn-primary btn" style="text-align: center;"><?php echo $lang['bpaynow'] ?></p>
                                                    </div>
                                                </div>
                            </div>
                    </td>
                </tr>

            <?php } else { ?>
                <td style="width: 50%;" rowspan="2">
                    <div class="dashboard-items search-items">
                        <div style="width:100%; margin-top:0">
                            <div class="h3-search" style="font-size:18px;line-height:30px">
                                <center>
                                    <br><br>
                                    <img src="../img/notfound.svg" width="25%">
                                    <br><br>
                                    <p class="heading-main12" style="margin-left: 30px;font-size:20px;color:rgb(49, 49, 49)"> <?php echo $lang['bno-schedulefound'] ?></p>
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
        <script>
            const slot_booking_time = document.getElementById('slot_booking_time');
            // JavaScript to show seats left on hover
            const timeSlots = document.querySelectorAll('.time_slot');
            const popup = document.createElement('div');
            popup.className = 'pop-up';

            timeSlots.forEach(slot => {
                slot.addEventListener('mouseenter', () => {
                    const seatsLeft = slot.getAttribute('data-seats');
                    popup.textContent = seatsLeft + ' seats left!';
                    slot.appendChild(popup);
                });
                slot.addEventListener('mouseleave', () => {
                    slot.removeChild(popup);
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const timeSlots = document.querySelectorAll('.time_slot');

                timeSlots.forEach(function(timeSlot) {
                    timeSlot.addEventListener('click', function() {
                        // Toggle selection
                        if (this.classList.contains('selected')) {
                            // Remove border from the clicked time slot
                            this.classList.remove('selected');

                            // Clear the selected time value in the form
                            document.getElementById('selected_time_input').value = '';
                        } else {
                            // Remove border from all time slots
                            timeSlots.forEach(function(ts) {
                                ts.classList.remove('selected');
                            });

                            // Add border to the clicked time slot
                            this.classList.add('selected');

                            // Get the selected time slot value
                            const selectedTime = this.textContent.trim();

                            // Update the form input field with the selected time
                            document.getElementById('selected_time_input').value = selectedTime;
                        }
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get all the elements with class "select_time_slot"
                var timeSlotDivs = document.querySelectorAll('.select_time_slot');

                // Attach a click event listener to each div element
                timeSlotDivs.forEach(function(div) {
                    div.addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default behavior of the click

                        var selectedScid = div.getAttribute('data-scid');
                        setCookie('id', selectedScid, 5); // Set the cookie with a 5-minute expiration

                        div.classList.add('selected');


                    });
                });

                // Function to set a cookie
                function setCookie(name, value, minutes) {
                    var d = new Date();
                    d.setTime(d.getTime() + (minutes * 60 * 1000)); // Expiry time in milliseconds
                    var expires = "expires=" + d.toUTCString();
                    document.cookie = name + "=" + value + ";" + expires + ";path=/";
                }
            });
        </script>
        <script>
            // Wait for the document to be fully loaded
            document.addEventListener("DOMContentLoaded", function() {
                // Get all time slot elements
                var timeSlotElements = document.querySelectorAll(".time_slot");

                // Add click event listener to each time slot
                timeSlotElements.forEach(function(timeSlot) {
                    timeSlot.addEventListener("click", function() {
                        // Extract the appointment number and seats left from the data attributes
                        var newApponum = this.getAttribute("data-apponum");
                        var newSeatsLeft = this.getAttribute("data-seats");

                        // Update the content of the div with the new appointment number and seats left
                        document.getElementById("apponum").textContent = newApponum;
                        // You can update the seats left somewhere if needed
                    });
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const timeSlotElements = document.querySelectorAll(".time_slot");

                timeSlotElements.forEach(function(timeSlot) {
                    timeSlot.addEventListener("click", function() {
                        const selectedTime = timeSlot.textContent.trim();
                        const paymentContainer = document.getElementById("payButton");

                        if (timeSlot.classList.contains("selected")) {
                            // If the time_slot is already selected, unselect it and block actions
                            paymentContainer.style.pointerEvents = "auto";
                            paymentContainer.style.opacity = "1";
                        } else {
                            paymentContainer.style.pointerEvents = "none";
                            paymentContainer.style.opacity = ".7";
                        }
                    });
                });
            });
        </script>
        <script>
            // Get references to elements
            const subtractBalanceCheckbox = document.getElementById('subtractBalanceCheckbox');
            const payableAmount = document.getElementById('payableAmount');
            var newPayableAmount = <?php echo $total_amount + 0 ?>;
            // Function to update payable amount based on checkbox state
            function updatePayableAmount() {
                const isChecked = subtractBalanceCheckbox.checked;
                const totalAmount = <?php echo $total_amount ?>;
                const registrationFee = 0;
                let newPayableAmount = isChecked ? totalAmount + registrationFee - <?php echo $balance ?> : totalAmount + registrationFee;

                payableAmount.textContent = 'Rs. ' + newPayableAmount;

                var selectedTestsValue = "<?php echo isset($_POST['selectedTests']) ? $_POST['selectedTests'] : ''; ?>";

                if (selectedTestsValue !== '') {
                    document.cookie = 'selectedTestIndexes=' + encodeURIComponent(selectedTestsValue) + '; expires=' + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + '; path=/';
                    document.cookie = 'newPayableAmount=' + encodeURIComponent(newPayableAmount) + '; expires=' + new Date(new Date().getTime() + 100 * 1000).toUTCString() + '; path=/';
                }
                const payButton = document.getElementById('payButton');


                document.getElementById('payButton').addEventListener('click', () => {
                    const options = {
                        key: apiKey,
                        amount: calculateDynamicAmount(), // Amount in paise (e.g., ₹100 = 10000 paise)
                        currency: 'INR',
                        name: 'TEAM SLEEK - PEaS',
                        description: 'Payment for Services',
                        handler: response => {
                            handlePaymentResponse(response);
                        },
                    };

                    const rzp = new Razorpay(options);
                    rzp.open();
                });

                function calculateDynamicAmount() {
                    return (newPayableAmount * 100);
                }

                function handlePaymentResponse(response) {
                    // Handle the payment response here
                    console.log('Payment Response:', response);

                    if (response.razorpay_payment_id) {
                        const paymentId = response.razorpay_payment_id;
                        const currentUrl = window.location.href;
                        const updatedUrl = currentUrl + '?payment_id=' + paymentId;
                        window.location.href = updatedUrl; // Redirect to the updated URL
                    } else {
                        console.log('Payment failed! Reason: ' + response.error.description);
                    }
                }
            }

            // Add an event listener to the checkbox
            subtractBalanceCheckbox.addEventListener('change', updatePayableAmount);

            // Initial update based on checkbox state
            updatePayableAmount();
            var selectedTestsValue = "<?php echo isset($_POST['selectedTests']) ? $_POST['selectedTests'] : ''; ?>";

            if (selectedTestsValue !== '') {
                document.cookie = 'selectedTestIndexes=' + encodeURIComponent(selectedTestsValue) + '; expires=' + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + '; path=/';
            }
            const payButton = document.getElementById('payButton');

            document.getElementById('payButton').addEventListener('click', () => {
                const options = {
                    key: apiKey,
                    amount: calculateDynamicAmount(), // Amount in paise (e.g., ₹100 = 10000 paise)
                    currency: 'INR',
                    name: 'TEAM SLEEK - PEaS',
                    description: 'Payment for Services',
                    handler: response => {
                        handlePaymentResponse(response);
                    },
                };

                const rzp = new Razorpay(options);
                rzp.open();
            });

            function calculateDynamicAmount() {
                return (newPayableAmount * 100);
            }

            function handlePaymentResponse(response) {
                // Handle the payment response here
                console.log('Payment Response:', response);

                if (response.razorpay_payment_id) {
                    const paymentId = response.razorpay_payment_id;
                    const currentUrl = window.location.href;
                    const updatedUrl = currentUrl + '?payment_id=' + paymentId;
                    window.location.href = updatedUrl; // Redirect to the updated URL
                } else {
                    console.log('Payment failed! Reason: ' + response.error.description);
                }
            }
        </script>
</body>

<script>
    !(function() {
        let e = document.createElement("script"),
            t = document.head || document.getElementsByTagName("head")[0];
        (e.src = "https://cdn.jsdelivr.net/npm/rasa-webchat/lib/index.js"),
        (e.async = !0),
        (e.onload = () => {
            window.WebChat.default({
                    title: "Virtual Assistant",
                    subtitle: "powered by SLEEK",

                    initPayload: '/greet',
                    customData: {
                        language: "en",
                    },
                    socketUrl: "http://localhost:5005",
                    profileAvatar: "../img/user.png",
                    params: {
                        images: {
                            dims: {
                                width: 200,
                                height: 100,
                            },
                        },
                        storage: "session",
                    },
                },
                null
            );
        }),
        t.insertBefore(e, t.firstChild);
    })();
</script>

</html>