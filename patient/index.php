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

    <title>Dashboard</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        .anime {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .workout_img {
            width: 110px;
            height: 110px;
            margin: 0 15px 0 15px;
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
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch = $userrow->fetch_assoc();

    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];


    //echo $userid;
    //echo $username;

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
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active">
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Home</p>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">All Doctors</p>
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
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">My Bookings</p>
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
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

                <tr>

                    <td colspan="1" class="nav-bar">
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Home</p>

                    </td>
                    <td width="25%">

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
                            <table class="filter-container doctor-header patient-header" style="border: none;width:95%" border="0">
                                <tr>
                                    <td>
                                        <h3>Welcome!</h3>
                                        <h1><?php echo $username  ?>. [P-<?php echo $userid; ?>]</h1>
                                        <p>Haven't any idea about doctors? no problem let's jumping to
                                            <a href="doctors.php" class="non-style-link"><b>"All Doctors"</b></a> section or
                                            <a href="schedule.php" class="non-style-link"><b>"Sessions"</b> </a><br>
                                            Track your past and future appointments history.<br>Also find out the expected arrival time of your doctor or medical consultant.<br><br>
                                        </p>

                                        <h3>Channel a Doctor Here</h3>
                                        <form action="schedule.php" method="post" style="display: flex">

                                            <input type="search" name="search" class="input-text " placeholder="Search Doctor and We will Find The Session Available" list="doctors" style="width:45%;">&nbsp;&nbsp;

                                            <?php
                                            echo '<datalist id="doctors">';
                                            $list11 = $database->query("select  docname,docemail from  doctor;");

                                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                                $row00 = $list11->fetch_assoc();
                                                $d = $row00["docname"];

                                                echo "<option value='$d'><br/>";
                                            };

                                            echo ' </datalist>';
                                            ?>


                                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                                            <br>
                                            <br>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <td width=" 25%">
                            <center>
                                <table class="filter-container" style="border: none;" border="0">
                                    <tr>
                                        <td colspan="4">
                                            <p style="font-size: 20px;font-weight:600;padding-left: 30px; margin-top:0;" class="anime">Live Status</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%; transform:scale(.85)">
                                            <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex">
                                                <div>
                                                    <div class="h1-dashboard">
                                                        <?php echo "72"  ?>
                                                    </div><br>
                                                    <div class="h3-dashboard">
                                                        Heart Rate&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%;transform:scale(.85)">
                                            <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex; ">
                                                <div>
                                                    <div class="h1-dashboard">
                                                        <?php echo "96%"  ?>
                                                    </div><br>
                                                    <div class="h3-dashboard">
                                                        Oxygen Level&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/oxygen-iceblue.svg'); background-size: 25px 25px;"></div>
                                            </div>
                                        </td>
                                    </tr>
                            </center>
                    </td>
            </table>
            </td>
            <td>
                <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your Upcoming Booking</p>
                <center>
                    <div class="abc scroll" style="height: 250px;padding: 0;margin: 0; ">
                        <table width="90%" class="sub-table scrolldown" border="0">
                            <thead>
                                <tr>
                                    <th class="table-headin" style="width: 50px;">
                                        Appoint. Number
                                    </th>
                                    <th class="table-headin">
                                        Session Title
                                    </th>
                                    <th class="table-headin">
                                        Doctor
                                    </th>
                                    <th class="table-headin">
                                        Sheduled Date & Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nextweek = date("Y-m-d", strtotime("+1 week"));
                                $sqlmain = "select * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  patient.pid=$userid  and schedule.scheduledate>='$today' order by schedule.scheduledate asc";
                                //echo $sqlmain;
                                $result = $database->query($sqlmain);

                                if ($result->num_rows == 0) {
                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nothing to show here!</p>
                                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Channel a Doctor &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                } else {
                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                        $row = $result->fetch_assoc();
                                        $scheduleid = $row["scheduleid"];
                                        $title = $row["title"];
                                        $apponum = $row["apponum"];
                                        $docname = $row["docname"];
                                        $scheduledate = $row["scheduledate"];
                                        $scheduletime = $row["scheduletime"];
                                        echo '<tr>
                                                        <td style="padding:30px;font-size:25px;font-weight:700; text-align:center;"> &nbsp;' .
                                            $apponum
                                            . '</td>
                                                        <td style="padding:20px;"> &nbsp;' .
                                            substr($title, 0, 30)
                                            . '</td>
                                                        <td>
                                                        ' . substr($docname, 0, 20) . '
                                                        </td>
                                                        <td style="text-align:center;">
                                                            ' . substr($scheduledate, 0, 10) . ' ' . substr($scheduletime, 0, 5) . '
                                                        </td>                                       
                                                    </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </center>
            </td>
            </table>
        </div>
    </div>

    <script>
        const data = null;

        const xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener('readystatechange', function() {
            if (this.readyState === this.DONE) {
                console.log(this.responseText);
            }
        });

        xhr.open('GET', 'https://ind-nutrient-api1.p.rapidapi.com/food?limit=10');
        xhr.setRequestHeader('X-RapidAPI-Key', '9ac6e39de4mshac558a6fd4b8c40p1b0977jsn45eb42749010');
        xhr.setRequestHeader('X-RapidAPI-Host', 'ind-nutrient-api1.p.rapidapi.com');
        xhr.send(data);
    </script>
</body>

</html>