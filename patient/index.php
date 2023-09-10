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


    <title>Dashboard</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        .anime,
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .workout_img {
            width: 110px;
            height: 110px;
            margin: 0 15px 0 15px;
        }

        .rw-conversation-container .rw-header {
            background-color: #0a76d8;
        }

        .rw-conversation-container .rw-messages-container .rw-message .rw-client {
            background-color: #0a76d8;
        }

        .rw-launcher {
            background-color: #0a76d8;
        }

        .stage>.stage-header h1 {
            color: #0a76d8;
        }

        .stage>.stage-header h2 {
            color: #ffffff;
        }

        a.nice-link {
            color: #ffffff;
        }

        a.nice-link>.hover>span {
            background: #0a76d8;
        }

        a.nice-link:hover,
        a.nice-link.hover {
            color: #ffffff;
        }

        .content {
            background: #111111;
            color: #ffffff;
        }

        .content .content-content.content-content--contact .contact-grid>li .fa {
            color: #333333;
        }

        /* Style the select container */
        select {
            padding: 10px;
            /* Add padding for spacing */
            font-size: 16px;
            /* Increase font size */
            border: 2px solid #ccc;
            /* Add a border */
            border-radius: 5px;
            /* Rounded corners */
            background-color: #fff;
            /* White background */
            color: #333;
            /* Text color */
            width: 100%;
            /* Full width by default */
            transition: border-color 0.2s ease;
            /* Smooth border transition */
        }

        /* Style the select on hover and focus */
        select:hover,
        select:focus {
            border-color: #555;
            /* Darker border on hover/focus */
        }

        /* Style the dropdown arrow */
        select::-ms-expand {
            display: none;
            /* Hide default arrow in IE/Edge */
        }

        select option {
            font-size: 14px;
            /* Font size for options */
        }

        /* Style the select when it's disabled */
        select:disabled {
            background-color: #f5f5f5;
            /* Light gray background */
            cursor: not-allowed;
            /* Disabled cursor */
        }

        /* Style the select when it's in a disabled state */
        select[disabled] option {
            color: #999;
            /* Grayed-out text for options */
        }

        /* Style the select when it's in a disabled state */
        select[disabled]:hover,
        select[disabled]:focus {
            border-color: #ccc;
            /* Lighter border on hover/focus */
        }
    </style>


</head>

