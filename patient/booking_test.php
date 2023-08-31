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
    <script src="../js/checkout.js"></script>

    <title>Booking Tests</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .pop-up {
            position: relative;
            width: 110px;
            left: -20%;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1;
            display: none;
        }

        .registration-disclaimer {
            background-color: #ece2d070;
            color: #202020;
            padding: 1vw;
            margin: 2vh 4.4vw 2vh 4.4vw;
            font-size: 14px;
            letter-spacing: 1px;
            border-radius: 5px;
        }

        .billing-disclaimer {
            background-color: #4ecdc440;
            color: #292D32;
            padding: 1px 15px 0 20px;
            margin: 7vh 0 4vh 0;
            font-size: 14px;
            letter-spacing: 1px;
            border-radius: 5px;
            height: 20vh;
            text-align: left;
        }

        .billing-disclaimer h6 {
            font-size: 13px;
            margin-left: 5px;
        }

        .billing-disclaimer p {
            margin-left: 30px;
            margin-top: 0;
        }

        .registration-details {
            width: 37vw;
            height: 70vh;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0px 20px 10px 20px;
            margin-right: auto;
            margin-left: 4.5vw;
        }

        .registration-details h5,
        .bill-details h5 {
            font-family: 'Josefin Sans', sans-serif;
            letter-spacing: 1px;
            text-align: left;
            font-size: 18px;
            color: #202020;
        }

        .registration-details p,
        .bill-details p {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            letter-spacing: 1px;
        }

        .bill-details {
            width: 30vw;
            height: 70vh;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0px 20px 10px 20px;
            margin-left: auto;
            margin-right: 4.5vw;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();
    error_reporting(0);
    date_default_timezone_set('UTC');

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
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];
    $phone_number = $userfetch["ptel"];


    date_default_timezone_set('Asia/Kolkata');

    $today = date('Y-m-d');
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
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Home</p>
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
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="specialities.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Book Appointment</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">My Bookings</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-recent">
                        <a href="recent.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Recent Consultancy</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-test">
                        <a href="recent_tests.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Analysis History</p>
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
                        <a href="specialities.php?action=book_test"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <form action="schedule.php" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors">&nbsp;&nbsp;

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
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <div style="animation: transitionIn-Y-over 0.5s;">
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
                                    <div class="registration-disclaimer">
                                        <p>One-time non-refundable registration fee of ₹110 is added. Kindly avoid re-registration.</p>
                                    </div>
                                    <div class="flex-row">
                                        <div class="registration-details">
                                            <?php
                                            $total_amount = 0;
                                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                                if (isset($_POST['selectedTests'])) {
                                                    $selectedTests = $_POST['selectedTests'];
                                                    $selectedTestIndexes = explode(',', $selectedTests);
                                            ?>
                                                    <h5>Tests Ordered</h5>
                                                    <div style="min-height: 56vh; max-height:56vh; overflow-y: scroll;">
                                                        <?php
                                                        foreach ($selectedTestIndexes as $testIndex) {
                                                            $result = $database->query("SELECT * FROM medical_test WHERE mtid = '$testIndex'");
                                                            $row = $result->fetch_assoc(); ?>
                                                            <div class="flex-row">
                                                                <p style="text-align: left;"><?php echo $row['tname'] ?></p>
                                                                <p style="margin-left: auto; margin-right:15px;"><?php echo '₹' . $row['price'] ?></p>
                                                            </div>
                                                        <?php
                                                            $total_amount += $row['price'];
                                                        } ?>
                                                    </div>
                                            <?php
                                                } else {
                                                    echo "No tests selected.";
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="bill-details">
                                            <div class="billing-disclaimer">
                                                <div class="flex-row">
                                                    <img src="../img/tick.svg" alt="" width="25px">
                                                    <h6>You can visit any day this week to get the tests done.</h6>
                                                </div>
                                                <p>General lab visiting timings: 10am to 4pm</p>
                                            </div>
                                            <div style="border-top: 1px solid #292D32; margin-top: 7vh;">
                                                <h5>Bill Details</h5>
                                                <div class="flex-row">
                                                    <p style="text-align: left;">Registration Fee</p>
                                                    <p style="margin-left: auto; margin-right:15px;">₹110</p>
                                                </div>
                                                <div class="flex-row">
                                                    <p style="text-align: left;">Item Total</p>
                                                    <p style="margin-left: auto; margin-right:15px;"><?php echo '₹' . $total_amount ?></p>
                                                </div>
                                                <div class="flex-row">
                                                    <p style="text-align: left;">Payable Amount</p>
                                                    <p style="margin-left: auto; margin-right:15px;"><?php echo '₹' . $total_amount + 110 ?></p>
                                                </div>
                                                <p id="payButton" class="login-btn btn-primary btn">Pay now</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }

                                if ($_GET) {
                                    $payment_id = $_GET["payment_id"];
                                    if ($payment_id != NULL) {
                                        if (isset($_COOKIE['selectedTestIndexes'])) {
                                            $selectedTestIndexesFromCookie = $_COOKIE['selectedTestIndexes'];
                                            $selectedTestIndexesArray = explode(',', $selectedTestIndexesFromCookie);
                                            foreach ($selectedTestIndexesArray as $testIndex) {
                                                $sql = "INSERT INTO test_booking (pid, mtid, payment_id) VALUES ('$userid', '$testIndex', '$payment_id')";
                                                $result = $database->query($sql);
                                            } ?>
                                            <script>
                                                window.location.href = './appointment.php';
                                            </script> <?php        }
                                                }
                                            }
                                                        ?>
                            </div>
                        </center>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
<script>
    var selectedTestsValue = "<?php echo isset($_POST['selectedTests']) ? $_POST['selectedTests'] : ''; ?>";

    if (selectedTestsValue !== '') {
        document.cookie = 'selectedTestIndexes=' + encodeURIComponent(selectedTestsValue) + '; expires=' + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + '; path=/';
    }
    const payButton = document.getElementById('payButton');

    const apiKey = 'rzp_test_FwDdTAoRqmPj0o';
    let totalSum = <?php echo $total_amount + 110;  ?>;

    document.getElementById('payButton').addEventListener('click', () => {
        const options = {
            key: apiKey,
            amount: calculateDynamicAmount(), // Amount in paise (e.g., ₹100 = 10000 paise)
            currency: 'INR',
            name: 'TEAM SLEEK - PEaS',
            description: 'Payment for Services',
            handler: response => {
                handlePaymentResponse(response);
            },
        };

        const rzp = new Razorpay(options);
        rzp.open();
    });

    function calculateDynamicAmount() {
        return (totalSum * 100);
    }

    function handlePaymentResponse(response) {
        // Handle the payment response here
        console.log('Payment Response:', response);

        if (response.razorpay_payment_id) {
            const paymentId = response.razorpay_payment_id;
            const currentUrl = window.location.href;
            const updatedUrl = currentUrl + '?payment_id=' + paymentId;
            window.location.href = updatedUrl; // Redirect to the updated URL
        } else {
            console.log('Payment failed! Reason: ' + response.error.description);
        }
    }
</script>


</html>