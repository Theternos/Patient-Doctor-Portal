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

    <title>Donors</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.25s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.25s;
        }

        .donations {
            width: 60vw;
            margin: auto;
        }

        .options {
            width: 45%;
            border: 1px solid #ccc;
            border-radius: 5px;
            justify-content: flex-start;
            padding: 5px 5px 5px 20px;
        }

        .options:hover {
            border: 1px solid #aaa;
            cursor: pointer;
        }

        .options p {
            margin-left: 20px;
            font-size: 18px;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 1px;
            font-weight: 500;
        }

        #expandable-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .tests-view {
            font-size: 18px;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 1px;
            font-weight: 500;
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
    if ($_POST) {
        $blood_group = $_POST['blood_group'];
        $units = $_POST['blood_units'];
        $sql = $database->query("INSERT INTO blood_group_request (blood_group, unit) VALUES ('$blood_group', '$units')");
    ?> <script>
            window.location.href = './requirement.php?action=blood_donor&sms_status=sms_sent';
        </script>
    <?php   }
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
                    <td class="menu-btn menu-icon-add">
                        <a href="reception-test.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Add Info</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-donation-active menu-active">
                        <a href="requirement.php?action=blood_donor" class="non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Donors</p>
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
                        <a href="requirement.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button>
                        </a>
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
                    <td colspan="4" style="padding-top: 4vh;">
                        <div style="justify-content: center;" class="flex-row">
                            <p class="heading-main12" style="margin-left: 45px; font-size: 18px; color: rgb(49, 49, 49)">Select Types:</p>
                            <div class="flex-row donations">
                                <div class="flex-row options" id="bloodDonorOption" style="border: 1px solid #000;">
                                    <img src="../img/sicon/blood-donor.svg" alt="Blood Donation" width="35px">
                                    <p>Blood Donors</p>
                                </div>
                                <div class="flex-row options" id="organDonorOption">
                                    <img src="../img/sicon/organ-donor.svg" alt="Organ Donation" width="35px">
                                    <p>Organ Donors</p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div id="blood_donor_list">
                <?php
                $a = 1;
                if ($_POST) {
                    $keyword = $_POST["search"];
                    $a = 0;
                    $sqlmain = "SELECT * from patient WHERE patient.pname='$keyword' or patient.pname like '$keyword%' or patient.pname like '%$keyword' or patient.pname like '%$keyword%' or patient.pemail='$keyword' or patient.pemail like '$keyword%' or patient.pemail like '%$keyword' or patient.pemail like '%$keyword%' or patient.blood_group='$keyword' or patient.blood_group like '$keyword%' or patient.blood_group like '%$keyword' or patient.blood_group like '%$keyword%' ORDER BY pname ASC";;
                } else {
                    $a = 1;
                    $sqlmain = "SELECT * from patient";
                }
                $result = $database->query($sqlmain);

                ?>
                <tr>
                    <div class="flex-row" style="justify-content:start; align-items:center;">
                        <td colspan="4" style="padding-top:10px;">
                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Patients (<?php echo $result->num_rows; ?>)</p>
                        </td>
                        <td>
                            <a id="expand-sms" style="text-decoration: none; margin-left:auto; margin-right: 3vw; cursor:pointer;">
                                <div class="h3-search flex-row tests-view" style=" color:#000; font-size:15px; margin-top:0;">
                                    <p>Request Blood</p> <img src="../img/down-arrow.svg" alt="Arrow Icon" width="18px" style="margin-left: 5px;">
                                </div>
                            </a>
                        </td>
                    </div>
                    <div id="expandable-content" style="margin: auto; padding: 0 0 0 3vw;">
                        <form action="" method="post">
                            <div class="flex-row" style="justify-content: start; align-items:center; margin-bottom: 20px;">
                                <div class="flex-row" style="justify-content: space-around; align-items:center">
                                    <label for="blood_group">Select Blood Group : &nbsp;</label>
                                    <select class="input-text" name="blood_group" id="" style="width: fit-content;">
                                        <option value="A+ ve">A+ ve</option>
                                        <option value="A- ve">A- ve</option>
                                        <option value="B+ ve">B+ ve</option>
                                        <option value="B- ve">B- ve</option>
                                        <option value="O+ ve">O+ ve</option>
                                        <option value="O- ve">O- ve</option>
                                        <option value="AB+ ve">AB+ ve</option>
                                        <option value="AB- ve">AB- ve</option>
                                        <option value="Bombay Blood Group">Bombay Blood Group</option>
                                    </select>&nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="flex-row" style="justify-content: space-around; align-items:center; margin-left: 10px">
                                    <label for="blood_group" style="margin-right: 10px">Units&nbsp;:</label>
                                    <input class="input-text" name="blood_units" type="number" value="1" required />&nbsp;&nbsp;&nbsp;
                                </div>
                                <input type="submit" value="Send" class="login-btn btn-primary btn">
                            </div>
                        </form>
                    </div>
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
                                                Patient Name
                                            </th>
                                            <th class="table-headin">
                                                Blood Group
                                            </th>
                                            <th class="table-headin">
                                                Phone number
                                            </th>
                                            <th class="table-headin">
                                                Events
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (($result->num_rows) == null) {
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
                                                $pname = $row["pname"];
                                                $ptel = $row["ptel"];
                                                $blood_group = $row["blood_group"];
                                                $pid = $row["pid"];
                                                echo '<tr style="height:70px;">
                                                    <td><center>P - ' . substr($pid, 0, 30) . '</center></td>
                                                    <td><center>' . substr($pname, 0, 30) . '</center></td>
                                                    <td><center>' . substr($blood_group, 0, 20) . '</center></td>
                                                    <td><center>' . substr($ptel, 0, 13) . '</center></td>
                                                    <td>
                                                    <div style="display:flex;justify-content: center;">'; ?>
                                                <a href="?action=blood_donor&patient_details=blood_view&id=<?php echo $pid ?>" class="non-style-link">
                                                    <button class="btn-primary-soft btn button-icon btn-view" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;">
                                                        <font class="tn-in-text">View</font>
                                                    </button>
                                                </a>
                                        <?php
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </center>
                    </td>
                </tr>
                <?php if ($_GET['patient_details'] == 'blood_view') {
                    $id = $_GET['id'];
                    $sqlmain = "select * from patient where pid=?";
                    $stmt = $database->prepare($sqlmain);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $name = $row["pname"];
                    $email = $row["pemail"];
                    $address = $row["paddress"];
                    $b_group = $row["blood_group"];
                    $dob = $row["pdob"];
                    $tele = $row['ptel'];
                    $age = $date - $dob;
                ?>
                    <div id="popup1" class="overlay">
                        <div class="popup" style="transform: scale(.95); margin-top: 2vh">
                            <center>
                                <h2></h2>
                                <a class="close" href="requirement.php?action=blood_donor">&times;</a>

                                <div style="display: flex;justify-content: center;">
                                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">

                                        <tr>
                                            <td>
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Details of Patient</p><br><br>
                                            </td>
                                        </tr>

                                        <tr>

                                            <td class="td-label" colspan="2">
                                                <label for="name" class="form-label">Name</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td display-text" colspan="2">
                                                <?php echo $name ?><br><br>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="td-label" colspan="2">
                                                <label for="Email" class="form-label">Email</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td display-text" colspan="2">
                                                <?php echo $email ?><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label" colspan="2">
                                                <label for="b_group" class="form-label">Blood Group</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td display-text" colspan="2">
                                                <?php echo $b_group ?><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label" colspan="2">
                                                <label for="Tele" class="form-label">Phone Number</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td display-text" colspan="2">
                                                <?php echo $tele ?><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label" colspan="2">
                                                <label for="address" class="form-label">Address</label>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td display-text" colspan="2">
                                                <?php echo $address ?><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label" colspan="2">
                                                <label for="spec" class="form-label">Date of Birth</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td display-text" colspan="2">
                                                <?php echo $dob . ' - [ ' . $age . ' Years ]' ?><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <center><a href="requirement.php?action=blood_donor"><input type="button" value="Okay" class="login-btn btn-primary-soft btn"></a></center>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </center>
                            <br><br>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="organ_donor_list" style="display:none;">
                <?php
                $a = 1;
                if ($_POST) {
                    $keyword = $_POST["search"];
                    $a = 0;
                    $sqlmain = "SELECT DISTINCT(organ_donation.pid), organ_donation.*, patient.* from patient INNER JOIN organ_donation on organ_donation.pid = patient.pid WHERE patient.pname='$keyword' or patient.pname like '$keyword%' or patient.pname like '%$keyword' or patient.pname like '%$keyword%' or patient.pemail='$keyword' or patient.pemail like '$keyword%' or patient.pemail like '%$keyword' or patient.pemail like '%$keyword%' or organ_donation.organ='$keyword' or organ_donation.organ like '$keyword%' or organ_donation.organ like '%$keyword' or organ_donation.organ like '%$keyword%' ORDER BY pname ASC";;
                } else {
                    $a = 1;
                    $sqlmain = "SELECT DISTINCT(organ_donation.pid), organ_donation.*, patient.* from patient INNER JOIN organ_donation on organ_donation.pid = patient.pid";
                }
                $result = $database->query($sqlmain);

                ?>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Registered Patients (<?php echo $result->num_rows; ?>)</p>
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
                                                Patient Name
                                            </th>
                                            <th class="table-headin">
                                                Blood Group
                                            </th>
                                            <th class="table-headin">
                                                Organ Name
                                            </th>
                                            <th class="table-headin">
                                                Phone number
                                            </th>
                                            <th class="table-headin">
                                                Events
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $action = $_GET["action"];
                                        if (($result->num_rows) == null) {
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
                                                $pname = $row["pname"];
                                                $ptel = $row["ptel"];
                                                $blood_group = $row["blood_group"];
                                                $organ = $row["organ"];
                                                $pid = $row["pid"];
                                                echo '<tr style="height:70px;">
                                                    <td><center>P - ' . substr($pid, 0, 30) . '</center></td>
                                                    <td><center>' . substr($pname, 0, 30) . '</center></td>
                                                    <td><center>' . substr($blood_group, 0, 20) . '</center></td>
                                                    <td><center>' . substr($organ, 0, 20) . '</center></td>
                                                    <td><center>' . substr($ptel, 0, 13) . '</center></td>
                                                    <td>
                                                    <div style="display:flex;justify-content: center;">'; ?>
                                                <a href="?action=organ_donor&patient_details=organ_view&id=<?php echo $pid ?>" class="non-style-link">
                                                    <button class="btn-primary-soft btn button-icon btn-view" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;">
                                                        <font class="tn-in-text">View</font>
                                                    </button>
                                                </a>
                                        <?php
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </center>
                    </td>
                </tr>
            </div>
            <?php if ($_GET['patient_details'] == 'organ_view') {
                $id = $_GET['id'];
                $sqlmain = "SELECT DISTINCT(organ_donation.pid), organ_donation.*, patient.* from patient INNER JOIN organ_donation on organ_donation.pid = patient.pid where organ_donation.pid=?";
                $stmt = $database->prepare($sqlmain);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $name = $row["pname"];
                $email = $row["pemail"];
                $address = $row["paddress"];
                $b_group = $row["blood_group"];
                $dob = $row["pdob"];
                $tele = $row['ptel'];
                $age = $date - $dob;

                $organs = array();
                $sqlmain = "SELECT DISTINCT(organ_donation.pid), organ_donation.*, patient.* from patient INNER JOIN organ_donation on organ_donation.pid = patient.pid where organ_donation.pid=?";
                $stmt = $database->prepare($sqlmain);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc())
                    $organs[] = $row['organ'];

                $organsString = implode(', ', $organs);
            ?>
                <div id="popup1" class="overlay">
                    <div class="popup" style="transform: scale(.95); margin-top: 2vh">
                        <center>
                            <h2></h2>
                            <a class="close" href="requirement.php?action=organ_donor">&times;</a>

                            <div style="display: flex;justify-content: center;">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">

                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Details of Patient</p><br><br>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td class="td-label" colspan="2">
                                            <label for="name" class="form-label">Name</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td display-text" colspan="2">
                                            <?php echo $name ?><br><br>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="td-label" colspan="2">
                                            <label for="Email" class="form-label">Email</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td display-text" colspan="2">
                                            <?php echo $email ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-label" colspan="2">
                                            <label for="b_group" class="form-label">Blood Group</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td display-text" colspan="2">
                                            <?php echo $b_group ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-label" colspan="2">
                                            <label for="b_group" class="form-label">Organ Name</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td display-text" colspan="2">
                                            <?php echo $organsString ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-label" colspan="2">
                                            <label for="Tele" class="form-label">Phone Number</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td display-text" colspan="2">
                                            <?php echo $tele ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-label" colspan="2">
                                            <label for="address" class="form-label">Address</label>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td display-text" colspan="2">
                                            <?php echo $address ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-label" colspan="2">
                                            <label for="spec" class="form-label">Date of Birth</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td display-text" colspan="2">
                                            <?php echo $dob . ' - [ ' . $age . ' Years ]' ?><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center><a href="requirement.php?action=organ_donor"><input type="button" value="Okay" class="login-btn btn-primary-soft btn"></a></center>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </center>
                        <br><br>
                    </div>
                </div>
            <?php }
            if ($_GET['sms_status'] == 'sms_sent') { ?>
                <div id="popup1" class="overlay">
                    <div class="popup" style="transform: scale(.95); margin-top: 20vh">
                        <center>
                            <h2></h2>
                            <a class="close" href="requirement.php?action=blood_donor">&times;</a>

                            <div style="display: flex;justify-content: center;">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: center;font-size: 25px;font-weight: 500;">Successfully Blood Donors are Invited !</p><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center><a href="requirement.php?action=blood_donor"><input type="button" value="Okay" class="login-btn btn-primary-soft btn"></a></center>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php   }
                        ?>
                    </div>
                </div>
</body>

</body>
<script>
    // Get references to the option elements
    const bloodDonorOption = document.getElementById("bloodDonorOption");
    const organDonorOption = document.getElementById("organDonorOption");
    const organ_donor_list = document.getElementById("organ_donor_list");
    const blood_donor_list = document.getElementById("blood_donor_list");

    // Function to append query parameters to the URL
    function appendQueryParam(key, value) {
        const url = new URL(window.location.href);
        url.searchParams.set(key, value);
        history.replaceState(null, "", url.href);
    }

    // Function to check the URL for the action parameter and display the corresponding div
    function checkActionParameter() {
        const url = new URL(window.location.href);
        const action = url.searchParams.get("action");

        if (action === "organ_donor") {
            organDonorOption.style.borderColor = "#000";
            bloodDonorOption.style.borderColor = "";
            organ_donor_list.style.display = "block";
            blood_donor_list.style.display = "none";
        } else {
            // Default to blood donor if no action parameter or unknown value
            bloodDonorOption.style.borderColor = "#000";
            organDonorOption.style.borderColor = "";
            organ_donor_list.style.display = "none";
            blood_donor_list.style.display = "block";
        }
    }

    // Call the function to check the action parameter on page load
    checkActionParameter();

    // Add click event listeners to the options
    bloodDonorOption.addEventListener("click", () => {
        bloodDonorOption.style.borderColor = "#000";
        organDonorOption.style.borderColor = "";
        organ_donor_list.style.display = "none";
        blood_donor_list.style.display = "block";
        appendQueryParam("action", "blood_donor");
    });

    organDonorOption.addEventListener("click", () => {
        organDonorOption.style.borderColor = "#000";
        bloodDonorOption.style.borderColor = "";
        organ_donor_list.style.display = "block";
        blood_donor_list.style.display = "none";
        appendQueryParam("action", "organ_donor");
    });
</script>
<script>
    const expandButton = document.getElementById("expand-sms");
    const expandableContent = document.getElementById("expandable-content");

    let isExpanded = false;

    expandButton.addEventListener("click", () => {
        if (isExpanded) {
            expandableContent.style.maxHeight = "0";
        } else {
            expandableContent.style.maxHeight = expandableContent.scrollHeight + "px";
        }

        isExpanded = !isExpanded;
    });
</script>

</html>