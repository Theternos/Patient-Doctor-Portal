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
    <script src="../js/jquery-min.js"></script>
    <script type="text/javascript" src="../js/webcam.js"></script>
    <script src="../js/bootstrap-min.js"></script>
    <?php include("../patient/config.php") ?>
    <title>Appointments</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .checkbox-container {
            display: block;
            position: absolute;
            cursor: pointer;
            font-size: 18px;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            position: absolute;
            height: 30px;
            width: 30px;
            background-color: #eee;
            border-radius: 30px;
        }

        .checkbox-container:hover input~.checkmark {
            background-color: #ccc;
        }

        .checkbox-container input:checked~.checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked~.checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 11px;
            top: 5px;
            width: 7.5px;
            height: 16px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .popup {
            width: 60%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .pre_capture_frame {
            height: 120px !important;
            width: 240px !important;
        }


        .after_capture_frame {
            height: 120px !important;
            width: 220px !important;
        }

        w {
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #006dd3;
            font-weight: 500;
        }

        .form-label {
            font-size: 14px;
            letter-spacing: 1px;
        }

        .Next-appointment {
            width: 120px;
            height: 30px;
            font-size: 14px;
            width: 70%;
            margin-top: 5px;
        }

        .aliging-center {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        #take_snap_btn {
            transform: scale(.8) !important;
        }

        #my_camera {
            max-width: 240px !important;
            max-height: 120px !important;
            margin: 0 9vw 5vh 0;
            transform: scale(.18) !important;

        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();
    error_reporting(0);
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
                                    <p class="profile-title"><?php echo substr($username, 0, 13)  ?></p>
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
                    <td class="menu-btn menu-icon-dashbord ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
                <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
                    <div>
                        <p class="menu-text">My Appointments</p>
                </a>
    </div>
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
                    <a href="appointment.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Appointment Manager</p>

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
                        $searchtype = 'My';
                        $sqlmain = "SELECT patient.pid, appointment.appoid,`schedule`.scheduleid,`schedule`.title,doctor.docname,patient.pname,`schedule`.scheduledate,`schedule`.scheduletime,appointment.apponum,appointment.appodate from `schedule` inner join appointment on `schedule`.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid inner join metrices on appointment.appoid = metrices.appoid WHERE doctor.docid='$userid' and appointment.status=0";
                        // echo $sqlmain;
                        if ($_POST) {
                            //print_r($_POST);

                            if (!empty($_POST["sheduledate"])) {
                                $sheduledate = $_POST["sheduledate"];
                                $sqlmain .= " and `schedule`.scheduledate='$sheduledate'";
                                $searchtype = 'Searched';
                            };
                            //echo $sqlmain;
                        }
                        $result = $database->query($sqlmain);

                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>
            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">
                        <?php echo $searchtype; ?> Appointments (<?php if ($result->num_rows != NULL) {
                                                                        echo $result->num_rows;
                                                                    } else {
                                                                        echo '0';
                                                                    } ?>)
                    </p>
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
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            Patient ID
                                        </th>
                                        <th class="table-headin">
                                            Patient name
                                        </th>
                                        <th class="table-headin">

                                            Appointment number

                                        </th>

                                        <th class="table-headin">


                                            Session Title

                                        </th>

                                        <th class="table-headin">

                                            Session Date & Time

                                        </th>

                                        <th class="table-headin">

                                            Appointment Date

                                        </th>

                                        <th class="table-headin">

                                            Events

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    // echo $sqlmain . '<br>';

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                        <img src="../img/notfound.svg" width="25%"><br>
                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                        <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button></a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $pid = $row["pid"];
                                            $appoid = $row["appoid"];
                                            $scheduleid = $row["scheduleid"];
                                            $title = $row["title"];
                                            $docname = $row["docname"];
                                            $scheduledate = $row["scheduledate"];
                                            $twentyfourHourtime = $row["scheduletime"];
                                            $scheduletime = date("h:i A", strtotime($twentyfourHourtime));
                                            $pname = $row["pname"];
                                            $apponum = $row["apponum"];
                                            $appodate = $row["appodate"];
                                            echo '<tr>
                                            <td style="text-align:center;">P-' . $pid . '</td>
                                            <td style="font-weight:600; text-align:center;">' . substr($pname, 0, 25) . '</td >
                                            <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">' . $apponum . '</td>
                                            <td>' . substr($lang[$title], 0, 100) . '</td>
                                            <td style="text-align:center;;">' . substr($scheduledate, 0, 10) . ' @ ' . substr($scheduletime, 0, 8) . '</td>
                                            <td style="text-align:center;">' . $appodate . '</td>
                                            <td>
                                                <div style="display:flex;justify-content: center;">
                                                <a href="?action=drop&id=' . $appoid . '&name=' . $pname . '&session=' . $title . '&apponum=' . $apponum . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text"></font>Dismiss</button></a>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="?action=consulting&id=' . $appoid . '&pid=' . $pid . '&scheduleid=' . $scheduleid . '"><button  class="btn-primary-soft btn button-icon btn-task"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                                &nbsp;&nbsp;&nbsp;
                                            </div>
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
    </div>
    </div>
    <?php

    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            $nameget = $_GET["name"];
            $session = $_GET["session"];
            $apponum = $_GET["apponum"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br><br>
                            Patient Name: &nbsp;<b>' . substr($nameget, 0, 40) . '</b><br>
                            Appointment number &nbsp; : <b>' . substr($apponum, 0, 40) . '</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($_GET['remove_review'] == 'true') {
            $pid = $_GET["pid"];
            $appoid = $_GET["appoid"];
            $result = $database->query("DELETE from doc_review WHERE appoid = $appoid and pid = $pid and docid = $userid and seen_status = 0");
        } elseif ($action == 'consulting') {
            $pid = $_GET["pid"];
            $scheduleid = $_GET["scheduleid"];
            $sqlmain = "SELECT * from appointment inner join schedule on schedule.scheduleid = appointment.scheduleid inner join patient on patient.pid = appointment.pid inner join metrices on metrices.appoid=appointment.appoid WHERE appointment.pid = '$pid' and appointment.scheduleid='$scheduleid' and schedule.docid = '$userid'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $pname = $row['pname'];
            $pid = $row['pid'];
            $weight = $row['weight'];
            $height = $row['height'];
            $sugar = $row['sugar'];
            $bp = $row['bp'];
            $temp = $row['temp'];
            $allergy = $row['allergy'];
            $reason = $row['reason'];
            $appoid = $row['appoid'];
            $uid = $row['uid'];
            $result1 = $database->query("SELECT drid FROM doc_review WHERE docid = '$userid' and pid = '$pid' and appoid = '$appoid' and seen_status = '0'");
            if ($result1 === null || $result1->num_rows === 0) {
                $database->query("INSERT INTO doc_review (docid, pid, appoid, rating) VALUES ('$userid', '$pid', '$appoid', '0')");
            }



    ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <a class="close" href="appointment.php?remove_review=true&appoid=<?php echo $appoid ?>&pid=<?php echo $pid ?>">&times;</a>
                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <form action="file-upload.php" id="uploadForm" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="pid" value="<?php echo $pid ?>">
                                    <input type="hidden" name="scheduleid" value="<?php echo $scheduleid ?>">
                                    <input type="hidden" name="appoid" value="<?php echo $appoid ?>">
                                    <input type="hidden" name="uid" value="<?php echo $uid ?>">
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;text-align:center;">Patient Report.</p><br><br>
                                        </td>
                                    </tr>
                                    <div>

                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="pid" class="form-label">
                                                    <w>Patient Id: </w><?php echo $pid ?>
                                                </label>
                                                <label for="name" class="form-label" style="margin-left: 8.5vw;">
                                                    <w>Name: </w><?php echo $pname ?>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="pid" class="form-label">
                                                    <w>Height: </w><?php echo $height  . ' cm' ?>
                                                </label>
                                                <label for="name" class="form-label" style="margin-left: 7.4vw;">
                                                    <w>Weight: </w><?php echo $weight . ' kg' ?>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="pid" class="form-label">
                                                    <w>Sugar: </w><?php echo $sugar  . ' mM' ?>
                                                </label>
                                                <label for="name" class="form-label" style="margin-left: 8vw;">
                                                    <w>Blood Pressure: </w><?php echo $bp  . ' mmHg' ?>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="pid" class="form-label">
                                                    <w>Temperature: </w><?php echo $temp  . ' °F' ?>
                                                </label>
                                                <label for="name" class="form-label" style="margin-left: 4.3vw;">
                                                    <w>Allergy: </w><?php echo $allergy ?>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="name" class="form-label">
                                                    <w>Reason: </w><?php echo $reason ?>
                                                </label>
                                            </td>
                                        </tr>
                                    </div>
                                    <tr>
                                        <td class="label-td" colspan="2">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex; flex-direction:row; justify-content:space-around;">
                                                <w class="Next-appointment">Next Appointment: </w>
                                                <select id="nextappointchoice" name="nextappointchoice" class="box" style="width:130%">
                                                    <option value="Needed">Needed</option>
                                                    <option value="Not needed">Not needed</option>
                                                </select>
                                                &nbsp; &nbsp;
                                                <input type="number" id="nextappointment" name="nextappointment" class="box" placeholder="Enter next appointment">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <w class="Next-appointment;">Select Content: </w>
                                                <input type="radio" name="documentType" value="prescription" checked> Prescription
                                                <input type="radio" name="documentType" value="report"> Report
                                                <input type="radio" name="documentType" value="both"> Both
                                                <input type="radio" name="documentType" value="none"> None
                                            </div>
                                            <br />
                                            <div style="display:flex; flex-direction:row; justify-content:space-around; align-items: center;">
                                                <div class="row" id="cameraContainer">
                                                    <div style="display:flex; flex-direction:row; justify-content:space-around;">
                                                        <div class="col-lg-6 aliging-center">
                                                            <div id="my_camera" class="pre_capture_frame"></div>
                                                            <input type="hidden" name="captured_image_data" id="captured_image_data">
                                                            <br>
                                                            <input id="take_snap_btn" type="button" class="login-btn btn-primary-soft btn" value="Capture" onClick="take_snapshot()">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div id="results"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="fileInput" style="display: none; transform:scale(.8)">
                                                    <input type="file" id="reportInput" name="uploadedFile" hidden />
                                                    <label class="btn-primary-soft btn fileInput" for="reportInput">Choose File</label>
                                                    <span id="file-chosen">No file chosen</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div style="display:flex; flex-direction:column; justify-content:center; align-items: center;"> <button style=" min-width:100%;margin-top:2vh" type="submit" name='upload-btn' onclick="savephoto()" class="login-btn btn-primary-soft btn">Upload</button></div>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>
    <?php        }
    }
    ?>

    </div>
    <script language="JavaScript">
        // Configure a few settings and attach camera 250x187
        const my_camera = document.getElementById("my_camera");
        const take_snap_btn = document.getElementById("take_snap_btn");


        Webcam.set({
            width: 960,
            height: 580,
            image_format: 'png'
        });
        Webcam.attach('#my_camera');


        function take_snapshot() {
            // play sound effect
            //shutter.play();
            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
                // display results in page
                document.getElementById('results').innerHTML =
                    '<img class="after_capture_frame" src="' + data_uri + '"/>';
                $("#captured_image_data").val(data_uri);
            });
            my_camera.style.display = 'none';
            take_snap_btn.style.display = 'none';

        }

        function savephoto() {
            function saveSnap() {
                var base64data = $("#captured_image_data").val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "process_upload.php",
                    data: {
                        image: base64data
                    },
                });
            }

            if ($("#captured_image_data").val()) {
                saveSnap();
            }


        }
    </script>
    <script>
        const prescriptionRadio = document.querySelector('input[value="prescription"]');
        const reportRadio = document.querySelector('input[value="report"]');
        const bothRadio = document.querySelector('input[value="both"]');
        const noneRadio = document.querySelector('input[value="none"]');
        const cameraContainer = document.getElementById("cameraContainer");
        const reportInput = document.getElementById('reportInput');
        const fileChosenLabel = document.getElementById('file-chosen');
        const capturedImage = document.getElementById("capturedImage");
        const selectElement = document.getElementById('nextappointchoice');
        const inputElement = document.getElementById('nextappointment');

        // Function to toggle input requirement and visibility
        function toggleInput() {
            if (selectElement.value === 'Needed') {
                inputElement.required = true;
                inputElement.style.display = 'block';
            } else {
                inputElement.required = false;
                inputElement.style.display = 'none';
            }
        }
        // Set the initial state to "Needed"
        selectElement.value = 'Not needed';
        toggleInput();

        // Add event listener to detect changes in the select element
        selectElement.addEventListener('change', toggleInput);

        reportInput.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            fileChosenLabel.textContent = fileName;
        });
        reportRadio.addEventListener('change', function() {
            if (reportRadio.checked) {
                fileInput.style.display = 'block';
                cameraContainer.style.display = 'none';
                fileInput.style.margin = "1rem 0 1rem 0";
            }
        });
        prescriptionRadio.addEventListener('change', function() {
            if (prescriptionRadio.checked) {
                fileInput.style.display = 'none';
                cameraContainer.style.display = 'block';
            }
        });
        bothRadio.addEventListener('change', function() {
            if (bothRadio.checked) {
                fileInput.style.display = 'block';
                cameraContainer.style.display = 'block';
                cameraContainer.style.marginLeft = '0';
                fileInput.style.margin = "0 0 0 0";
                fileInput.style.marginLeft = "1rem";
            }
        });
        noneRadio.addEventListener('change', function() {
            if (noneRadio.checked) {
                fileInput.style.display = 'none';
                cameraContainer.style.display = 'none';
            }
        });
    </script>
</body>

</html>