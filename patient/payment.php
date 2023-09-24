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
    <?php
    include("./config.php") ?>
    <title>Dashboard</title>
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

        .workout_img {
            width: 110px;
            height: 110px;
            margin: 0 15px 0 15px;
        }

        #pagination button {
            width: 10vw;
            margin-right: 2vw;
        }

        .wallet-disclaimer {
            background-color: #ece2d070;
            color: #202020;
            padding: 1vh 1vw 1vh 2.3vw;
            margin: 2vh 2.1vw 2vh 2.1vw;
            font-size: 14px;
            letter-spacing: 1px;
            border-radius: 5px;
        }
    </style>


</head>

<body>
    <?php

    //learn from w3schools.com

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
                    <td class="menu-btn menu-icon-payment-active menu-active">
                        <a href="payment.php" class="non-style-link-menu-active">
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
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"><?php echo $lang['payreport'] ?></p>

                    </td>
                    <td width="25%">

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
                    <td width="8.5%">
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
            <div class="flex-column">
                <div class="payment-visuals">
                    <h3><?php echo $lang['paysummary'] ?></h3>
                    <div class="flex-row">
                        <?php
                        $result = $database->query("SELECT * from wallet INNER JOIN payment_history ON payment_history.pid = wallet.pid WHERE wallet.pid = '$userid' and phstatus != 3");
                        $amount = 0;
                        while ($summary_row = $result->fetch_assoc()) {
                            $amount += $summary_row['amount'];
                            $balance = $summary_row['balance'];
                            $bonus = $summary_row['bonus'];
                        }
                        $summary_row = $result->fetch_assoc();
                        ?>
                        <div class="payment-visuals-box flex-row">
                            <img src="../img/icons/balance.svg" alt="Balance icon" width="35px">
                            <p><?php echo $lang['paybalance'] ?></p>
                            <b>₹<?php echo $balance ?></b>
                        </div>
                        <div class="payment-visuals-box flex-row">
                            <img src="../img/icons/total-spent.svg" alt="Total Spent icon" width="35px">
                            <p><?php echo $lang['paytspent'] ?></p>
                            <b>₹<?php echo $amount ?></b>
                        </div>
                        <div class="payment-visuals-box flex-row">
                            <img src="../img/icons/total-bonus.svg" alt="Total Bonus icon" width="35px">
                            <p><?php echo $lang['paytbonus'] ?></p>
                            <b>₹<?php echo $bonus ?></b>
                        </div>
                    </div>
                    <div class="wallet-disclaimer">
                        <p style="font-size: 15px;"><span style="color:red; margin-right:5px;"><?php echo $lang['note'] ?></span> <?php echo $lang['wafund'] ?></p>
                    </div>
                </div>
                <div class="payment-history">
                    <h3><?php echo $lang['phistory'] ?></h3>
                    <table width="95%" class="sub-table scrolldown" border="0">
                        <thead>
                            <tr>
                                <th class="table-headin">
                                    <?php echo $lang['date'] ?>
                                </th>
                                <th class="table-headin">
                                    <?php echo $lang['sessiontitle'] ?>

                                </th>
                                <th class="table-headin">
                                    <?php echo $lang['discount'] ?>

                                </th>
                                <th class="table-headin flex-column">
                                    <?php echo $lang['tcfee'] ?>
                                    <p style="font-weight: 400; margin: 0 0 0 0; font-size: 12px;"><?php echo $lang['bcrgincluded'] ?></p>
                                </th>
                                <th class="table-headin">
                                    <?php echo $lang['paid'] ?>
                                </th>
                                <th class="table-headin">
                                    <?php echo $lang['status'] ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="paymentTableBody">
                            <!-- Payment rows will be added here -->
                        </tbody>
                    </table>
                    <div id="pagination" class="flex-row" style="justify-content: center;">
                        <button class="logout-btn btn-primary-soft btn" id="prevButton" onclick="loadPayments(-1)"> <?php echo $lang['previous'] ?></button>
                        <button class="logout-btn btn-primary-soft btn" id="nextButton" onclick="loadPayments(1)"> <?php echo $lang['next'] ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var currentPage = 0; // Current page index
    var pageSize = 10; // Number of rows per page

    // Function to load payment history for a specific page
    function loadPayments(direction) {
        currentPage += direction;
        if (currentPage < 0) currentPage = 0;

        // Make an AJAX request to fetch payment data for the current page
        $.ajax({
            url: 'fetch_payments.php', // Replace with your server-side script to fetch payments
            method: 'GET',
            data: {
                page: currentPage,
                pageSize: pageSize
            },
            success: function(data) {
                $('#paymentTableBody').html(data);
                updatePaginationButtons();
            }
        });
    }

    // Function to update pagination buttons
    function updatePaginationButtons() {
        $('#prevButton').prop('disabled', currentPage === 0);
    }

    // Initial load
    loadPayments(0);
</script>
<script>
    // Get a reference to the language dropdown
    const languageDropdown = document.getElementById("language");

    // Add an event listener to the dropdown
    languageDropdown.addEventListener("change", function() {
        // Get the selected language code
        const selectedLanguage = this.value;

        // Get the current URL
        const currentURL = "./payment.php"

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