<body>
    <?php

    //learn from w3schools.com
    include("./config.php");


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
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active">
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text"><?php echo $lang['home'] ?></p>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['alldoctors'] ?></p>
                        </a>
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
                        </a>
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
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['settings'] ?></p>
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
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"><?php echo $lang['home'] ?></p>

                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            <?php echo $lang['tddate'] ?>
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
                            <table class="filter-container doctor-header patient-header" style="border: none;width:95%" border="0">
                                <tr>
                                    <td>
                                        <h3><?php echo $lang['welcome'] ?></h3>
                                        <h1><?php echo $username  ?>. [P-<?php echo $userid; ?>]</h1>
                                        <p><?php echo $lang['introline'] ?>
                                            <a href="doctors.php" class="non-style-link"><b>"<?php echo $lang['alldoctors'] ?>"</b></a><?php echo $lang['sectionor'] ?>
                                            <a href="schedule.php" class="non-style-link"><b>"<?php echo $lang['sessions'] ?>"</b> </a><br>
                                            <?php echo $lang['dashline2'] ?><br><br>
                                        </p>

                                        <h3><?php echo $lang['channeldoctor'] ?></h3>
                                        <form action="schedule.php" method="post" style="display: flex">

                                            <input type="search" name="search" class="input-text " placeholder="<?php echo $lang['searchdoctoravailable'] ?>" list="doctors" style="width:45%;">&nbsp;&nbsp;

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


                                            <input type="Submit" value="<?php echo $lang['dsearch'] ?>" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

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
                                            <p style="font-size: 20px;font-weight:600;padding-left: 30px; margin-top:0;" class="anime"><?php echo $lang['livestatuss'] ?></p>
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
                                                        <?php echo $lang['heartrate'] ?>&nbsp;&nbsp;
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
                                                        <?php echo $lang['oxygenlevel'] ?>&nbsp;&nbsp;&nbsp;&nbsp;
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
                <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['upcomingbooking'] ?></p>
                <center>
                    <div class="abc scroll" style="height: 250px;padding: 0;margin: 0; ">
                        <table width="90%" class="sub-table scrolldown" border="0">
                            <thead>
                                <tr>
                                    <th class="table-headin" style="width: 50px;">
                                        <?php echo $lang['Appnumber'] ?>
                                    </th>
                                    <th class="table-headin">
                                        <?php echo $lang['sessiontitle'] ?>
                                    </th>
                                    <th class="table-headin">
                                        <?php echo $lang['doctors'] ?>
                                    </th>
                                    <th class="table-headin">
                                        <?php echo $lang['sheduledatetime'] ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nextweek = date("Y-m-d", strtotime("+1 week"));
                                $sqlmain = "select * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  patient.pid=$userid  and schedule.scheduledate>='$today' and appointment.status = 0 order by schedule.scheduledate asc";
                                //echo $sqlmain;
                                $result = $database->query($sqlmain);

                                if ($result->num_rows == 0) {
                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">' . $lang['drsearch'] . '</p>
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
                                                        <td style="padding:20px;text-align:center;"> &nbsp;' .
                                            substr($lang[$title], 0, 30)
                                            . '</td>
                                                        <td style="text-align:center;">
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
    <?php
    $result = $database->query("SELECT blood_group_request.blood_group, blood_group_request.unit from blood_group_request INNER JOIN patient on blood_group_request.blood_group = patient.blood_group WHERE blood_group_request.`flag` = 0 and pid = '$userid'");
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
        if (($_COOKIE['Blood_Donation']) == NULL) {
            echo $_COOKIE['Blood_Donation'];
    ?><div id="popup1" class="overlay">
                <div class="popup" style="margin-top:20vh">
                    <center>
                        <br><br>
                        <h2><?php echo $lang['blood-needed-heading'] ?></h2>
                        <a id="setCookieButton1" class="close" href="./index.php">&times;</a>
                        <p>
                            <?php echo $lang["blood-donation-content"] ?><br><br>
                        </p>
                        <p>
                            <?php echo $lang["blood-type-units"] . '&nbsp;<b>' . $row['blood_group'] . '</b>&nbsp; - [ ' . $row['unit'] . '&nbsp;units ]' ?><br><br>
                        </p>
                        <div style="display: flex; justify-content: center;">
                            <p id="setCookieButton" class="btn-primary btn" style="display: flex; justify-content: center; align-items: center; margin: 10px; padding: 10px;">
                                <font class="tn-in-text">&nbsp;&nbsp;<?php echo $lang['not-interested'] ?>&nbsp;&nbsp;</font>
                            </p>
                        </div>
                    </center>
                </div>
            </div>

    <?php   }
    }
    ?>
</body>
<script>
    function setCookie(name, value, days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 60 * 60 * 1000));
        var expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + "; " + expires + "; path=/";
        window.location.href = './index.php';
    }

    // Add a click event listener to the button
    document.getElementById("setCookieButton").addEventListener("click", function() {
        // Set a cookie with the name "myCookie" and value "myValue" for 30 days
        setCookie("Blood_Donation", "Not Interested", 1);
    });
    document.getElementById("setCookieButton1").addEventListener("click", function() {
        // Set a cookie with the name "myCookie" and value "myValue" for 30 days
        setCookie("Blood_Donation", "Not Interested", .003);
    });
</script>
<script>
    !(function() {
        let e = document.createElement("script"),
            t = document.head || document.getElementsByTagName("head")[0];
        (e.src = "https://cdn.jsdelivr.net/npm/rasa-webchat/lib/index.js"),
        // Replace 1.x.x with the version that you want
        (e.async = !0),
        (e.onload = () => {
            window.WebChat.default({
                    title: "Virtual Assistant",
                    subtitle: "powered by SLEEK",

                    initPayload: '/greet',
                    customData: {
                        language: "en",
                    },
                    socketUrl: "http://localhost:5005",
                    profileAvatar: "../img/user.png",
                    params: {
                        images: {
                            dims: {
                                width: 200,
                                height: 100,
                            },
                        },
                        storage: "session",
                    },
                    // add other props here
                },
                null
            );
        }),
        t.insertBefore(e, t.firstChild);
    })();
</script>
<script>
    // Get a reference to the language dropdown
    const languageDropdown = document.getElementById("language");

    // Add an event listener to the dropdown
    languageDropdown.addEventListener("change", function() {
        // Get the selected language code
        const selectedLanguage = this.value;

        // Get the current URL
        const currentURL = "./index.php"

        // Check if there's already a query string in the URL
        const separator = currentURL.includes("?") ? "&" : "?";

        // Construct the new URL with the selected language
        const newURL = currentURL + separator + "lang=" + selectedLanguage;

        // Redirect to the new URL
        window.location.href = newURL;
    });
</script>

</html>