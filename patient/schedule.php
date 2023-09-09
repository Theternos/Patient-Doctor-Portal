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

    <title>Sessions</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .disabled-link {
            cursor: not-allowed;
            pointer-events: none;
            opacity: 0.5;
        }

        .enabled-link {
            cursor: pointer;
            pointer-events: all;
            opacity: 1;
        }

        .custom-select {
            position: relative;
            display: inline-block;
            font-family: Arial, sans-serif;
        }

        .custom-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            border: .5px solid #ddd;
            padding: 5px;
            width: fit-content;
            background-color: #fff;
            cursor: pointer;
            font-size: 13px;
            border-radius: 4px;
            font-weight: 600;
            color: #212529e3;
        }

        .custom-select .select-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Styling when the dropdown is open */
        .custom-select select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        /* Styling options */
        .custom-select option {
            background-color: #fff;
            color: #333;
        }

        /* Hover effect on options */
        .custom-select option:hover {
            background-color: #007bff;
            color: #fff;
        }

        .content {
            margin: 3px;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

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
    $sqlmain = "SELECT * FROM patient WHERE pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);  // Bind the variable $useremail as a string parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $userrow = $result->fetch_assoc();  // Use $result instead of $userrow
    $userid = $userrow["pid"];
    $username = $userrow["pname"];


    //echo $userid;
    //echo $username;

    date_default_timezone_set('Asia/Kolkata');

    $today = date('Y-m-d');


    //echo $userid;
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
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="specialities.php" class="non-style-link-menu non-style-link-menu-active">
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
                    <td class="menu-btn menu-icon-test">
                        <a href="recent_tests.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['analysishistory'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
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
        <?php

        $sid = $_GET["id"];
        $sqlmain = "SELECT DISTINCT(D.docname), D.* FROM doctor D, `schedule` S, specialties SP WHERE S.title = (SELECT sname from specialties where id = '$sid') and S.docid = D.docid and S.scheduledate >= '$today' ORDER BY D.docname ASC;";
        $sqlpt1 = "";
        $insertkey = "";
        $q = '';
        $searchtype = $lang['sp-all'] . ' ';
        if ($_POST) {
            //print_r($_POST);

            if (!empty($_POST["search"])) {
                /*TODO: make and understand */
                $keyword = $_POST["search"];
                $sqlmain = "SELECT DISTINCT(D.docname), D.* FROM doctor D, `schedule` S, specialties SP WHERE S.title = (SELECT sname from specialties where id = '$sid') and S.docid = D.docid and S.scheduledate >= '$today' and D.docname='$keyword' or D.docname like '$keyword%' or D.docname like '%$keyword' or D.docname like '%$keyword%' or S.title='$keyword' or S.title like '$keyword%' or S.title like '%$keyword' or S.title like '%$keyword%'  order by S.scheduledate asc";
                //echo $sqlmain;
                $insertkey = $keyword;
                $searchtype = $lang['sp-search-result'];
                $q = '"';
            }
        }


        $result = $database->query($sqlmain);


        ?>

        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td width="13%">
                        <a href="specialities.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text"> <?php echo $lang['ddback'] ?></font>
                            </button></a>
                    </td>
                    <td>
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder=" <?php echo $lang['scrded'] ?>" list="doctors" value="<?php echo $insertkey ?>">&nbsp;&nbsp;

                            <?php
                            echo '<datalist id="doctors">';
                            $list11 = $database->query("select DISTINCT * from  doctor;");
                            $list12 = $database->query("select DISTINCT * from  schedule GROUP BY title;");

                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                $row00 = $list11->fetch_assoc();
                                $d = $row00["docname"];

                                echo "<option value='$d'><br/>";
                            };


                            for ($y = 0; $y < $list12->num_rows; $y++) {
                                $row00 = $list12->fetch_assoc();
                                $d = $row00["title"];

                                echo "<option value='$d'><br/>";
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
                            echo $today;
                            ?>
                        </p>
                    </td>
                    <td width="7%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                    <td width="9%">
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
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $searchtype . $lang['drs'] . "(" . $result->num_rows . ")"; ?> </p>
                        <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)"><?php echo $q . $insertkey . $q; ?> </p>
                    </td>
                </tr>


                <?php
                $schedule_sql = "SELECT * from specialties where id= '" . $sid . "'";
                $schedule_result = mysqli_query($database, $schedule_sql);
                $schedule_row = mysqli_fetch_assoc($schedule_result);
                ?>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none;">
                                    <tbody>
                                        <?php
                                        if ($result->num_rows == 0 || $schedule_result->num_rows == 0) {
                                            echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">' . $lang['oops'] . '</p>
                                    <a class="non-style-link" href="specialities.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp;' . $lang['sspec'] . ' &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                        } else {
                                            //echo $result->num_rows;
                                            for ($x = 0; $x < ($result->num_rows); $x++) {
                                                echo "<tr>";
                                                for ($q = 0; $q < 3; $q++) {
                                                    $row = $result->fetch_assoc();
                                                    if (!isset($row)) {
                                                        break;
                                                    };
                                                    $scheduleid = $sid;
                                                    $docname = $row["docname"];
                                                    $docid = $row["docid"];
                                                    $totalbooked = $row['nop'];
                                                    $qualification = $row['qualification'];
                                                    $licence = $row['docnic'];
                                                    $special_id = $row['specialties'];
                                                    $sqlmain12 = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.scheduleid='$scheduleid';";
                                                    $result12 = $database->query($sqlmain12);
                                                    $seatbooked = $result12->num_rows;
                                                    $selectedVariables[$x] = "₹100";
                                                    $special_sql = "SELECT sname FROM specialties where id = '$special_id'";
                                                    $special_result = $database->query($special_sql);
                                                    $special_row = $special_result->fetch_assoc();
                                                    $speciality = $special_row['sname'];
                                                    $doc_lang = "SELECT `language` from doc_language WHERE docid = '$docid'";
                                                    $doc_lang_result = $database->query($doc_lang);
                                                    $languages = array(); // Initialize an array to hold languages

                                                    while ($doc_lang_row = $doc_lang_result->fetch_assoc()) {
                                                        $languages[] = $doc_lang_row['language'];
                                                    }

                                                    if ($seatbooked != 0) {
                                                        $seatleft = $totalbooked - $seatbooked;
                                                    } else {
                                                        $seatleft = $totalbooked;
                                                    }
                                                    if ($scheduleid == "") {
                                                        break;
                                                    } ?>

                                                    <td style="width: 25%;">
                                                        <form action="booking.php" method="post">
                                                            <div class="dashboard-items search-items" style="background-color: #fdfcfc;">
                                                                <div style="width:100%" ;>
                                                                    <div class="h1-search">
                                                                        <div style="display: flex; flex-direction:row; align-items:center">
                                                                            <div><?php echo  substr($docname, 0, 30) ?></div>&nbsp;
                                                                            <div style="font-size: 15px; color:#6a6a6a; font-weight:500;">[<?php echo  substr($lang[$speciality], 0, 40) ?>]</div>
                                                                        </div>
                                                                        <div class="h4-search content">
                                                                            <?php echo $lang['drqualification'] ?> <b> <?php echo substr($qualification, 0, 30) ?></b>
                                                                        </div>
                                                                    </div>
                                                                    <div class="h4-search content">
                                                                        <?php echo $lang['licno'] ?><b> <?php echo substr($licence, 0, 10) ?></b>
                                                                    </div>
                                                                    <div class="h4-search content">
                                                                        <?php echo $lang['lan'] ?> <b> <?php echo implode(', ', $languages); ?></b>
                                                                    </div>
                                                                    <div class="custom-select content">
                                                                        <label style="color:#212529e3; font-size: 13px"><?php echo $lang['mode'] ?></label>
                                                                        <select name="modeSelect" class="optionSelect" id="select_<?php echo $q; ?>" onchange="updateConsultationFee('<?php echo $q; ?>')">
                                                                            <option value="Hospital Visit"><?php echo $lang['hpv'] ?></option>
                                                                            <option value="Video Consultancy"><?php echo $lang['hpvc'] ?></option>
                                                                        </select>
                                                                        <div class="select-icon">&#9662;</div>
                                                                    </div>
                                                                    <div class="h4-search content" style="display:flex; flex-direction:row;">
                                                                        <?php echo $lang['cf'] ?><b>
                                                                            <div class="result" id="result_<?php echo $q; ?>">
                                                                                &nbsp;<?php echo $selectedVariables[$x]; ?>&nbsp;
                                                                            </div>
                                                                        </b>
                                                                        <black style=" color:#000; font-size:13px">[</black>
                                                                        <red style="color:red; font-size:13px"><?php echo $lang['nrefun'] ?></red>
                                                                        <black style="color:#000; font-size:13px">]</black>
                                                                    </div>
                                                                    <br>
                                                                    <input type="hidden" name="scheduleid" value='<?php echo $scheduleid ?>'>
                                                                    <input type="hidden" name="docid" value='<?php echo $docid ?>'>
                                                                    <button name='submitButton' id="submitButton" class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                        <font class="tn-in-text"><?php echo $lang['bkn'] ?></font>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </td>
                                        <?php    }
                                                echo "</tr>";
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
    var seatleft = <?php echo $seatleft ?>;
    var bookingLink = document.getElementById("bookingLink");

    if (seatleft === 0) {
        bookingLink.classList.add("disabled-link");
    }
</script>
<script>
    function updateConsultationFee(scheduleid) {
        var modeSelect = document.getElementById("select_" + scheduleid);
        var resultDiv = document.getElementById("result_" + scheduleid);

        var selectedValue = modeSelect.value;
        var consultationFee = selectedValue === "Hospital Visit" ? "₹100" : "₹250"; // You can adjust the fees based on your actual logic

        resultDiv.innerHTML = "&nbsp;" + consultationFee + "&nbsp;";
    }
</script>
<script>
    // Get a reference to the language dropdown
    const languageDropdown = document.getElementById("language");

    // Add an event listener to the dropdown
    languageDropdown.addEventListener("change", function() {
        // Get the selected language code
        const selectedLanguage = this.value;

        // Get the current URL
        const currentURL = window.location.href;

        // Check if there's already a query string in the URL
        const separator = currentURL.includes("?") ? "&" : "?";

        // Construct the new URL with the selected language
        const newURL = currentURL + separator + "lang=" + selectedLanguage;

        // Redirect to the new URL
        window.location.href = newURL;
    });
</script>

</html>