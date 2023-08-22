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
                            <tr>
                                <td width=" 50%">
                            <center>
                                <!-- <table class="filter-container" style="border: none;" border="0">
                                    <tr>
                                        <td style="width: 24%;">
                                            <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex; ">
                                                <div>
                                                    <div class="h1-dashboard">
                                                        <?php echo "96%"  ?>
                                                    </div><br>
                                                    <div class="h3-dashboard">
                                                        Oxygen Level&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/oxygen-iceblue.svg'); background-size: 25px 25px;"></div>
                                            </div>
                                        </td>
                                        <td style="width: 25%;">
                                            <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
                                                <div>
                                                    <div class="h1-dashboard">
                                                        <?php echo "72"  ?>
                                                    </div><br>
                                                    <div class="h3-dashboard">
                                                        Heart Rate&nbsp;
                                                    </div>
                                                </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/pulse-iceblue.svg'); background-size: 25px 25px;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table> -->
                                <table class="filter-container" style="border: none; " border="0">
                                    <tr>
                                        <td style="width: 110% !important;">
                                            <div class="dashboard-items" style="padding:0 20px 20px 20px !important;margin:auto;width:97%;display: flex; ">
                                                <div>
                                                    <div id="exerciseContainer">
                                                        <h3>Fitness Workout</h3>
                                                        <div style="display: flex; flex-direction:row;  color: #000; align-items:center">
                                                            <img class="workout_img" id="exerciseImage" src="" alt="Exercise GIF">
                                                            <div style="display: flex; flex-direction:column;">
                                                                <p id="exerciseName"></p>
                                                                <p id="exerciseTarget"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        const exercises = [{
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/u4v-YOTl3WwhAt",
                                                                "id": "0001",
                                                                "name": "3/4 sit-up",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/OAcZgC5xdGEpDv",
                                                                "id": "0002",
                                                                "name": "45° side bend",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/dvye92sbWprCfX",
                                                                "id": "0003",
                                                                "name": "air bike",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/AOtfHi1aURdhsR",
                                                                "id": "1512",
                                                                "name": "all fours squad stretch",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/PCbTGF5vbrfQ0H",
                                                                "id": "0006",
                                                                "name": "alternate heel touchers",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/3TePu73lbzxaal",
                                                                "id": "0007",
                                                                "name": "alternate lateral pulldown",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/-N680jXTT4gcoZ",
                                                                "id": "1368",
                                                                "name": "ankle circles",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/8HUThdTMB5VFix",
                                                                "id": "3293",
                                                                "name": "archer pull up",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/ssFWm8aBSdz8sA",
                                                                "id": "3294",
                                                                "name": "archer push up",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/jegpvrv27duXsj",
                                                                "id": "2355",
                                                                "name": "arm slingers hanging bent knee legs",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/mwNCwmF2AgQ6oW",
                                                                "id": "2333",
                                                                "name": "arm slingers hanging straight legs",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/8gaQDYqAPTIPjV",
                                                                "id": "3214",
                                                                "name": "arms apart circular toe touch (male)",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/6H9LNl5DoGeaAZ",
                                                                "id": "3204",
                                                                "name": "arms overhead full sit-up (male)",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "leverage machine",
                                                                "gifUrl": "https://api.exercisedb.io/image/r5AVqfPVPJBiNm",
                                                                "id": "0009",
                                                                "name": "assisted chest dip (kneeling)",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/zcc1pi-dw2DCoL",
                                                                "id": "0011",
                                                                "name": "assisted hanging knee raise",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/UcsiGA1f334Jtc",
                                                                "id": "0010",
                                                                "name": "assisted hanging knee raise with throw down",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/oNkcpGqu27avOK",
                                                                "id": "1708",
                                                                "name": "assisted lying calves stretch",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/z3zg8lz2glrV2e",
                                                                "id": "1709",
                                                                "name": "assisted lying glutes stretch",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/Pl-xzJwattus22",
                                                                "id": "1710",
                                                                "name": "assisted lying gluteus and piriformis stretch",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/vph-x38Q4L9l5N",
                                                                "id": "0012",
                                                                "name": "assisted lying leg raise with lateral throw down",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/NDO9wkNiEPiPem",
                                                                "id": "0013",
                                                                "name": "assisted lying leg raise with throw down",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "medicine ball",
                                                                "gifUrl": "https://api.exercisedb.io/image/phTXAdvJPnr7jQ",
                                                                "id": "0014",
                                                                "name": "assisted motion russian twist",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "leverage machine",
                                                                "gifUrl": "https://api.exercisedb.io/image/SiA57BdA1D97MH",
                                                                "id": "0015",
                                                                "name": "assisted parallel close grip pull-up",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/x5dCjbVMswKknc",
                                                                "id": "0016",
                                                                "name": "assisted prone hamstring",
                                                                "target": "hamstrings"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/oasuDaFQruBavi",
                                                                "id": "1713",
                                                                "name": "assisted prone lying quads stretch",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/cE4qcAyawsuBWp",
                                                                "id": "1714",
                                                                "name": "assisted prone rectus femoris stretch",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "leverage machine",
                                                                "gifUrl": "https://api.exercisedb.io/image/GvyPXZOcRBwp9h",
                                                                "id": "0017",
                                                                "name": "assisted pull-up",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/MP3K5l4DVFpBiT",
                                                                "id": "1716",
                                                                "name": "assisted seated pectoralis major stretch with stability ball",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/a7NFt4P9qlVAQy",
                                                                "id": "1712",
                                                                "name": "assisted side lying adductor stretch",
                                                                "target": "adductors"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/vGXJ0E8ed9lj4w",
                                                                "id": "1758",
                                                                "name": "assisted sit-up",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "leverage machine",
                                                                "gifUrl": "https://api.exercisedb.io/image/c8CgCyIqHhHBxf",
                                                                "id": "1431",
                                                                "name": "assisted standing chin-up",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "leverage machine",
                                                                "gifUrl": "https://api.exercisedb.io/image/uNL8ExJ2jbgjO8",
                                                                "id": "1432",
                                                                "name": "assisted standing pull-up",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/7NgF8tdHUzkrTg",
                                                                "id": "0018",
                                                                "name": "assisted standing triceps extension (with towel)",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "leverage machine",
                                                                "gifUrl": "https://api.exercisedb.io/image/oReM0SxvUKatGH",
                                                                "id": "0019",
                                                                "name": "assisted triceps dip (kneeling)",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "leverage machine",
                                                                "gifUrl": "https://api.exercisedb.io/image/mz6OlZttLPRVkC",
                                                                "id": "2364",
                                                                "name": "assisted wide-grip chest dip (kneeling)",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "cardio",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/3K31mM6e24xxeg",
                                                                "id": "3220",
                                                                "name": "astride jumps (male)",
                                                                "target": "cardiovascular system"
                                                            },
                                                            {
                                                                "bodyPart": "cardio",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/QHiNgtg9dP-nBs",
                                                                "id": "3672",
                                                                "name": "back and forth step",
                                                                "target": "cardiovascular system"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "stability ball",
                                                                "gifUrl": "https://api.exercisedb.io/image/mSlLPZTuZEjLFb",
                                                                "id": "1314",
                                                                "name": "back extension on exercise ball",
                                                                "target": "spine"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/dkcReYGLgRRQan",
                                                                "id": "3297",
                                                                "name": "back lever",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/bz7sCmtBltElFW",
                                                                "id": "1405",
                                                                "name": "back pec stretch",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/LoKNXopUS1dLOM",
                                                                "id": "1473",
                                                                "name": "backward jump",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/X26oBkcW854oJX",
                                                                "id": "0020",
                                                                "name": "balance board",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/349Z8c6AlFOu2I",
                                                                "id": "0968",
                                                                "name": "band alternating biceps curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/4WUXkiGTTd0rfv",
                                                                "id": "0969",
                                                                "name": "band alternating v-up",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/dV6HRce2l7dzfe",
                                                                "id": "0970",
                                                                "name": "band assisted pull-up",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/yxvo1FyZqEI2xh",
                                                                "id": "0971",
                                                                "name": "band assisted wheel rollerout",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/Y-COgmrDSWj47F",
                                                                "id": "1254",
                                                                "name": "band bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/VfD5WVJPlAz47N",
                                                                "id": "0980",
                                                                "name": "band bent-over hip extension",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/rzQYYszSHXK75b",
                                                                "id": "0972",
                                                                "name": "band bicycle crunch",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/PAkBYWoBgsPDUs",
                                                                "id": "0974",
                                                                "name": "band close-grip pulldown",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/SPOauV6VpGmfjJ",
                                                                "id": "0975",
                                                                "name": "band close-grip push-up",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/2lkS4mHxY0XL3k",
                                                                "id": "0976",
                                                                "name": "band concentration curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/rdxKMsAXn1qxp4",
                                                                "id": "3117",
                                                                "name": "band fixed back close grip pulldown",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/XIauH9kMw9JL8b",
                                                                "id": "3116",
                                                                "name": "band fixed back underhand pulldown",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/doRLXmUD486Pd7",
                                                                "id": "0977",
                                                                "name": "band front lateral raise",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/JENJaaQypM0vvV",
                                                                "id": "0978",
                                                                "name": "band front raise",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/XMQqxekcm80fbn",
                                                                "id": "1408",
                                                                "name": "band hip lift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/XmNcpxxp0igJFL",
                                                                "id": "0979",
                                                                "name": "band horizontal pallof press",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/6pnHtotfrtWaSk",
                                                                "id": "0981",
                                                                "name": "band jack knife sit-up",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/-vmYOKu2Nhpz8w",
                                                                "id": "0983",
                                                                "name": "band kneeling one arm pulldown",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/B32QoFCTS-DvMi",
                                                                "id": "0985",
                                                                "name": "band kneeling twisting crunch",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/dKdayVAz3g810U",
                                                                "id": "0984",
                                                                "name": "band lying hip internal rotation",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/mEa0vcbeOAVFYc",
                                                                "id": "1002",
                                                                "name": "band lying straight leg raise",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/hVYS3RvB3lkrPx",
                                                                "id": "0986",
                                                                "name": "band one arm overhead biceps curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/z2Z0SnxbFht24X",
                                                                "id": "0987",
                                                                "name": "band one arm single leg split squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/1JRtv0d1JN80He",
                                                                "id": "0988",
                                                                "name": "band one arm standing low row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/qMyelDyyDdru5z",
                                                                "id": "0989",
                                                                "name": "band one arm twisting chest press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/bHeaS7CGmz67gx",
                                                                "id": "0990",
                                                                "name": "band one arm twisting seated row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/vq5nMKqm-fzh2F",
                                                                "id": "0991",
                                                                "name": "band pull through",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/3qHjePoSlpUVT4",
                                                                "id": "0992",
                                                                "name": "band push sit-up",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/ChD-2RaBXZ7UB8",
                                                                "id": "0993",
                                                                "name": "band reverse fly",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/ZBdX969No1BjnP",
                                                                "id": "0994",
                                                                "name": "band reverse wrist curl",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/E3V67ARJcIGZ9u",
                                                                "id": "0996",
                                                                "name": "band seated hip internal rotation",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/dyCCd2pw6R0BYN",
                                                                "id": "1011",
                                                                "name": "band seated twist",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/vdy9xt5LM12bVr",
                                                                "id": "0997",
                                                                "name": "band shoulder press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/b5QHyY2uthotrK",
                                                                "id": "1018",
                                                                "name": "band shrug",
                                                                "target": "traps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/MzH7apphvFrr6V",
                                                                "id": "0998",
                                                                "name": "band side triceps extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/P0YUYoeP9muBKp",
                                                                "id": "0999",
                                                                "name": "band single leg calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/HOqoiWNvrSFBo9",
                                                                "id": "1000",
                                                                "name": "band single leg reverse calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/Ewml7RzJ1lMJoy",
                                                                "id": "1001",
                                                                "name": "band single leg split squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/uNYtJKCpleOduG",
                                                                "id": "1004",
                                                                "name": "band squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/sz3wxN79Cs7KMG",
                                                                "id": "1003",
                                                                "name": "band squat row",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/pCXtpcoIH-PsvP",
                                                                "id": "1005",
                                                                "name": "band standing crunch",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/Lvmo3v8ZHakP-Q",
                                                                "id": "1022",
                                                                "name": "band standing rear delt row",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/5Dn8nHiUYhKiag",
                                                                "id": "1007",
                                                                "name": "band standing twisting crunch",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/xTtp8oHaO8Cczp",
                                                                "id": "1008",
                                                                "name": "band step-up",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/Bi5q9JYuFlCz91",
                                                                "id": "1009",
                                                                "name": "band stiff leg deadlift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/kB80FhSlDnzqZI",
                                                                "id": "1023",
                                                                "name": "band straight back stiff leg deadlift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/Nw6Ojicz0EnYeK",
                                                                "id": "1010",
                                                                "name": "band straight leg deadlift",
                                                                "target": "spine"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/EYVLKh0naglPwR",
                                                                "id": "1012",
                                                                "name": "band twisting overhead press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/0yBg4yzpfKqcDo",
                                                                "id": "1369",
                                                                "name": "band two legs calf raise - (band under both legs) v. 2",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/UU3xhZB6onfYt2",
                                                                "id": "1013",
                                                                "name": "band underhand pulldown",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/iKrbjJDbxhMeqL",
                                                                "id": "1014",
                                                                "name": "band v-up",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/yVgmLaNrAFx6aJ",
                                                                "id": "1015",
                                                                "name": "band vertical pallof press",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/4U72lRGN4OwgUg",
                                                                "id": "1016",
                                                                "name": "band wrist curl",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "band",
                                                                "gifUrl": "https://api.exercisedb.io/image/XQ4PdBPPladi42",
                                                                "id": "1017",
                                                                "name": "band y-raise",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/KpyVnrfUEw4YAz",
                                                                "id": "0023",
                                                                "name": "barbell alternate biceps curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/kAkNf8GsoZWi8a",
                                                                "id": "0024",
                                                                "name": "barbell bench front squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/tLNnsA-aFbnJXz",
                                                                "id": "0025",
                                                                "name": "barbell bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Bm0VsbJdHns6tN",
                                                                "id": "0026",
                                                                "name": "barbell bench squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/IbDjOXOemtvUcv",
                                                                "id": "1316",
                                                                "name": "barbell bent arm pullover",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/qJ-tj5i8zxrwZh",
                                                                "id": "0027",
                                                                "name": "barbell bent over row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/9cRprWbjSIrx7y",
                                                                "id": "2407",
                                                                "name": "barbell biceps curl (with arm blaster)",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/jO5zdEkAkBEfOL",
                                                                "id": "0028",
                                                                "name": "barbell clean and press",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/M8CKIDo4tiCF3J",
                                                                "id": "0029",
                                                                "name": "barbell clean-grip front squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/UrTm38t4JPtjiD",
                                                                "id": "0030",
                                                                "name": "barbell close-grip bench press",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/7LiRMxYrL48rdt",
                                                                "id": "0031",
                                                                "name": "barbell curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Wus6DhIHu8qzo0",
                                                                "id": "0032",
                                                                "name": "barbell deadlift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/eZXVdxBShm60FL",
                                                                "id": "0033",
                                                                "name": "barbell decline bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/O5-Z6YYwMJ2K8e",
                                                                "id": "0034",
                                                                "name": "barbell decline bent arm pullover",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/lJ3NIYXtOw66AW",
                                                                "id": "0035",
                                                                "name": "barbell decline close grip to skull press",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/p4TFsQ19J6lG1X",
                                                                "id": "1255",
                                                                "name": "barbell decline pullover",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/bb2roOD4Yi2jMY",
                                                                "id": "0036",
                                                                "name": "barbell decline wide-grip press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/JUFKaxgRONrmC3",
                                                                "id": "0037",
                                                                "name": "barbell decline wide-grip pullover",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/eJAvuHdRCmocdM",
                                                                "id": "0038",
                                                                "name": "barbell drag curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/sErQKLG1GaT2S3",
                                                                "id": "1370",
                                                                "name": "barbell floor calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/ZtIgb2co6-ypev",
                                                                "id": "0039",
                                                                "name": "barbell front chest squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/StuTbDIDsdMNtk",
                                                                "id": "0041",
                                                                "name": "barbell front raise",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Oer16vYtvGWdiA",
                                                                "id": "0040",
                                                                "name": "barbell front raise and pullover",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/P8NUo7F17SYbUk",
                                                                "id": "0042",
                                                                "name": "barbell front squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/8YzHwLOCbRucsQ",
                                                                "id": "0043",
                                                                "name": "barbell full squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/IEucE6ypqPdoqb",
                                                                "id": "1461",
                                                                "name": "barbell full squat (back pov)",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/zs2KvgHcnYcmMK",
                                                                "id": "1462",
                                                                "name": "barbell full squat (side pov)",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/ft5mXXVBmYWfAw",
                                                                "id": "1545",
                                                                "name": "barbell full zercher squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/cFjtCF2uj02Kl3",
                                                                "id": "1409",
                                                                "name": "barbell glute bridge",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/mUMLg6tjjfRTRT",
                                                                "id": "3562",
                                                                "name": "barbell glute bridge two legs on bench (male)",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/lub2-F9dmjQFfZ",
                                                                "id": "0044",
                                                                "name": "barbell good morning",
                                                                "target": "hamstrings"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/mh31l8H1Fhrba3",
                                                                "id": "0045",
                                                                "name": "barbell guillotine bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/zFwtAENx8Gzeu5",
                                                                "id": "0046",
                                                                "name": "barbell hack squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Rc6H2uVnsdhSvT",
                                                                "id": "1436",
                                                                "name": "barbell high bar squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/0-mS2pxCJAB2JW",
                                                                "id": "0047",
                                                                "name": "barbell incline bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/BxLGmlZoTAlPjE",
                                                                "id": "1719",
                                                                "name": "barbell incline close grip bench press",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/btNwrx0EX9orZT",
                                                                "id": "0048",
                                                                "name": "barbell incline reverse-grip press",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Xgk0QF2Bp8eRlE",
                                                                "id": "0049",
                                                                "name": "barbell incline row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/guTEj4MjQ4Ljg2",
                                                                "id": "0050",
                                                                "name": "barbell incline shoulder raise",
                                                                "target": "serratus anterior"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/NSJfDSDsXjgTz0",
                                                                "id": "0051",
                                                                "name": "barbell jefferson squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/vM467z118rOFob",
                                                                "id": "0052",
                                                                "name": "barbell jm bench press",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/pd3aQ0tiiecO-6",
                                                                "id": "0053",
                                                                "name": "barbell jump squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/I53Ng3n6vxpZe2",
                                                                "id": "1410",
                                                                "name": "barbell lateral lunge",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/nSxEzHR2nMW7Ua",
                                                                "id": "1435",
                                                                "name": "barbell low bar squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/4M8wmQpuSK90cz",
                                                                "id": "0054",
                                                                "name": "barbell lunge",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/vrwngc2l3jOxJu",
                                                                "id": "1720",
                                                                "name": "barbell lying back of the head tricep extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/jGP4xTGa5sZPbf",
                                                                "id": "0055",
                                                                "name": "barbell lying close-grip press",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/SfM-SmHwLr6BIZ",
                                                                "id": "0056",
                                                                "name": "barbell lying close-grip triceps extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/LcWQQtsLjwqhKm",
                                                                "id": "0057",
                                                                "name": "barbell lying extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/5Y201-Re1O05PV",
                                                                "id": "0058",
                                                                "name": "barbell lying lifting (on hip)",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/KNbD-mvIPnNscF",
                                                                "id": "0059",
                                                                "name": "barbell lying preacher curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/2XyXzxyQqcvZ8e",
                                                                "id": "0061",
                                                                "name": "barbell lying triceps extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/NymjuF77tMSSgX",
                                                                "id": "0060",
                                                                "name": "barbell lying triceps extension skull crusher",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/E4aOMnRAQNjQ-f",
                                                                "id": "0063",
                                                                "name": "barbell narrow stance squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/DnhdppWeknFj8K",
                                                                "id": "0064",
                                                                "name": "barbell one arm bent over row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/NEgPuwb-aNPHv2",
                                                                "id": "0065",
                                                                "name": "barbell one arm floor press",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/vOO5l51ZEycdaY",
                                                                "id": "0066",
                                                                "name": "barbell one arm side deadlift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/6WbyyhNAeF9L0m",
                                                                "id": "0067",
                                                                "name": "barbell one arm snatch",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Fn9bGIbLV3wr2r",
                                                                "id": "0068",
                                                                "name": "barbell one leg squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/8-eCWOUHLNT8kX",
                                                                "id": "0069",
                                                                "name": "barbell overhead squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/kZ8Be0j7E7Ly7P",
                                                                "id": "1411",
                                                                "name": "barbell palms down wrist curl over a bench",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Mdlb0ogYHnwEdr",
                                                                "id": "1412",
                                                                "name": "barbell palms up wrist curl over a bench",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/TjLBuQ8g-3WTYv",
                                                                "id": "3017",
                                                                "name": "barbell pendlay row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/xL3Z2oR71IclA3",
                                                                "id": "1751",
                                                                "name": "barbell pin presses",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/btAht79xIAa8Fp",
                                                                "id": "0070",
                                                                "name": "barbell preacher curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/QAvHVAWOwevTXd",
                                                                "id": "0071",
                                                                "name": "barbell press sit-up",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/uOeIopxbLNyk6H",
                                                                "id": "0072",
                                                                "name": "barbell prone incline curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/88FF3geuR702PG",
                                                                "id": "0073",
                                                                "name": "barbell pullover",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Hw61bkPEx6B8r0",
                                                                "id": "0022",
                                                                "name": "barbell pullover to press",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/gBqeNAe4qkCliH",
                                                                "id": "0074",
                                                                "name": "barbell rack pull",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/wLYhHLdLh2462n",
                                                                "id": "0075",
                                                                "name": "barbell rear delt raise",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/TBzvYf2SFD-t4U",
                                                                "id": "0076",
                                                                "name": "barbell rear delt row",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/F-IB5FScFUGE37",
                                                                "id": "0078",
                                                                "name": "barbell rear lunge",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/ANkFv1fEXMev-I",
                                                                "id": "0077",
                                                                "name": "barbell rear lunge v. 2",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/1whzD5KX0TNK2L",
                                                                "id": "0079",
                                                                "name": "barbell revers wrist curl v. 2",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Ij2ZWjjAFlYPWN",
                                                                "id": "2187",
                                                                "name": "barbell reverse close-grip bench press",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/NyM4qewXuEshTm",
                                                                "id": "0080",
                                                                "name": "barbell reverse curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/VLXyJ8GAEf1AWP",
                                                                "id": "0118",
                                                                "name": "barbell reverse grip bent over row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/9wQkNKyFdsvgzD",
                                                                "id": "1256",
                                                                "name": "barbell reverse grip decline bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/dAGivaQPcJKX8S",
                                                                "id": "1257",
                                                                "name": "barbell reverse grip incline bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/50l8x3Dt4DcCuM",
                                                                "id": "1317",
                                                                "name": "barbell reverse grip incline bench row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/75C6V3yodjUlXS",
                                                                "id": "1721",
                                                                "name": "barbell reverse grip skullcrusher",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/xrTz0XyispWlLu",
                                                                "id": "0081",
                                                                "name": "barbell reverse preacher curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Ml2WiPz7jnWupz",
                                                                "id": "0082",
                                                                "name": "barbell reverse wrist curl",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Xz2fsSQTbS9OAU",
                                                                "id": "0084",
                                                                "name": "barbell rollerout",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/WsrksrrAHnrnw7",
                                                                "id": "0083",
                                                                "name": "barbell rollerout from bench",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/5CBaAbs0nf97Jl",
                                                                "id": "0085",
                                                                "name": "barbell romanian deadlift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/7iwyzloVvucecp",
                                                                "id": "0086",
                                                                "name": "barbell seated behind head military press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/cvm8DajZVSfE9K",
                                                                "id": "0087",
                                                                "name": "barbell seated bradford rocky press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/6EISAuAs1XZHzG",
                                                                "id": "0088",
                                                                "name": "barbell seated calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/6RUQqb1IJsVOvl",
                                                                "id": "1371",
                                                                "name": "barbell seated calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/teOISfX12BVM1h",
                                                                "id": "1718",
                                                                "name": "barbell seated close grip behind neck triceps extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/6vvS2RP1IJon2d",
                                                                "id": "0089",
                                                                "name": "barbell seated close-grip concentration curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/fTujZoJsrWuxQl",
                                                                "id": "0090",
                                                                "name": "barbell seated good morning",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/HsBGQO-vf0qfqD",
                                                                "id": "0091",
                                                                "name": "barbell seated overhead press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/FsmrnEx-PW55tJ",
                                                                "id": "0092",
                                                                "name": "barbell seated overhead triceps extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/-5ht4umv7Dj4SW",
                                                                "id": "0094",
                                                                "name": "barbell seated twist",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/B3wrooxRJec6ez",
                                                                "id": "0095",
                                                                "name": "barbell shrug",
                                                                "target": "traps"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/4FF-Pvpnu2zVqS",
                                                                "id": "0096",
                                                                "name": "barbell side bent v. 2",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/1jgfNMR--WmRG8",
                                                                "id": "0098",
                                                                "name": "barbell side split squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/TpdjzxaPnw5rnm",
                                                                "id": "0097",
                                                                "name": "barbell side split squat v. 2",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/UxfoAgsMp5MizO",
                                                                "id": "1756",
                                                                "name": "barbell single leg deadlift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/t8wHiYZSPx4SXu",
                                                                "id": "0099",
                                                                "name": "barbell single leg split squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/hc4Pdag79-mYs8",
                                                                "id": "2799",
                                                                "name": "barbell sitted alternate leg raise",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/ezWfl3VAEfIDJ0",
                                                                "id": "2800",
                                                                "name": "barbell sitted alternate leg raise (female)",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/pB3R7ZYs6G8929",
                                                                "id": "0100",
                                                                "name": "barbell skier",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/t8YSCmqlfwoNNG",
                                                                "id": "0101",
                                                                "name": "barbell speed squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/XLkx6NCtD1CXWo",
                                                                "id": "2810",
                                                                "name": "barbell split squat v. 2",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/ulJpgvu5LnkAoU",
                                                                "id": "0102",
                                                                "name": "barbell squat (on knees)",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/wL2NPPB2puxUAI",
                                                                "id": "2798",
                                                                "name": "barbell squat jump step rear lunge",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/qnfS11jQvwNi3e",
                                                                "id": "0103",
                                                                "name": "barbell standing ab rollerout",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/PalLOCqcBPssxE",
                                                                "id": "0104",
                                                                "name": "barbell standing back wrist curl",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/jYTNcwzNSzjsUt",
                                                                "id": "0105",
                                                                "name": "barbell standing bradford press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/TlfAWUBkE3uMnd",
                                                                "id": "1372",
                                                                "name": "barbell standing calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/lkjikj15j8neoa",
                                                                "id": "0106",
                                                                "name": "barbell standing close grip curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/ByEgIkTrTIxF4o",
                                                                "id": "1456",
                                                                "name": "barbell standing close grip military press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/qZZot-kLFuk39Q",
                                                                "id": "2414",
                                                                "name": "barbell standing concentration curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/KAI2xGLEEizIgr",
                                                                "id": "0107",
                                                                "name": "barbell standing front raise over head",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/7LqjgbKudt4DcF",
                                                                "id": "0108",
                                                                "name": "barbell standing leg calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/DUKxgI12Y95A1t",
                                                                "id": "0109",
                                                                "name": "barbell standing overhead triceps extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/lP8C5IR4vu0TS-",
                                                                "id": "0110",
                                                                "name": "barbell standing reverse grip curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/8ExK2AJ3VfKmJ9",
                                                                "id": "0111",
                                                                "name": "barbell standing rocking leg calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/bO74QwwyOWxWjq",
                                                                "id": "0112",
                                                                "name": "barbell standing twist",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/X7K5vaDfvbeljr",
                                                                "id": "1629",
                                                                "name": "barbell standing wide grip biceps curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/U3Yi3gMr0DTkxi",
                                                                "id": "1457",
                                                                "name": "barbell standing wide military press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/nkprwalIKoh9YD",
                                                                "id": "0113",
                                                                "name": "barbell standing wide-grip curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/9zgjA2jrTo0543",
                                                                "id": "0114",
                                                                "name": "barbell step-up",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/GJKXNdtdaauG6x",
                                                                "id": "0115",
                                                                "name": "barbell stiff leg good morning",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/58WKfAR21qUhe5",
                                                                "id": "0116",
                                                                "name": "barbell straight leg deadlift",
                                                                "target": "hamstrings"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/M-pmxvJqoByRa6",
                                                                "id": "0117",
                                                                "name": "barbell sumo deadlift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/kSCUnkye4ktctD",
                                                                "id": "3305",
                                                                "name": "barbell thruster",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/u3iJX6OLTPmMhQ",
                                                                "id": "0120",
                                                                "name": "barbell upright row",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/rGfItK4ZW1hyfs",
                                                                "id": "0119",
                                                                "name": "barbell upright row v. 2",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/ovPUnHn0r7Afo3",
                                                                "id": "0121",
                                                                "name": "barbell upright row v. 3",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/GdqMQfChyn-53n",
                                                                "id": "0122",
                                                                "name": "barbell wide bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/yFW-bLJNWY4KAy",
                                                                "id": "1258",
                                                                "name": "barbell wide reverse grip bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/UYmT2wWir8rX48",
                                                                "id": "0124",
                                                                "name": "barbell wide squat",
                                                                "target": "quads"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/NjGvSNI5HGClac",
                                                                "id": "0123",
                                                                "name": "barbell wide-grip upright row",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/Iyml-H947R43pF",
                                                                "id": "0126",
                                                                "name": "barbell wrist curl",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "lower arms",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/6gWYZ9K9zZX4pg",
                                                                "id": "0125",
                                                                "name": "barbell wrist curl v. 2",
                                                                "target": "forearms"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "barbell",
                                                                "gifUrl": "https://api.exercisedb.io/image/X13V-JR7bV2ktR",
                                                                "id": "0127",
                                                                "name": "barbell zercher squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/PawGfRyEIrCBMd",
                                                                "id": "3212",
                                                                "name": "basic toe touch (male)",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "rope",
                                                                "gifUrl": "https://api.exercisedb.io/image/MsyPdizJVHC4xy",
                                                                "id": "0128",
                                                                "name": "battling ropes",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "cardio",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/Lzr6D2FD40AMoo",
                                                                "id": "3360",
                                                                "name": "bear crawl",
                                                                "target": "cardiovascular system"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "assisted",
                                                                "gifUrl": "https://api.exercisedb.io/image/HXmLs5HBpd0aXJ",
                                                                "id": "1259",
                                                                "name": "behind head chest stretch",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/LJ3ULzy-Iuc0CE",
                                                                "id": "0129",
                                                                "name": "bench dip (knees bent)",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/lYvv6utqoLiPis",
                                                                "id": "1399",
                                                                "name": "bench dip on floor",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/14NzLF-eMvB0C4",
                                                                "id": "0130",
                                                                "name": "bench hip extension",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/UPB4fyMq0K-TzV",
                                                                "id": "3019",
                                                                "name": "bench pull-ups",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/KUb3p4QYfH1LQ4",
                                                                "id": "3639",
                                                                "name": "bent knee lying twist (male)",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/IRqjfHQQdHE0Vu",
                                                                "id": "1770",
                                                                "name": "biceps leg concentration curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/LNHPjNl2tkMXcL",
                                                                "id": "0139",
                                                                "name": "biceps narrow pull-ups",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/4gckc5K6IE9iND",
                                                                "id": "0140",
                                                                "name": "biceps pull-up",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/5PDUuZ8LmVjwjs",
                                                                "id": "0137",
                                                                "name": "body-up",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/NkPIUHC7r1mron",
                                                                "id": "3543",
                                                                "name": "bodyweight drop jump squat",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/E8dYrHg-X0irub",
                                                                "id": "3544",
                                                                "name": "bodyweight incline side plank",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/OyaBxdGFUymESM",
                                                                "id": "1771",
                                                                "name": "bodyweight kneeling triceps extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/Dgv7-Z0mYdB80K",
                                                                "id": "1769",
                                                                "name": "bodyweight side lying biceps curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/5rwDe71WV4KR0T",
                                                                "id": "3168",
                                                                "name": "bodyweight squatting row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/Op4mnXgvOUPi8-",
                                                                "id": "3167",
                                                                "name": "bodyweight squatting row (with towel)",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/fTmZyR4vhxkFjA",
                                                                "id": "1373",
                                                                "name": "bodyweight standing calf raise",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/15w9JxlmH2LwtN",
                                                                "id": "3156",
                                                                "name": "bodyweight standing close-grip one arm row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/5gSbaSFWVSmuIw",
                                                                "id": "3158",
                                                                "name": "bodyweight standing close-grip row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/HB4WjW0hdl6aTa",
                                                                "id": "3162",
                                                                "name": "bodyweight standing one arm row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/F9Tuac3Up6qiWk",
                                                                "id": "3161",
                                                                "name": "bodyweight standing one arm row (with towel)",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/GOC8RZILs3rbKt",
                                                                "id": "3166",
                                                                "name": "bodyweight standing row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/4mtSiX0xR2ZHvm",
                                                                "id": "3165",
                                                                "name": "bodyweight standing row (with towel)",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/ED8ZO4gOpWd9wm",
                                                                "id": "0138",
                                                                "name": "bottoms-up",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "lower legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/fUZL3sRkgWs124",
                                                                "id": "1374",
                                                                "name": "box jump down with one leg stabilization",
                                                                "target": "calves"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/gjYs5R-TdhDxf4",
                                                                "id": "2466",
                                                                "name": "bridge - mountain climber (cross body)",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "cardio",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/mlv1NLDPsxUaJA",
                                                                "id": "1160",
                                                                "name": "burpee",
                                                                "target": "cardiovascular system"
                                                            },
                                                            {
                                                                "bodyPart": "waist",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/RDRAGXgRMSxQSM",
                                                                "id": "0870",
                                                                "name": "butt-ups",
                                                                "target": "abs"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "body weight",
                                                                "gifUrl": "https://api.exercisedb.io/image/KqrrvwW5hSA4nS",
                                                                "id": "1494",
                                                                "name": "butterfly yoga pose",
                                                                "target": "adductors"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/2TO1YqgKmzcMoa",
                                                                "id": "0148",
                                                                "name": "cable alternate shoulder press",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/yKaN7iTN3bPU7C",
                                                                "id": "0149",
                                                                "name": "cable alternate triceps extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/Y3ov4VGqkZ9YH9",
                                                                "id": "3235",
                                                                "name": "cable assisted inverse leg curl",
                                                                "target": "hamstrings"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/UZn-976cFs007Z",
                                                                "id": "0150",
                                                                "name": "cable bar lateral pulldown",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/DUO4KtWZiP4nA5",
                                                                "id": "0151",
                                                                "name": "cable bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/KCMjkXKriAeX4c",
                                                                "id": "1630",
                                                                "name": "cable close grip curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/4A5SMaCvR7M5JZ",
                                                                "id": "1631",
                                                                "name": "cable concentration curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/UdMTW3u6uXlNXh",
                                                                "id": "0152",
                                                                "name": "cable concentration extension (on knee)",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/JjiNIDvZgNiQKi",
                                                                "id": "0153",
                                                                "name": "cable cross-over lateral pulldown",
                                                                "target": "lats"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/uHLcbf6Z1qz5fl",
                                                                "id": "0154",
                                                                "name": "cable cross-over revers fly",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/sGY1sbkqn6aNdY",
                                                                "id": "0155",
                                                                "name": "cable cross-over variation",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/9-RY3f1VQWNQ8s",
                                                                "id": "0868",
                                                                "name": "cable curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/sMj7VCmfztX2zm",
                                                                "id": "0157",
                                                                "name": "cable deadlift",
                                                                "target": "glutes"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/-dA-okqdnSStqe",
                                                                "id": "0158",
                                                                "name": "cable decline fly",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/vrH8GDcUd2BEoy",
                                                                "id": "1260",
                                                                "name": "cable decline one arm press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/ogETAdhZrEas-2",
                                                                "id": "1261",
                                                                "name": "cable decline press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/EQ4YTesLx4EkEP",
                                                                "id": "0159",
                                                                "name": "cable decline seated wide-grip row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/3loyfCw9K1iOot",
                                                                "id": "1632",
                                                                "name": "cable drag curl",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/fMroWfN3aJkVMS",
                                                                "id": "0160",
                                                                "name": "cable floor seated wide-grip row",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/9IrKMKSbKo5E3l",
                                                                "id": "0161",
                                                                "name": "cable forward raise",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/So-icj4DR731HM",
                                                                "id": "0162",
                                                                "name": "cable front raise",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "shoulders",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/UTuXxzFjq-IEs5",
                                                                "id": "0164",
                                                                "name": "cable front shoulder raise",
                                                                "target": "delts"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/RH3xYI4pVZX5TQ",
                                                                "id": "0165",
                                                                "name": "cable hammer curl (with rope)",
                                                                "target": "biceps"
                                                            },
                                                            {
                                                                "bodyPart": "upper arms",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/8Fro2ezefqCynE",
                                                                "id": "1722",
                                                                "name": "cable high pulley overhead tricep extension",
                                                                "target": "triceps"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/8Hn2WGTHV3ZRQ-",
                                                                "id": "0167",
                                                                "name": "cable high row (kneeling)",
                                                                "target": "upper back"
                                                            },
                                                            {
                                                                "bodyPart": "upper legs",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/P0AmFFx6wBAUZ7",
                                                                "id": "0168",
                                                                "name": "cable hip adduction",
                                                                "target": "adductors"
                                                            },
                                                            {
                                                                "bodyPart": "chest",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/X245PLGw7-GNuS",
                                                                "id": "0169",
                                                                "name": "cable incline bench press",
                                                                "target": "pectorals"
                                                            },
                                                            {
                                                                "bodyPart": "back",
                                                                "equipment": "cable",
                                                                "gifUrl": "https://api.exercisedb.io/image/Sy9kd-ciRnfnf5",
                                                                "id": "1318",
                                                                "name": "cable incline bench row",
                                                                "target": "uppe"
                                                            }
                                                        ];

                                                        const getRandomExercise = () => {
                                                            const randomIndex = Math.floor(Math.random() * exercises.length);
                                                            const exercise = exercises[randomIndex];

                                                            document.getElementById("exerciseImage").src = exercise.gifUrl;
                                                            document.getElementById("exerciseName").textContent = `Exercise: ${exercise.name}`;
                                                            document.getElementById("exerciseTarget").textContent = `Target: ${exercise.target}`;
                                                            document.getElementById("exerciseBodyPart").textContent = `Body Part: ${exercise.bodyPart}`;
                                                            document.getElementById("exerciseEquipment").textContent = `Equipment: ${exercise.equipment}`;
                                                        };

                                                        getRandomExercise(); // Call the function when the page loads
                                                    </script>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                    </td>
                    <td>
                        <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">Your Upcoming Booking</p>
                        <center>
                            <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                <table width="85%" class="sub-table scrolldown" border="0">
                                    <thead>

                                        <tr>
                                            <th class="table-headin">


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
                                                        <td style="padding:30px;font-size:25px;font-weight:700;"> &nbsp;' .
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
                </tr>
            </table>
            </td>
            <tr>
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