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

    <title>Add Info</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.25s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.25s;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'r') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }

    error_reporting(0);

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from others where oemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["oid"];
    $username = $userfetch["oname"];

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
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Home</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-add menu-icon-add-active menu-active">
                        <a href="reception-test.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Add Info</p>
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
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">All Patients</p>
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
                        <a href="reception-test.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <form action="" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Patient name or Email" list="doctors">&nbsp;&nbsp;
                            <?php
                            echo '<datalist id="doctors">';
                            date_default_timezone_set('Asia/Kolkata');

                            $date = date('Y-m-d');
                            $sql11 = "SELECT patient.pname, patient.pemail from patient inner join appointment on patient.pid = appointment.pid ORDER BY patient.pname ASC";
                            echo $sql11;
                            $list11 = $database->query($sql11);
                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                $row00 = $list11->fetch_assoc();
                                $d = $row00["pname"];
                                $c = $row00["pemail"];
                                echo "<option value='$d'><br/>";
                                echo "<option value='$c'><br/>";
                            };

                            echo ' </datalist>';
                            ?>
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                        </form>
                        <?php
                        $a = 1;
                        if ($_POST) {
                            $keyword = $_POST["search"];
                            $a = 0;
                            $sqlmain = "SELECT patient.pid, doctor.docid, patient.pname, doctor.docname, appointment.apponum, appointment.appoid, schedule.scheduledate, schedule.scheduleid, schedule.scheduletime from appointment inner join patient on patient.pid = appointment.pid inner join schedule on schedule.scheduleid = appointment.scheduleid inner join doctor on doctor.docid = schedule.docid where schedule.scheduledate = '$date' and doctor.docemail='$keyword' or doctor.docname='$keyword' or doctor.docname like '$keyword%' or doctor.docname like '%$keyword' or doctor.docname like '%$keyword%' or patient.pemail='$keyword' or patient.pname='$keyword' or patient.pname like '$keyword%' or patient.pname like '%$keyword' or patient.pname like '%$keyword%' ORDER BY schedule.scheduledate , schedule.scheduletime, appointment.appoid ASC;";
                        } else {
                            $a = 1;
                            $sqlmain = "SELECT patient.pid, doctor.docid, patient.pname, doctor.docname, appointment.apponum, appointment.appoid, schedule.scheduledate, schedule.scheduleid,  schedule.scheduletime from appointment inner join patient on patient.pid = appointment.pid inner join schedule on schedule.scheduleid = appointment.scheduleid inner join doctor on doctor.docid = schedule.docid where schedule.scheduledate = '$date' ORDER BY schedule.scheduledate , schedule.scheduletime, appointment.appoid ASC;";
                        }
                        $result = $database->query($sqlmain);

                        ?>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            echo $date;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Appointments (<?php echo $result->num_rows; ?>)</p>
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
                                                Patient Name
                                            </th>
                                            <th class="table-headin">
                                                Appointment Number
                                            </th>
                                            <th class="table-headin">

                                                Doctor Name
                                            </th>
                                            <th class="table-headin">

                                                Sheduled Date & Time
                                            </th>
                                            <th class="table-headin">
                                                Events
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php


                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="reception-test.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                        } else {
                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                $row = $result->fetch_assoc();
                                                $pid = $row["pid"];
                                                $docid = $row["docid"];
                                                $appoid = $row["appoid"];
                                                $pname = $row["pname"];
                                                $docname = $row["docname"];
                                                $apponum = $row["apponum"];
                                                $appodate = $row["scheduledate"];
                                                $twentyfourHourtime = $row["scheduletime"];
                                                $appotime = date("h:i A", strtotime($twentyfourHourtime));
                                                $scheduleid = $row["scheduleid"];
                                                $sql123 = "SELECT `uid` from metrices where appoid = '$appoid' and pid = '$pid' and scheduleid = '$scheduleid'";
                                                $result123 = $database->query($sql123);
                                                echo '<tr style="height:70px;">
                                                    <td><center>' . substr($pname, 0, 30) . '</center></td>
                                                    <td><center>' . substr($apponum, 0, 20) . '</center></td>
                                                    <td><center>' . substr($docname, 0, 20) . '</center></td>
                                                    <td><center>' . substr($appodate, 0, 20) . ' <b>@</b> ' . substr($appotime, 0, 20) . '</center></td>
                                                    <td>
                                                    <div style="display:flex;justify-content: center;">';
                                                if ($result123->num_rows == null) {
                                        ?>
                                                    <a href="?action=add&id=<?php echo $pid ?>&appoid=<?php echo $appoid ?>&scheduleid=<?php echo $scheduleid ?>&docid=<?php echo $docid ?>" class="non-style-link">
                                                        <button class="btn-primary-soft btn button-icon btn-add" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;">
                                                            <font class="tn-in-text">Add info</font>
                                                        </button>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="?action=edit&id=<?php echo $pid ?>&appoid=<?php echo $appoid ?>&scheduleid=<?php echo $scheduleid ?>&docid=<?php echo $docid ?>" class="non-style-link">
                                                        <button class="btn-primary-soft btn button-icon btn-edit" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;">
                                                            <font class="tn-in-text">Change&nbsp;</font>
                                                        </button>
                                                    </a>
                                        <?php    }
                                                echo '
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
        $pid = $_GET["id"];
        $docid = $_GET["docid"];
        $appoid = $_GET["appoid"];
        $scheduleid = $_GET["scheduleid"];
        $action = $_GET["action"];
        if ($action == 'add') { ?>

            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="reception-test.php?action= ">&times;</a>
                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: center;font-size: 25px;font-weight: 500;">Add Details.</p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="pid" class="form-label">Patient ID: <?php echo $pid ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="name" class="form-label">Patient Name: <?php echo $pname ?></label>
                                        <br><br>
                                    </td>
                                </tr>
                                <form action="" method="POST">
                                    <input type="hidden" name="pid" value=<?php echo $pid; ?>>
                                    <input type="hidden" name="docid" value="<?php echo $docid; ?>">
                                    <input type="hidden" name="appoid" value="<?php echo $appoid; ?>">
                                    <input type="hidden" name="scheduleid" value="<?php echo $scheduleid; ?>">

                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="height" class="form-label">Height:&nbsp; </label>
                                            <input class="input-text" type="number" name="height" placeholder="Height in cm" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="weight" class="form-label">Weight:&nbsp;</label>
                                            <input class="input-text" type="number" name="weight" placeholder="Weight in kg" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="sugar" class="form-label">Sugar:&nbsp;&nbsp; </label>
                                            <input class="input-text" type="number" name="sugar" placeholder="Sugar" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="blood_pressure" class="form-label">BP:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                                            <input class="input-text" type="number" name="blood_pressure" placeholder="Blood Pressure" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="temperature" class="form-label">Temp:&nbsp;&nbsp;&nbsp; </label>
                                            <input class="input-text" type="text" name="temperature" placeholder="Temperature in Farenheit" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="reason" class="form-label">Reason: </label>
                                            <input class="input-text" type="text" name="reason" placeholder="Reason" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="spec" class="form-label">Allergy:&nbsp; </label>
                                            <select name="allergy" class="input-text">
                                                <option>No</option>
                                                <option>Yes</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>
                                            <center>
                                                <button name="add_info" class="login-btn btn-primary-soft btn">Update</button>
                                            </center>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>
        <?php
        }
        if ($action == 'edit') {
            $sql123 = "SELECT * FROM peas.metrices WHERE pid = '$pid' AND docid = '$docid' AND scheduleid = '$scheduleid'";
            $result123 = $database->query($sql123);
            $userfetch = $result123->fetch_assoc();
            $pid = $userfetch['pid'];
            $docid = $userfetch['docid'];
            $appoid = $userfetch['appoid'];
            $scheduleid = $userfetch['scheduleid'];
            $height = $userfetch['height'];
            $weight = $userfetch['weight'];
            $sugar = $userfetch['sugar'];
            $blood_pressure = $userfetch['bp'];
            $temperature = $userfetch['temp'];
            $reason = $userfetch['reason'];
            $allergy = $userfetch['allergy'];
        ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="reception-test.php?action= ">&times;</a>
                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: center;font-size: 25px;font-weight: 500;">Edit Details.</p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="pid" class="form-label">Patient ID: <?php echo $pid ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="name" class="form-label">Patient Name: <?php echo $pname ?></label>
                                        <br><br>
                                    </td>
                                </tr>
                                <form action="" method="POST">
                                    <input type="hidden" name="pid" value=<?php echo $pid; ?>>
                                    <input type="hidden" name="docid" value="<?php echo $docid; ?>">
                                    <input type="hidden" name="appoid" value="<?php echo $appoid; ?>">
                                    <input type="hidden" name="scheduleid" value="<?php echo $scheduleid; ?>">

                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="height" class="form-label">Height:&nbsp; </label>
                                            <input class="input-text" type="number" name="height" value="<?php echo $height ?>" placeholder="Height in cm" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="weight" class="form-label">Weight:&nbsp;</label>
                                            <input class="input-text" type="number" name="weight" value="<?php echo $weight ?>" placeholder="Weight in kg" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="sugar" class="form-label">Sugar:&nbsp;&nbsp; </label>
                                            <input class="input-text" type="number" name="sugar" value="<?php echo $sugar ?>" placeholder="Sugar" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="blood_pressure" class="form-label">BP:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                                            <input class="input-text" type="number" name="blood_pressure" value="<?php echo $blood_pressure ?>" placeholder="Blood Pressure" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="temperature" class="form-label">Temp:&nbsp;&nbsp;&nbsp; </label>
                                            <input class="input-text" type="text" name="temperature" value="<?php echo $temperature ?>" placeholder="Temperature in Farenheit" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="reason" class="form-label">Reason: </label>
                                            <input class="input-text" type="text" name="reason" value="<?php echo $reason ?>" placeholder="Reason" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2" style="display:flex; flex-direction:row;">
                                            <label style="margin-top: 8px; margin-right:8px;" for="spec" class="form-label">Allergy:&nbsp; </label>
                                            <select name="allergy" class="input-text">
                                                <option><?php echo $allergy ?></option>
                                                <option>No</option>
                                                <option>Yes</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>
                                            <center>
                                                <button name="edit_info" class="login-btn btn-primary-soft btn">Update</button>
                                            </center>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>
        <?php    }
        if (isset($_POST['add_info'])) {
            $pid = $_POST['pid'];
            $docid = $_POST['docid'];
            $appoid = $_POST['appoid'];
            $scheduleid = $_POST['scheduleid'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $sugar = $_POST['sugar'];
            $blood_pressure = $_POST['blood_pressure'];
            $temperature = $_POST['temperature'];
            $reason = $_POST['reason'];
            $allergy = $_POST['allergy'];
            $sql = "INSERT INTO `peas`.`metrices` (`pid`, `docid`, `appoid`, `scheduleid`, `weight`, `height`, `sugar`, `bp`, `temp`, `reason`, `allergy`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $database->prepare($sql);
            $stmt->bind_param("sssssssssss", $pid, $docid, $appoid, $scheduleid, $weight, $height, $sugar, $blood_pressure, $temperature, $reason, $allergy);
            $stmt->execute(); ?>
            <script>
                window.location.href = "./reception-test.php";
            </script>
        <?php }
        if (isset($_POST['edit_info'])) {
            $pid = $_POST['pid'];
            $docid = $_POST['docid'];
            $appoid = $_POST['appoid'];
            $scheduleid = $_POST['scheduleid'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $sugar = $_POST['sugar'];
            $blood_pressure = $_POST['blood_pressure'];
            $temperature = $_POST['temperature'];
            $reason = $_POST['reason'];
            $allergy = $_POST['allergy'];
            $sql = "UPDATE `peas`.`metrices` SET height = '$height', `weight` = '$weight', sugar = '$sugar', bp = '$blood_pressure', temp = '$temperature', reason = '$reason', allergy = '$allergy' WHERE appoid = '$appoid' and pid = '$pid'";
            $result = $database->query($sql); ?>
            <script>
                window.location.href = "./reception-test.php";
            </script>
    <?php    }
    }; ?>

    </div>

</body>

</html>