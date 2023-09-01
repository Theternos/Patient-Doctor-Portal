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
    <title>Appointments</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();
    error_reporting(0);
    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'l') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }



    //import database
    include("../connection.php");
    $userrow = $database->query("select * from laboratory where lemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["lid"];
    $username = $userfetch["lname"];
    $mtid = $userfetch["mtid"];
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
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Home</p>
                            </div>
                        </a>
                    </td>
                </tr>
                </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
                        <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">My Appointments</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient">
                        <a href="patients.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Patients</p>
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
                            $sqlmain = "SELECT * from test_booking INNER JOIN patient on patient.pid = test_booking.pid WHERE `status` = 0 and mtid = '$mtid'";
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
                                                Session Title
                                            </th>
                                            <th class="table-headin">
                                                Booked Date
                                            </th>
                                            <th class="table-headin">
                                                Events
                                            </th>
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
                                            $title_result = $database->query("SELECT tname from medical_test WHERE mtid = '$mtid'");
                                            $title_row = $title_result->fetch_assoc();
                                            $title = $title_row['tname'];
                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                $row = $result->fetch_assoc();
                                                $pid = $row["pid"];
                                                $pname = $row["pname"];
                                                $appodate = $row["booked_time"];
                                                echo '<tr>
                                            <td style="text-align:center;">P-' . $pid . '</td>
                                            <td style="font-weight:600; text-align:center;">' . substr($pname, 0, 25) . '</td >
                                            <td style="text-align:center;">' . substr($title, 0, 15) . '</td>
                                            <td style="text-align:center;">' . substr($appodate, 0, 10) . '</td>
                                            <td>
                                                <div style="display:flex;justify-content: center;">
                                                <a href="?action=consulting&mtid=' . $mtid . '&pid=' . $pid . '"><button  class="btn-primary-soft btn button-icon btn-task"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Seen</font></button></a>
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
        if ($action == 'consulting') {
            $pid = $_GET["pid"];
            $mtid = $_GET["mtid"];
            $sqlmain = "SELECT * from test_booking WHERE pid='$pid' and mtid = '$mtid' and `status` = 0";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
    ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <a class="close" href="appointment.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <form action="file-upload.php" id="uploadForm" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="mtid" value="<?php echo $mtid; ?>">
                                    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                                    <input type="hidden" name="tid" value="<?php echo $row['tid']; ?>">
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;text-align:center;">Upload Report.</p><br><br>
                                        </td>
                                    </tr>

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
                                            <div style="display:flex; flex-direction:row; justify-content:space-around; align-items: center;">
                                                <div id="fileInput" style="transform:scale(.8)">
                                                    <input type="file" id="reportInput" name="uploadedFile" hidden />
                                                    <label class="btn-primary-soft btn fileInput" for="reportInput">Choose File</label>
                                                    <span id="file-chosen">No file chosen</span><br /><br />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div style="display:flex; flex-direction:column; justify-content:center; align-items: center;">
                                                <button style="min-width:100%; margin-top:2vh" type="submit" name="upload-btn" class="login-btn btn-primary-soft btn disabled" id="uploadButton">Upload</button>
                                            </div>
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

</body>
<script>
    const fileInput = document.getElementById('reportInput');
    const uploadButton = document.getElementById('uploadButton');
    const fileChosen = document.getElementById('file-chosen');

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileChosen.textContent = `${fileInput.files[0].name}`;
        } else {
            fileChosen.textContent = 'No file chosen';
        }
    });
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            uploadButton.classList.remove('disabled');
        } else {
            uploadButton.classList.add('disabled');
        }
    });
</script>

</html>