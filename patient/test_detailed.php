<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../js/pdfobject-min.js"></script>
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

        .add-doc-form-container {
            width: 73vw !important;
            height: 70vh;
        }

        .login-btn {
            margin-top: 2vh;
        }
    </style>


</head>

<body>
    <?php
    #rasa run --enable-api --cors "*"
    #rasa run actions

    session_start();
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
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['alldoctors'] ?></p>
                            </div>
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
                            </div>
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
                    <td class="menu-btn menu-icon-test-active menu-active">
                        <a href="recent_tests.php" class="non-style-link-menu-active">
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
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0; ">
                <tr>
                    <td width="13%">
                        <a href="recent_tests.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text"><?php echo $lang['ddback'] ?></font>
                            </button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;"><?php echo $lang['vr'] ?></p>
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
                    <td width="9.4%">
                        <div class="language-select" style="width: 70px;">
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
                        <div style="height: 72vh;">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            <?php echo $lang['ltname'] ?>
                                        </th>
                                        <th class="table-headin">
                                            <?php echo $lang['sessiontitle'] ?>
                                        </th>
                                        <th class="table-headin">
                                            <?php echo $lang['bookeddate'] ?>
                                        </th>
                                        <th class="table-headin">
                                            <?php echo $lang['analysisdate'] ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $lname = $_GET['lname'];
                                    $tname = $_GET['tname'];
                                    $booked_time = $_GET['booked_time'];
                                    $seen_at = $_GET['seen_at'];
                                    $file_name = $_GET['file_name'];
                                    echo '<tr >
                                <td style="text-align:center;"> &nbsp;' .

                                        substr($lname, 0, 25)
                                        . '</td >

                                <td style="font-weight:600;text-align:center;">
                                ' . substr($lang[$tname], 0, 100) . '
                                </td>
                                <td style="text-align:center;">
                                    ' . substr($booked_time, 0, 10) . '
                                </td>
                                
                                <td style="text-align:center;">
                                    ' . substr($seen_at, 0, 10) . '
                                </td>

                                <td>

                                    </tr>';
                                    ?>
                                </tbody>
                            </table>
                            <div class="add-doc-form-container" style="padding-left: 0;">
                                <div class="container">
                                    <div id="pdf_view" class=" pdfobject-container"><embed class="pdfobject" src='<?php echo $file_name ?>' type="application/pdf" style="overflow: auto; width: 73vw; height:70vh"></div>
                                    <div id="footer"></div>
                                </div>
                            </div>
                        </div>
                    </center>
                </td>
            </tr>
        </div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        PDFObject.embed("<?php echo $file_name; ?>", "#pdf_view");
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
        const currentURL = "./test_detailed.php"

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