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
                            $sqlmain = "SELECT * from patient WHERE patient.pname='$keyword' or patient.pname like '$keyword%' or patient.pname like '%$keyword' or patient.pname like '%$keyword%' or patient.pemail='$keyword' or patient.pemail like '$keyword%' or patient.pemail like '%$keyword' or patient.pemail like '%$keyword%' or patient.blood_group='$keyword' or patient.blood_group like '$keyword%' or patient.blood_group like '%$keyword' or patient.blood_group like '%$keyword%' ORDER BY pname ASC";;
                        } else {
                            $a = 1;
                            $sqlmain = "SELECT * from patient";
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
                    <td colspan="4" style="padding-top:4vh;">
                        <div style="justify-content:center;" class="flex-row">
                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Select Types: </p>
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
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Patients (<?php echo $result->num_rows; ?>)</p>
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
                                                Phone number
                                            </th>
                                            <th class="table-headin">
                                                Events
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $action = "blood_donor";
                                        $action = $_GET["action"];
                                        if ($action != "blood_donor" and $action != "organ_donor" and ($result->num_rows) > 0) {
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
                                                <a href="?action=view&id=<?php echo $pid ?> ?>" class="non-style-link">
                                                    <button class="btn-primary-soft btn button-icon btn-view" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;">
                                                        <font class="tn-in-text">View</font>
                                                    </button>
                                                </a>

                            </div>
                    </td>
                </tr><?php
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
    </div>

</body>
<script>
    // Get references to the option elements
    const bloodDonorOption = document.getElementById("bloodDonorOption");
    const organDonorOption = document.getElementById("organDonorOption");

    // Add click event listeners to the options
    bloodDonorOption.addEventListener("click", () => {
        // Change the border color of the selected option
        bloodDonorOption.style.borderColor = "#000";
        organDonorOption.style.borderColor = ""; // Reset border color for the other option

        // Add "?action=blood_donation" to the URL
        appendQueryParam("action", "blood_donor");
    });

    organDonorOption.addEventListener("click", () => {
        // Change the border color of the selected option
        organDonorOption.style.borderColor = "#000";
        bloodDonorOption.style.borderColor = ""; // Reset border color for the other option

        // Add "?action=organ_donation" to the URL
        appendQueryParam("action", "organ_donor");
    });

    // Function to append query parameters to the URL
    function appendQueryParam(key, value) {
        const url = new URL(window.location.href);
        url.searchParams.set(key, value);
        history.replaceState(null, "", url.href);
    }
</script>

</html>