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
    <?php include("./config.php"); ?>

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
            margin: 1vh 0 2vh 0;
            font-size: 14px;
            letter-spacing: 1px;
            border-radius: 5px;
            height: 17vh;
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

        /* Style for checkboxes */
        .checkbox-container {
            display: inline-block;
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 2.5vh;
        }

        /* Hide the default checkbox */
        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Custom checkbox design */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border-radius: 3px;
        }

        /* Style the checked state */
        .checkbox-container input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Style the checkmark/indicator */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked~.checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
    </style>
</head>

<body>
    <?php

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
    setcookie('checkboxState', 0, time() + (3600), "/"); // 3600 = 1 hr
    date_default_timezone_set('Asia/Kolkata');
    $today = date('Y-m-d');
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
                        <a href="specialities.php?action=book_test"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text"><?php echo $lang['ddback'] ?></font>
                            </button></a>
                    </td>
                    <td>
                        <form action="schedule.php" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="<?php echo $lang['scrded']; ?>" list="doctors">&nbsp;&nbsp;
                            <datalist id="doctors">
                                <?php
                                $list11 = $database->query("select DISTINCT * from doctor;");
                                $list12 = $database->query("select DISTINCT * from schedule GROUP BY title;");

                                for ($y = 0; $y < $list11->num_rows; $y++) {
                                    $row00 = $list11->fetch_assoc();
                                    $d = $row00["docname"];

                                    echo "<option value='$d'><br/>";
                                }

                                for ($y = 0; $y < $list12->num_rows; $y++) {
                                    $row00 = $list12->fetch_assoc();
                                    $d = $row00["title"];

                                    echo "<option value='$d'><br/>";
                                }
                                ?>
                            </datalist>
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            <?php echo $lang['tddate'] ?>
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
                                        <p><?php echo $lang['onetime'] ?></p>
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
                                                                <p style="text-align: left;"><?php echo $lang[$row['tname']] ?></p>
                                                                <p style="margin-left: auto; margin-right:15px;"><?php echo 'Rs. ' . $row['price'] ?></p>
                                                            </div>
                                                        <?php
                                                            $total_amount += $row['price'];
                                                        } ?>
                                                    </div>
                                            <?php
                                                } else {
                                                    echo $lang['nts'];
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="bill-details">
                                            <div class="billing-disclaimer">
                                                <div class="flex-row">
                                                    <img src="../img/tick.svg" alt="" width="25px">
                                                    <h6><?php echo $lang['uvis'] ?></h6>
                                                </div>
                                                <p><?php echo $lang['grvis'] ?></p>
                                            </div>
                                            <div class="flex-row" style="justify-content:start;">
                                                <img src="../img/icons/discount.svg" alt="discount image" width="25px">
                                                <p style="margin-left: 5px; color: green;"><?php echo $lang['cb'] ?></p>
                                            </div>
                                            <div style="border-top: 1px solid #292D32; margin-top: 1vh; font-weight:500; padding: 0 0 0 0;">
                                                <?php
                                                $result12 = $database->query("SELECT * FROM wallet WHERE pid = '$userid'");
                                                $row12 = $result12->fetch_assoc();
                                                $balance = $row12['balance'];
                                                ?>
                                                <h5 style="margin:4vh 0 2vh 0 "><?php echo $lang['bdet'] ?></h5>
                                                <div class="flex-row" style="justify-content: flex-start; margin: 0 0 0 0;">
                                                    <label class="checkbox-container">
                                                        <input type="checkbox" id="subtractBalanceCheckbox" onchange="toggleCheckbox()">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p style="text-align: left; margin-left: 5px"><?php echo $lang['peas'] ?><br>
                                                        <w style="font-size: 11px; font-weight: 400;"><?php echo $lang['avba'] ?><?php echo $balance; ?></w>
                                                    </p>
                                                </div>

                                                <div class="flex-row">
                                                    <p style="text-align: left;"><?php echo $lang['regfee'] ?></p>
                                                    <p style="margin-left: auto; margin-right:15px;">Rs. 110</p>
                                                </div>
                                                <div class="flex-row">
                                                    <p style="text-align: left;"><?php echo $lang['item'] ?></p>
                                                    <p style="margin-left: auto; margin-right:15px;"><?php echo 'Rs. ' . $total_amount ?></p>
                                                </div>
                                                <div class="flex-row">
                                                    <p style="text-align: left;"><?php echo $lang['paam'] ?></p>
                                                    <p id="payableAmount" style="margin-left: auto; margin-right:15px;"><?php echo 'Rs. ' . ($total_amount + 110) ?></p>
                                                </div>
                                                <p id="payButton" class="login-btn btn-primary btn"><?php echo $lang['pn'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }

                                if ($_GET) {
                                    $payment_id = $_GET["payment_id"];
                                    if ($payment_id != NULL) {
                                        if (isset($_COOKIE['selectedTestIndexes'])) {
                                            $selectedTestIndexesFromCookie = $_COOKIE['selectedTestIndexes'];
                                            $toggle = $_COOKIE['checkboxState'];
                                            $selectedTestIndexesArray = explode(',', $selectedTestIndexesFromCookie);
                                            $length = count($selectedTestIndexesArray);
                                            $result34 = $database->query("SELECT balance from wallet WHERE pid = '$userid'");
                                            $row34 = $result34->fetch_assoc();
                                            $balance = $row34['balance'];
                                            $insert_balance = 0;
                                            $total_item_price = 0;
                                            $temp_insert_balance = 0;
                                            $overflow_amt = 0;
                                            foreach ($selectedTestIndexesArray as $testIndex) {
                                                $result23 = $database->query("SELECT * from medical_test INNER JOIN test_booking ON test_booking.mtid = medical_test.mtid WHERE medical_test.mtid = '$testIndex'");
                                                $row23 = $result23->fetch_assoc();
                                                $item_price = $row23['price'];
                                                $total_item_price += $item_price;
                                            }
                                            // echo "Total item price : " . $total_item_price;
                                            foreach ($selectedTestIndexesArray as $testIndex) {
                                                $database->query("INSERT INTO test_booking (pid, mtid, payment_id) VALUES ('$userid', '$testIndex', '$payment_id')");
                                                $result23 = $database->query("SELECT * from medical_test INNER JOIN test_booking ON test_booking.mtid = medical_test.mtid WHERE medical_test.mtid = '$testIndex'");
                                                $row23 = $result23->fetch_assoc();
                                                $tid = $row23['tid'];
                                                $title = $row23['tname'];
                                                $item_price = $row23['price'];
                                                // echo "<br>Item Price: " . $item_price . "<br>";
                                                if (isset($_COOKIE['newPayableAmount'])) {
                                                    $price = $_COOKIE['newPayableAmount'];
                                                } else {
                                                    $price = $row23['price'];
                                                }
                                                $total_paid = $price;
                                                // echo $total_paid;
                                                if ($toggle == 1) {
                                                    $price += (110 / $length);
                                                    $item_price += (110 / $length);
                                                }

                                                if ($toggle == 1 && $total_paid > 1) {
                                                    $insert_balance = 0;
                                                    $applied_discount = ($balance / $length);
                                                    if ($overflow_amt > 0)
                                                        $applied_discount += $overflow_amt;
                                                    if ($applied_discount > ($item_price - 1)) {
                                                        $overflow_amt = $applied_discount - (($item_price - 1) - (110 / $length));
                                                        $applied_discount -= $overflow_amt;
                                                    }
                                                    if ($length > 1)
                                                        $priceee = ($item_price - (110 / $length))  - $applied_discount;
                                                    else
                                                        $priceee = ($item_price)  - $applied_discount;

                                                    // echo "<br>Overflow Amount: " . $overflow_amt . "<br>";
                                                } elseif ($toggle == 0) {
                                                    $insert_balance = $balance;
                                                    $applied_discount = 0;
                                                    $priceee = $item_price + (110 / $length);
                                                } elseif ($toggle == 1 && $total_paid == 1) {
                                                    $temp_insert_balance += $item_price;
                                                    $insert_balance = $balance - $temp_insert_balance;
                                                    $applied_discount = ($total_item_price + 110) / $length;
                                                    $priceee = $total_paid / $length;
                                                }


                                                // echo "<br>" . "INSERT INTO payment_history (pid, tid, discount, amount, title, payment_id, total_paid) VALUES ('$userid', '$tid', '$applied_discount', '$priceee', '$title','$payment_id', '$total_paid')";
                                                $database->query("INSERT INTO payment_history (pid, tid, discount, amount, title, payment_id, total_paid) VALUES ('$userid', '$tid', '$applied_discount', '$priceee', '$title','$payment_id', '$total_paid')");
                                            }
                                            $bonus = ($total_paid / 100) * 2.5;
                                            $insert_balance += $bonus;
                                            // echo "<br>PEaS Wallet: " . $balance . "<br>";

                                            // echo "<br>" . "UPDATE wallet SET balance = '$insert_balance', bonus = bonus + $bonus WHERE pid = '$userid';" . "<br>";
                                            $database->query("UPDATE wallet SET balance = '$insert_balance', bonus = bonus + $bonus WHERE pid = '$userid';");
                                    ?>
                                            <script>
                                                window.location.href = './appointment.php';
                                            </script>
                                <?php        }
                                    }
                                }
                                $temp = 1;
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
    // Initialize temp with PHP value
    var temp = <?php echo $temp; ?>;

    // Function to toggle the checkbox and set the cookie
    function toggleCheckbox() {
        var checkbox = document.getElementById("subtractBalanceCheckbox");
        var balanceSpan = document.getElementById("balance");

        // Update the cookie value based on the checkbox state
        var cookieValue = checkbox.checked ? "1" : "0";

        var expirationDate = new Date();
        expirationDate.setTime(expirationDate.getTime() + (3600 * 1000));
        document.cookie = "checkboxState=" + cookieValue + "; expires=" + expirationDate.toUTCString() + "; path=/";

    }
</script>


<script>
    // Get references to elements
    const subtractBalanceCheckbox = document.getElementById('subtractBalanceCheckbox');
    const payableAmount = document.getElementById('payableAmount');
    var newPayableAmount = <?php echo $total_amount + 110 ?>;
    // Function to update payable amount based on checkbox state
    function updatePayableAmount() {
        const isChecked = subtractBalanceCheckbox.checked;
        const totalAmount = <?php echo $total_amount ?>;
        const balance = <?php echo $balance ?>;
        const registrationFee = 110;
        let tempAmount = totalAmount + registrationFee - balance;
        let newPayableAmount = isChecked ? (tempAmount >= 1 ? tempAmount.toFixed(2) : '1.00') : (totalAmount + registrationFee).toFixed(2);

        payableAmount.textContent = 'Rs. ' + newPayableAmount;

        var selectedTestsValue = "<?php echo isset($_POST['selectedTests']) ? $_POST['selectedTests'] : ''; ?>";

        if (selectedTestsValue !== '') {
            document.cookie = 'selectedTestIndexes=' + encodeURIComponent(selectedTestsValue) + '; expires=' + new Date(new Date().getTime() + 120 * 1000).toUTCString() + '; path=/';
            document.cookie = 'newPayableAmount=' + encodeURIComponent(newPayableAmount) + '; expires=' + new Date(new Date().getTime() + 100 * 1000).toUTCString() + '; path=/';
        }
        const payButton = document.getElementById('payButton');

        const apiKey = 'rzp_test_FwDdTAoRqmPj0o';

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
            return (newPayableAmount * 100);
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
    }

    // Add an event listener to the checkbox
    subtractBalanceCheckbox.addEventListener('change', updatePayableAmount);

    // Initial update based on checkbox state
    updatePayableAmount();
    var selectedTestsValue = "<?php echo isset($_POST['selectedTests']) ? $_POST['selectedTests'] : ''; ?>";

    if (selectedTestsValue !== '') {
        document.cookie = 'selectedTestIndexes=' + encodeURIComponent(selectedTestsValue) + '; expires=' + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + '; path=/';
    }
    const payButton = document.getElementById('payButton');

    const apiKey = 'rzp_test_FwDdTAoRqmPj0o';

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
        return (newPayableAmount * 100);
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