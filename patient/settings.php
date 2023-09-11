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
    <?php include("./config.php") ?>
    <title><?php echo $lang['settings'] ?></title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-X 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .display-text {
            height: 35px;
            margin-bottom: 1vh;
            border: 0;
            cursor: pointer;
            letter-spacing: 1px;
            font-style: italic;
            font-weight: 400;
        }

        /* Style for the container */
        .radio-container {
            display: flex;
            flex-direction: column;
            justify-content: start;
            font-family: Arial, sans-serif;
        }

        /* Hide the default radio button input */
        .radio-label input[type="radio"] {
            display: none;
        }

        /* Style for the custom radio button */
        .radio-custom {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #3498db;
            border-radius: 50%;
            margin-right: 10px;
            margin-bottom: 0;
            transition: border-color 0.3s ease, transform 0.3s ease;
        }

        /* Style for the label text */
        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        /* Change the custom radio button's color when checked */
        .radio-label input[type="radio"]:checked+.radio-custom {
            border: 5px solid #3498db;
            transition: 0.1s;
        }

        /* Style for label text */
        .radio-label span {
            margin-left: 10px;
            font-size: 16px;
        }

        /* Optional: Add a transition effect for label text */
        .radio-label span {
            transition: color 0.3s ease;
        }

        /* Optional: Change label text color on hover */
        .radio-label:hover span {
            color: #3498db;
        }

        .radio-label w {
            margin-top: 22px;
        }


        .donation-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .donation-form {
            text-align: left;
        }

        .donation-item {
            margin-bottom: 20px;
        }


        .radio-custom-group {
            display: flex;
            align-items: center;
        }

        .custom-radio {
            display: none;
        }

        .custom-label {
            margin-right: 10px;
            cursor: pointer;
            padding: 5px 10px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .custom-radio:checked+.custom-label {
            background-color: #27ae60;
        }

        .custom-button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-button:hover {
            background-color: #2980b9;
        }
    </style>


</head>

<body>
    <?php

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
    $stmt->bind_param("s", $useremail);  // Bind the variable $useremail as a string parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];


    if ($_POST) {

        $_SESSION["donate_organs"] = $_POST['organ_selection'];

        header("location: settings.php?action=donate_next&id=$userid&error=0");
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
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text"><?php echo $lang['home'] ?></p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="doctors.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text"><?php echo $lang['alldoctors'] ?></p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="specialities.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><?php echo $lang['bookappoinments'] ?></p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><?php echo $lang['mybookings'] ?></p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-recent">
            <a href="recent.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><?php echo $lang['recentconsultancy'] ?></p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-test">
            <a href="recent_tests.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><?php echo $lang['analysishistory'] ?></p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-payment">
            <a href="payment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><?php echo $lang['payments'] ?></p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings  menu-active menu-icon-settings-active">
            <a href="settings.php" class="non-style-link-menu  non-style-link-menu-active">
                <div>
                    <p class="menu-text"><?php echo $lang['settings'] ?></p>
            </a></div>
        </td>
    </tr>
    </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <td width="13%">
                    <a href="settings.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text"><?php echo $lang['ddback'] ?></font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;"><?php echo $lang['settings'] ?></p>

                </td>

                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        <?php echo $lang['todays-date'] ?>
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
                <td width="7%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>
                <td width="8.5%">
                    <div style="width: 70px;">
                        <form action="donor_register.php" method="post">
                            <select name="language" id="language" style="font-size:13px">
                                <option value="en"><?php echo $_SESSION['lang'] ?></option>
                                <option value="en">English</option>
                                <option value="tm">தமிழ்</option>
                                <option value="ka">ಕನ್ನಡ</option>
                                <option value="ml">മലയാളം</option>
                                <option value="te">తెలుగు</option>
                                <option value="hi">हिंदी</option>
                            </select><br>
                        </form>
                    </div>
                </td>


            </tr>
            <tr>
                <td colspan="4">

                    <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <?php
                                    $result = $database->query("SELECT * FROM organ_donation WHERE pid = '$userid'");
                                    if ($result->num_rows) {
                                    ?>
                                        <div>
                                            <div>
                                                <a href="?action=remove_donate&id=<?php echo $userid ?>&error=0" class="non-style-link">
                                                    <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div class="btn-icon-donation"><img src="../img/icons/withdraw-iceblue.svg" alt="" width="28px"></div>
                                                        <div>
                                                            <div class="h1-dashboard" style="color: #ff5050;">
                                                                <?php echo $lang['cancel-organ-donation'] ?>&nbsp;
                                                            </div><br>
                                                            <div class="h3-dashboard" style="font-size: 14px;">
                                                                <?php echo $lang['remove-registration-donation'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div>
                                            <div>
                                                <a href="?action=donate&id=<?php echo $userid ?>&error=0" class="non-style-link">
                                                    <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div class="btn-icon-donation"><img src="../img/icons/donate-iceblue.svg" alt="" width="28px"></div>
                                                        <div>
                                                            <div class="h1-dashboard">
                                                                <?php echo $lang['donate-more'] ?> &nbsp;
                                                            </div><br>
                                                            <div class="h3-dashboard" style="font-size: 15px;">
                                                                <?php echo $lang['donate-more-sentimental'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=edit&id=<?php echo $userid ?>&error=0" class="non-style-link">
                                        <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex">
                                            <div class="btn-icon-back dashboard-icons-setting" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $lang['acc-settings'] ?> &nbsp;
                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px;">
                                                    <?php echo $lang['edit-acc-details'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=view&id=<?php echo $userid ?>" class="non-style-link">
                                        <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex;">
                                            <div class="btn-icon-back dashboard-icons-setting " style="background-image: url('../img/icons/view-iceblue.svg');"></div>
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $lang['view-acc-details'] ?>

                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px;">
                                                    <?php echo $lang['view-pers-info'] ?>
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href="?action=drop&id=<?php echo $userid . '&name=' . $username ?>" class="non-style-link">
                                        <div class="dashboard-items setting-tabs" style="padding:20px;margin:auto;width:95%;display: flex;">
                                            <div class="btn-icon-back dashboard-icons-setting" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                            <div>
                                                <div class="h1-dashboard" style="color: #ff5050;">
                                                    <?php echo $lang['del-account'] ?>

                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px;">
                                                    <?php echo $lang['org-donation-can-success'] ?>
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                </td>

                            </tr>
                        </table>
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
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>' . $lang["are-you-sure"] . '</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            ' . $lang["del-acc-echo"] . '<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-account.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;' . $lang['yes'] . '&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['no'] . '&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'remove_donate') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>' . $lang["are-you-sure"] . '</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            ' . $lang["cancel-org-donation"] . '
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="remove_organ_donation.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;' . $lang['yes'] . '&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['no'] . '&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'organ_remove_success') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>' . $lang["cancelled-success"] . '</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            ' . $lang["org-donation-can-success"] . '
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['ok'] . '&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
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
            $nic = $row['pnic'];
            $tele = $row['ptel'];
            echo '
            <div id="popup1" class="overlay">
                <div class="popup" style="transform: scale(.95); margin-top: 2vh">
                    <center>
                        <h2></h2>
                        <a class="close" href="settings.php">&times;</a>

                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">' . $lang["details-of-me"] . '</p><br><br>
                                    </td>
                                </tr>
                                
                                <tr>
                                    
                                    <td class="td-label" colspan="2">
                                        <label for="name" class="form-label">' . $lang["name"] . '</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                        ' . $name . '<br><br>
                                    </td>
                                    
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="Email" class="form-label">' . $lang["email"] . '</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                    ' . $email . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="nic" class="form-label">' . $lang["aadhar"] . '</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                    ' . $nic . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="b_group" class="form-label">' . $lang["blood-group"] . '</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                    ' . $b_group . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="Tele" class="form-label">' . $lang["telephone"] . '</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td display-text" colspan="2">
                                    ' . $tele . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="address" class="form-label">' . $lang["address"] . '</label>
                                        
                                    </td>
                                </tr>
                                <tr>
                                <td class="label-td display-text" colspan="2">
                                ' . $address . '<br><br>
                                </td>
                                </tr>
                                <tr>
                                <td class="td-label" colspan="2">
                                <label for="spec" class="form-label">' . $lang["dob"] . '</label>
                                    </td>
                                </tr>
                                <tr>
                                <td class="label-td display-text" colspan="2">
                                ' . $dob . '<br><br>
                                </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <center><a href="settings.php"><input type="button" value="' . $lang['ok'] . '" class="login-btn btn-primary-soft btn" ></a></center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>
            ';
        } elseif ($action == 'donate_reg__success') {
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>' . $lang["register-success"] . '</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            ' . $lang["org-donation-registration-success"] . '<br>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['ok'] . '&nbsp;&nbsp;</font></button></a>
                        </div>
                    </center>
                </div>
            </div>
            ';
        } elseif ($action == 'donor_reg_canceled') {
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>' . $lang["register-withdrawed"] . '</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            ' . $lang["org-donation-cancellation-success"] . '<br>
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['ok'] . '&nbsp;&nbsp;</font></button></a>
                        </div>
                    </center>
                </div>
            </div>
            ';
        } elseif ($action == 'donate') {
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
            $nic = $row['pnic'];
            $tele = $row['ptel']; ?>
            <div id="popup1" class="overlay">
                <div class="popup" style="transform: scale(.95); margin-top: 2vh">
                    <center>
                        <h2></h2>
                        <a class="close" href="settings.php">&times;</a>

                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">

                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;"><?php echo $lang['donate-organs'] ?></p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-label" colspan="2">
                                        <label for="Tele" class="form-label"><?php echo $lang['i-want-to-donate'] ?></label>
                                    </td>
                                </tr>
                                <form action="" method="post">
                                    <tr>
                                        <td>
                                            <div class="radio-container">
                                                <label class="radio-label">
                                                    <input type="radio" name="organ_selection" value="1">
                                                    <span class="radio-custom"></span>
                                                    <w class="display-text" style="font-size: 14px;"><?php echo $lang['all-org'] ?></w>
                                                </label>
                                                <label class="radio-label">
                                                    <input type="radio" name="organ_selection" value="0">
                                                    <span class="radio-custom"></span>
                                                    <w class="display-text" style="font-size: 14px;"><?php echo $lang['some-org'] ?></w>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center><button type="submit" class="login-btn btn-primary-soft btn"><?php echo $lang['next'] ?></button></center>
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
        } elseif ($action == 'donate_next') {
            $sqlmain = "select * from patient where pid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $donate_type = $_SESSION['donate_organs'];
            echo $donate_type;
            if ($donate_type == 1) { ?>
                <script>
                    window.location.href = './donor_register.php?donate_type=1';
                </script> <?php    } else {
                            ?> <div id="popup1" class="overlay">
                    <div class="popup" style="transform: scale(.95); margin-top: 2vh">
                        <center>
                            <h2></h2>
                            <a class="close" href="settings.php">&times;</a>

                            <div style="display: flex;justify-content: center;">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">

                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;"><?php echo $lang['donate-organs'] ?></p><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-label" colspan="2">
                                            <label for="Tele" class="form-label"><?php echo $lang['org-choice'] ?></label>
                                        </td>
                                    </tr>
                                    <form action="donor_register.php" method="post">
                                        <input type="hidden" name="donate_type" value="<?php echo $donate_type ?>">
                                        <tr>
                                            <td class="td-label" colspan="2">
                                                <div class="label-td display-text">
                                                    <label for="heart"><?php echo $lang['dil'] ?></label>
                                                    <select class="label-td display-text" name="heart" id="heart">
                                                        <option value="No"><?php echo $lang['no'] ?></option>
                                                        <option value="Yes"><?php echo $lang['yes'] ?></option>
                                                    </select><br>
                                                </div>
                                                <div class="label-td display-text">
                                                    <label for="lungs"><?php echo $lang['nurai-eeral'] ?></label>
                                                    <select class="label-td display-text" name="lungs" id="lungs">
                                                        <option value="No"><?php echo $lang['no'] ?></option>
                                                        <option value="Yes"><?php echo $lang['yes'] ?></option>
                                                    </select><br>
                                                </div>
                                                <div class="label-td display-text">
                                                    <label for="kidneys"><?php echo $lang['siru-neeragam'] ?></label>
                                                    <select class="label-td display-text" name="kidneys" id="kidneys">
                                                        <option value="No"><?php echo $lang['no'] ?></option>
                                                        <option value="Yes"><?php echo $lang['yes'] ?></option>
                                                    </select><br>
                                                </div>
                                                <div class="label-td display-text">
                                                    <label for="liver"><?php echo $lang['eeral'] ?> </label>
                                                    <select class="label-td display-text" name="liver" id="liver">
                                                        <option value="No"><?php echo $lang['no'] ?></option>
                                                        <option value="Yes"><?php echo $lang['yes'] ?></option>
                                                    </select><br>
                                                </div>
                                                <div class="label-td display-text">
                                                    <label for="corneas"><?php echo $lang['cornea'] ?> </label>
                                                    <select class="label-td display-text" name="corneas" id="corneas">
                                                        <option value="No"><?php echo $lang['no'] ?></option>
                                                        <option value="Yes"><?php echo $lang['yes'] ?></option>
                                                    </select><br>
                                                </div>
                                                <div class="label-td display-text">
                                                    <label for="pancreas"><?php echo $lang['pancreas'] ?> </label>
                                                    <select class="label-td display-text" name="pancreas" id="pancreas">
                                                        <option value="No"><?php echo $lang['no'] ?></option>
                                                        <option value="Yes"><?php echo $lang['yes'] ?></option>
                                                    </select><br>
                                                </div>
                                                <div class="label-td display-text">
                                                    <label for="tissue"><?php echo $lang['tissuel'] ?> </label>
                                                    <select class="label-td display-text" name="tissue" id="tissue">
                                                        <option value="No"><?php echo $lang['no'] ?></option>
                                                        <option value="Yes"><?php echo $lang['yes'] ?></option>
                                                    </select><br>
                                                </div>
                                                <div class="label-td display-text">
                                                    <label for="small_bowel"><?php echo $lang['small-bowel'] ?> </label>
                                                    <select class="label-td display-text" name="small_bowel" id="small_bowel">
                                                        <option value="No"><?php echo $lang['no'] ?></option>
                                                        <option value="Yes"><?php echo $lang['yes'] ?></option>
                                                    </select><br>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <center><button type="submit" class="login-btn btn-primary-soft btn"><?php echo $lang['register'] ?></button></center>
                                            </td>
                                        </tr>
                                    </form>
                                </table>
                            </div>
                        </center>
                        <br><br>
                    </div>
                </div>
    <?php }
                    } elseif ($action == 'edit') {
                        $sqlmain = "select * from patient where pid=?";
                        $stmt = $database->prepare($sqlmain);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $name = $row["pname"];
                        $email = $row["pemail"];



                        $address = $row["paddress"];
                        $nic = $row['pnic'];
                        $tele = $row['ptel'];

                        $error_1 = $_GET["error"];
                        $errorlist = array(
                            '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                            '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                            '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                            '4' => "",
                            '0' => '',

                        );

                        if ($error_1 != '4') {
                            echo '
                            <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="settings.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">' .
                                $errorlist[$error_1]
                                . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">' . $lang["edit-acc-details"] . '</p>
                                        User ID : [ P - ' . $id . ' ] ' . $lang["auto-gen"] . '<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-user.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">' . $lang["email"] . ' </label>
                                            <input type="hidden" value="' . $id . '" name="id00">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="hidden" name="oldemail" value="' . $email . '" >
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="' . $email . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">' . $lang["name"] . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="' . $name . '" required><br>
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="nic" class="form-label">' . $lang["aadhar"] . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="nic" class="input-text" placeholder="Aadhar Number" value="' . $nic . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">' . $lang["telephone"] . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="' . $tele . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">' . $lang["address"] . '</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="text" name="address" class="input-text" placeholder="Address" value="' . $address . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">' . $lang["pass"] . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Define a Password" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">' . $lang["confirm-pass"] . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="' . $lang['confirm-pass'] . '" required><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="' . $lang['reset'] . '" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="' . $lang['save'] . '" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
                        } else {
                            echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>' . $lang["edit-success"] . '</h2>
                            <a class="close" href="settings.php">&times;</a>
                            <div class="content">
                                ' . $lang["edit-warning"] . '
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="settings.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['ok'] . '&nbsp;&nbsp;</font></button></a>
                            <a href="../logout.php" class="non-style-link"><button  class="btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;' . $lang['logout'] . '&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';
                        };
                    }
                }
    ?>

</body>
<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="organ"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach(otherCheckbox => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        });
    });
    // Add animation for form submission (optional)
    document.querySelector('.donation-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent actual form submission
        // You can add animation or other actions here
        alert('Form submitted successfully!');
    });
</script>
<script>
    // Get a reference to the language dropdown
    const languageDropdown = document.getElementById("language");

    // Add an event listener to the dropdown
    languageDropdown.addEventListener("change", function() {
        // Get the selected language code
        const selectedLanguage = this.value;

        // Get the current URL
        const currentURL = "./settings.php"

        // Check if there's already a query string in the URL
        const separator = currentURL.includes("?") ? "&" : "?";

        // Construct the new URL with the selected language
        const newURL = currentURL + separator + "lang=" + selectedLanguage;

        // Redirect to the new URL
        window.location.href = newURL;
    });
</script>

</html>