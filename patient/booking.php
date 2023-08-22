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

    <title>Sessions</title>
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

        #payment-container {
            pointer-events: none;
            opacity: .7;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();
    error_reporting(0);
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


    date_default_timezone_set('Asia/Kolkata');

    $today = date('Y-m-d');


    if ($_GET) {
        $payment_id = $_GET['payment_id'];
        $urlid = $_COOKIE['id'];
        $a = 1;
        if ($payment_id !== NULL and $a == 1) {
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
            $sql2 = "select * from appointment where scheduleid=$urlid";
            //echo $sql2;
            $result12 = $database->query($sql2);
            $apponum = ($result12->num_rows) + 1;
            $command = "python ../python/sms_confirmation.py " . escapeshellarg($docname) . "  " . escapeshellarg($scheduledate) . " " . escapeshellarg($scheduletime) . " " . escapeshellarg($phone_number)  . " " . escapeshellarg($apponum);
            $output = shell_exec($command);
            // echo $command;
            $sql2 = "insert into appointment(pid,apponum,scheduleid,appodate) values ($userid,$apponum,$scheduleid,'$today')";
            $result = $database->query($sql2);
            $a = 0;
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
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="specialities.php" class="non-style-link-menu non-style-link-menu-active">
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
                    <td class="menu-btn menu-icon-assistant">
                        <a href="assistant.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Assistant</p>
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
                        <a href="specialities.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
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
                                        if (isset($_POST['submitButton'])) {
                                            $mode = $_POST['modeSelect'];
                                            $id = $_POST['scheduleid'];
                                            $docid = $_POST['docid'];
                                            $sqlmain1 = "SELECT * FROM DOCTOR INNER JOIN `SCHEDULE` on DOCTOR.docid = `SCHEDULE`.docid WHERE `SCHEDULE`.title = (SELECT sname from specialties where id = '$id') and DOCTOR.docid = '$docid' and `SCHEDULE`.scheduledate >= '$today';";
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
                                        ?>


                                            <td style="width: 50%;" rowspan="2">
                                                <div class="dashboard-items search-items">
                                                    <div style="width:100">
                                                        <div class="h1-search" style="font-size:25px;display: flex; flex-direction:row; align-items:center">
                                                            <div><?php echo $title ?></div>
                                                            <div style="font-size: 15px; color:#6a6a6a; font-weight:500;">&nbsp;[<?php echo  substr($mode, 0, 40) ?>]</div>
                                                        </div>
                                                        <div class="h3-search" style="font-size:16px;line-height:30px">
                                                            Doctor name: &nbsp;&nbsp;<b><?php echo $docname ?></b><br>
                                                            Doctor Email: &nbsp;&nbsp;<b><?php echo $docemail ?></b><br>
                                                            <?php
                                                            if ($mode == 'Video Consultancy') {
                                                                echo 'Consultancy fee : <b>₹ 250</b>';
                                                            } else {
                                                                echo 'Booking fee: <b>₹ 100</b>';
                                                            } ?>&nbsp;
                                                            <black style=" color:#000; font-size:13px">[</black>
                                                            <red style="color:red; font-size:13px"> Non-refundable </red>
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
                                                                            $days = array("Today", "Tomorrow", "&nbsp;", "&nbsp;", "&nbsp;");
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
                                                                                                    <p class="time_slot" data-seats="<?php echo $a . $seatsLeft; ?>" data-apponum="<?php echo $apponum; ?>">
                                                                                                        <?php $time_slot;
                                                                                                        $scheduletime = date("h:i A", strtotime($time_slot));
                                                                                                        echo $scheduletime;
                                                                                                        ?>
                                                                                                    </p>
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
                                            </td>

                                            <td style=" width: 25%;">
                                                <div class="dashboard-items search-items">
                                                    <div style="width:100%;padding-top: 15px;padding-bottom: 15px;">
                                                        <div class="h1-search" style="font-size:20px;line-height: 35px;margin-left:8px;text-align:center;">
                                                            Your Appointment Number
                                                        </div>
                                                        <center>
                                                            <div id="apponum" class="dashboard-icons" style="margin-left: 0px; width: 90%; font-size: 70px; font-weight: 800; text-align: center; color: var(--btnnictext); background-color: var(--btnice)"><?php echo $apponum ?></div>
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
                        <div id="payment-container">
                            <?php
                                            if ($mode == 'Video Consultancy') {
                                                echo '<form style="margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:100%;text-align: center;">
                        <script src="../js/payment-button.js" data-payment_button_id="pl_MSQ71WPrRsMm2I" async> </script> </form>';
                                            } else {
                                                echo '<form style="margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:100%;text-align: center;">
                        <script src="../js/payment-button.js" data-payment_button_id="pl_MQciFl4IXO0PBg" async> </script> </form>';
                                            } ?>
                        </div>
                    </td>
                </tr>
            <?php
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
        <script>
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

                        // Update the style or class to indicate selection
                        div.classList.add('selected'); // For example, you can add a "selected" class
                        // Or modify the style directly, like: div.style.backgroundColor = 'green';

                        // You can also perform any other necessary actions here

                        // Optionally, update UI to reflect the selection without reloading the page
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
                        const paymentContainer = document.getElementById("payment-container");

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

</body>


</html>