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
    <?php include("../patient/config.php") ?>
    <title>Dashboard</title>
    <style>
        /* Grid-related CSS */

        :root {
            --square-size: 14px;
            --square-gap: 5px;
            --week-width: calc(var(--square-size) + var(--square-gap));
        }

        .months {
            grid-area: months;
        }

        .days {
            grid-area: days;
        }

        .squares {
            grid-area: squares;
        }

        .graph {
            display: inline-grid;
            grid-template-areas: "empty months"
                "days squares";
            grid-template-columns: auto 1fr;
            grid-gap: 5px;
        }

        .months {
            display: grid;
            grid-template-columns: calc(var(--week-width) * 4)
                /* Jan */
                calc(var(--week-width) * 4)
                /* Feb */
                calc(var(--week-width) * 4)
                /* Mar */
                calc(var(--week-width) * 5)
                /* Apr */
                calc(var(--week-width) * 4)
                /* May */
                calc(var(--week-width) * 4)
                /* Jun */
                calc(var(--week-width) * 5)
                /* Jul */
                calc(var(--week-width) * 4)
                /* Aug */
                calc(var(--week-width) * 4)
                /* Sep */
                calc(var(--week-width) * 5)
                /* Oct */
                calc(var(--week-width) * 4)
                /* Nov */
                calc(var(--week-width) * 5)
                /* Dec */
            ;
        }

        .days,
        .squares {
            display: grid;
            grid-gap: var(--square-gap);
            grid-template-rows: repeat(7, var(--square-size));
        }

        .squares {
            grid-auto-flow: column;
            grid-auto-columns: var(--square-size);
        }

        .graph {
            padding: 20px;
            border: 1px #e1e4e8 solid;
            margin: 0 0 0 20px;
        }

        .days li:nth-child(odd) {
            visibility: hidden;
        }

        .squares li {
            background-color: #ebedf0;
        }

        .squares li[data-level="1"] {
            background-color: #8ab8e3;
        }

        .squares li[data-level="2"] {
            background-color: #3488d6;
        }

        .squares li[data-level="3"] {
            background-color: #003668;
        }

        li {
            list-style: none;
        }

        .dashbord-tables,
        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container,
        .graph {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        #anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }
    </style>


</head>

<body>
    <?php

    //learn from w3schools.com


    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];


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
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Dashboard</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">My Appointments</p>

                            </div>
                        </a>
                    </td>
                </tr>

                <tr class="menu-row">
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">My Sessions</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">My Patients</p>
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
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Dashboard</p>

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


                            $patientrow = $database->query("SELECT  * from  patient;");
                            $doctorrow = $database->query("SELECT  * from  doctor;");
                            $appointmentrow = $database->query("SELECT * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid where doctor.docid=$userid and appointment.status=0 and schedule.scheduledate >='$today'");
                            $schedulerow = $database->query("SELECT  * from  schedule where scheduledate='$today' and docid = '$userid';");


                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <tr>
                                <td width=" 50%">

                            <center>
                                <table class="filter-container doctor-header" style="border: none;width:95%; margin-left: 5%;" border="0">
                                    <tr>
                                        <td>
                                            <div style="max-height: 35vh;">
                                                <h3>Welcome!</h3>
                                                <h1><?php echo $username  ?>.</h1>
                                                <p> We are always trying to get you a complete service<br>
                                                    You can view your dailly schedule, Reach Patients Appointment at home!<br><br>
                                                </p>
                                                <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:45%">View My Appointments</button></a>
                                                <br>
                                                <br>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                    </td>
                    <td>



                        <p id="anim" style="font-size: 20px;font-weight:600;padding-left: 40px;">Your Up Coming Sessions until Next week</p>
                        <center>
                            <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                <table width="85%" class="sub-table scrolldown" border="0">
                                    <thead>

                                        <tr>
                                            <th class="table-headin">


                                                Session Title

                                            </th>

                                            <th class="table-headin">
                                                Sheduled Date
                                            </th>
                                            <th class="table-headin">

                                                Time

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $nextweek = date("Y-m-d", strtotime("+1 week"));
                                        $sqlmain = "SELECT schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid  where schedule.scheduledate>='$today' and schedule.scheduledate<='$nextweek' and schedule.docid = '$userid' order by schedule.scheduledate ASC";
                                        $result = $database->query($sqlmain);

                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
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
                                                $docname = $row["docname"];
                                                $scheduledate = $row["scheduledate"];
                                                $scheduletime = $row["scheduletime"];
                                                $nop = $row["nop"];
                                                echo '<tr>
                                                        <td style="padding:20px;"> &nbsp;' .
                                                    substr($lang[$title], 0, 35)
                                                    . '</td>
                                                        <td style="padding:20px;font-size:13px;">
                                                        ' . substr($scheduledate, 0, 10) . '
                                                        </td>
                                                        <td style="text-align:center;">
                                                            ' . substr($scheduletime, 0, 5) . '
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
                </tr>
                <tr>
                    <td colspan="4">
                        <p id="anim" style="font-size: 20px;font-weight:600;padding-left: 40px;margin-top:0 0 0 0;">Contributions in an Year</p>
                        <center>
                            <div class="graph">
                                <ul class="months">
                                </ul>
                                <ul class="days">
                                    <li>Sun</li>
                                    <li>Mon</li>
                                    <li>Tue</li>
                                    <li>Wed</li>
                                    <li>Thu</li>
                                    <li>Fri</li>
                                    <li>Sat</li>
                                </ul>
                                <ul class="squares"></ul>
                            </div>
                        </center>
                    </td>
                </tr>
            </table>
            </td>
            <tr>
                </table>
        </div>
    </div>
</body>
<script>
    const squares = document.querySelector(".squares");
    const months = document.querySelector(".months");

    // Get the current month (0-indexed)
    const currentMonth = new Date().getMonth();
    const monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];

    // Define sample data for contributions (0, 1, 2, or 3)
    const sampleData = [
        // January
        0, 1, 2, 3, 2, 1, 0, 1, 2, 3, 4, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4,
        // February
        5, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 6,
        // March
        5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8,
        // April
        9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2,
        // May
        3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4,
        // June
        3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7,
        // July
        8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0,
        // August
        1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7,
        // September
        6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4,
        // October
        5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3,
        // November
        2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8,
        // December
        9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 1, 2
    ];

    // Populate the months list starting from the current month
    for (let i = 1; i < 13; i++) {
        const monthIndex = (currentMonth + i) % 12;
        months.insertAdjacentHTML(
            "beforeend",
            `<li>${monthNames[monthIndex]}</li>`
        );
    }

    // Populate the squares with sample data
    sampleData.forEach(level => {
        squares.insertAdjacentHTML(
            "beforeend",
            `<li data-level="${level}"></li>`
        );
    });
</script>

</html>