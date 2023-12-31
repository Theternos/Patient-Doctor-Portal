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
    <title>Consultancy</title>
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
    </style>


</head>

<body>
    <?php
    #rasa run --enable-api --cors "*"
    #rasa run actions

    error_reporting(0);
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
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu">
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
        <td class="menu-btn menu-icon-recent menu-active menu-icon-recent-active">
            <a href="recent.php" class="non-style-link-menu non-style-link-menu-active">
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
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="index.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text"><?php echo $lang['ddback'] ?></font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;"><?php echo $lang['recentconsultancy'] ?></p>

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
                        ?>
                    </p>
                </td>
                <td width="7%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>
                <td width="9.3%">
                    <div class="language-select" style="width: 70px; margin-right: 10px;">
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
        </table>
        <tr>
            <td colspan="4">
                <center>
                    <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                            <thead>
                                <tr>
                                    <th class="table-headin">
                                        <?php echo $lang['dname'] ?>
                                    </th>
                                    <th class="table-headin">

                                        <?php echo $lang['apno'] ?>

                                    </th>

                                    <th class="table-headin">

                                        <?php echo $lang['sessiontitle'] ?>

                                    </th>

                                    <th class="table-headin">

                                        <?php echo $lang['sdt'] ?>

                                    </th>

                                    <th class="table-headin">

                                        <?php echo $lang['apd'] ?>

                                    </th>

                                    <th class="table-headin">

                                        <?php echo $lang['drevents'] ?>

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $sqlmain = "SELECT appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  patient.pid=$userid and appointment.status=1";
                                $result = $database->query($sqlmain);

                                if ($result->num_rows == 0) { ?>
                                    <tr>
                                        <td colspan="7">
                                            <br><br><br><br>
                                            <center>
                                                <img src="../img/notfound.svg" width="25%">
                                                <br>
                                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)"><?php echo $lang['notconsdr'] ?></p>
                                                <a class="non-style-link" href="appointment.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; <?php echo $lang['Consnow'] ?> &nbsp;</font></button>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php  } else {
                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                        $row = $result->fetch_assoc();
                                        $appoid = $row["appoid"];
                                        $scheduleid = $row["scheduleid"];
                                        $title = $row["title"];
                                        $docname = $row["docname"];
                                        $scheduledate = $row["scheduledate"];
                                        $scheduletime = $row["scheduletime"];
                                        $scheduletimes = date("h:i A", strtotime($scheduletime));
                                        $pname = $row["pname"];
                                        $apponum = $row["apponum"];
                                        $appodate = $row["appodate"];
                                        echo '<tr >
                                        <td style="font-weight:600;"> &nbsp;' .

                                            substr($docname, 0, 25)
                                            . '</td >
                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                        ' . $apponum . '
                                        
                                        </td>
                                        <td>
                                        ' . substr($lang[$title], 0, 120) . '
                                        </td>
                                        <td style="text-align:center;;">
                                            ' . substr($scheduledate, 0, 10) . ' @' . substr($scheduletimes, 0, 8) . '
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            ' . $appodate . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                       <a href="detailed-recent.php?view&id=' . $appoid . '&appodate=' . $appodate . '&session=' . $title . '&apponum=' . $apponum . '&docname=' . $docname . '&scheduledate=' . $scheduledate . '&scheduletime=' . $scheduletime . '&scheduleid=' . $scheduleid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">' . $lang['view'] . '</font></button></a>
                                       &nbsp;&nbsp;&nbsp;</div>
                                        </td>
                                    </tr>';
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </center>
            </td>
        </tr>
    </div>
</body>
<script>
    // Get a reference to the language dropdown
    const languageDropdown = document.getElementById("language");

    // Add an event listener to the dropdown
    languageDropdown.addEventListener("change", function() {
        // Get the selected language code
        const selectedLanguage = this.value;

        // Get the current URL
        const currentURL = "recent.php";

        // Check if there's already a query string in the URL
        const separator = currentURL.includes("?") ? "&" : "?";

        // Construct the new URL with the selected language
        const newURL = currentURL + separator + "lang=" + selectedLanguage;

        // Redirect to the new URL
        window.location.href = newURL;
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

</html>