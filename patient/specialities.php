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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <title>Sessions</title>
    <style>
        .image-display {
            animation: transitionIn-Y-over 0.5s;
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

        .image-display,
        .image-display a {
            display: flex;
            flex-direction: row;
            text-decoration: none;

        }

        .special-box {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 15px;
            width: 23.3VW;
            text-align: left;
            display: flex;
            flex-direction: row;
            align-items: center;
            color: #000;
            font-size: 15px;
        }

        .box-tests {
            width: 30VW;
        }

        .box-tests:hover {
            border: 1px solid #aaa !important;
        }

        .special-box img {
            margin: 0 20px 0 5px;
        }

        .special-box:hover {
            border: 1px solid #4c4c4c;
            cursor: pointer;
        }

        .abc {
            height: 77vh;
        }

        .book-text-button {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            font-size: 25px;
        }

        .special-box {
            display: flex;
            align-items: center;
        }

        .add-icon-container {
            margin-left: auto;
        }

        .add-icon-container p {
            padding: 6px 10px 6px 10px;
            border-radius: 2px;
            margin: 15px;
            width: fit-content;
            text-align: center;
            font-size: 12px;
        }

        .add-icon-container p:hover,
        .remove-from-cart:hover {
            transition: .25s;
        }

        .remove-from-cart {
            padding: 6px 10px 6px 10px;
            border-radius: 2px;
            margin: 15px;
            width: fit-content;
            text-align: center;
            font-size: 12px;
            cursor: pointer;
            margin-left: auto;

        }

        .billing-cart {
            padding: 5px 8px 5px 8px;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 5px #eaeaea;
            border-radius: 5px;
            margin: 15px;
            width: fit-content;
            text-align: center;
            align-items: center;
            color: #000;
            font-size: 15px;
            width: 35vw;
            height: 74vh;
            overflow-y: scroll;
        }

        .billing-cart p {
            padding-left: 10px;
        }

        .test-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 30VW;
            text-align: left;
            color: #000;
            font-size: 15px;
            justify-content: center;
            margin: auto;
            margin-top: 15px;
        }

        #payButton {
            pointer-events: none;
            opacity: .7;
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
                    <td class="menu-btn menu-icon-home ">
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
                    <td class="menu-btn menu-icon-assistant">
                        <a href="assistant.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Assistant</p>
                        </a>
        </div>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-settings">
                <a href="settings.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">Settings</p>
                </a>
    </div>
    </td>
    </tr>
    </table>
    </div>
    <?php
    if ($_GET['action'] == null) {
        $sqlmain = "SELECT * from specialties order by sname ASC";
        $sqlpt1 = "";
        $insertkey = "";
        $q = '';
        $searchtype = "All";
        if ($_POST) {
            //print_r($_POST);

            if (!empty($_POST["search"])) {
                /*TODO: make and understand */
                $keyword = $_POST["search"];
                $sqlmain = "select * from specialties where (sname='$keyword' or sname like '$keyword%' or sname like '%$keyword' or sname like '%$keyword%') order by sname asc";
                #echo $sqlmain;
                $insertkey = $keyword;
                $searchtype = "Search Result : ";
                $q = '"';
            }
        }
    } else if ($_GET['action'] == 'book_test') {
        $sqlmain = "SELECT * from medical_test order by tname ASC";
        $sqlpt1 = "";
        $insertkey = "";
        $q = '';
        $searchtype = "All";
        if ($_POST) {
            //print_r($_POST);

            if (!empty($_POST["search"])) {
                /*TODO: make and understand */
                $keyword = $_POST["search"];
                $sqlmain = "SELECT * from medical_test where (tname='$keyword' or tname like '$keyword%' or tname like '%$keyword' or tname like '%$keyword%') order by tname ASC";
                #echo $sqlmain;
                $insertkey = $keyword;
                $searchtype = "Search Result : ";
                $q = '"';
            }
        }
    }
    $stmt = $database->prepare($sqlmain);
    $stmt->execute();
    $result = $stmt->get_result();


    ?>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="specialities.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Specialities" list="doctors" value="<?php echo $insertkey ?>">&nbsp;&nbsp;

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
                <td colspan="4" style="padding-top:10px;width: 100%;">
                    <?php if ($_GET['action'] == null) { ?>
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $searchtype . " Specialities" . "(" . $result->num_rows . ")"; ?> </p>
                    <?php } else if ($_GET['action'] == 'book_test') { ?>
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $searchtype . " Tests" . "(" . $result->num_rows . ")"; ?> </p>
                    <?php } ?>
                    <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)"><?php echo $q . $insertkey . $q; ?> </p>
                </td>
            </tr>



            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                                <tbody>
                                    <?php if ($_GET['action'] == null) { ?>
                                        <tr>
                                            <div class="image-display">
                                                <a href="?action=book_test">
                                                    <div class="special-box" style="width:73.9vw; padding:0 0 0 0; display:flex; flex-direction: row; justify-content: center;">
                                                        <img src="../img/sicon/medical-test.png" alt="image" width="55px" height="55px">
                                                        <p class="book-text-button">Book for a Test</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </tr>
                                        <tr>
                                            <?php
                                            $a = 0;
                                            while ($userrow = $result->fetch_assoc()) {
                                                $sname = $userrow['sname'];
                                                $imgname = $userrow['imgname'];
                                                $sid = $userrow['id'];
                                                if ($a % 3 == 0) {
                                            ?> <div class="image-display">
                                                        <a href="schedule.php?id=<?php echo $sid ?>">
                                                            <div class="special-box"><img src="<?php echo $imgname ?>" alt="image" width="35px" height="35px">
                                                                <p><?php echo $sname; ?></p>
                                                            </div>
                                                        </a>
                                                    <?php } else if ($a % 3 == 1) { ?>
                                                        <a href="schedule.php?id=<?php echo $sid ?>">
                                                            <div class="special-box"><img src="<?php echo $imgname ?>" alt="image" width="35px" height="35px">
                                                                <p><?php echo $sname; ?></p>
                                                            </div>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="schedule.php?id=<?php echo $sid ?>">
                                                            <div class="special-box"><img src="<?php echo $imgname ?>" alt="image" width="35px" height="35px">
                                                                <p><?php echo $sname; ?></p>
                                                            </div>
                                                        </a>
                                                    </div>
                                            <?php    }
                                                $a++;
                                            }
                                            ?>
                                        </tr>
                                    <?php } else if ($_GET['action'] == 'book_test') { ?>
                                        <div class="flex-row">
                                            <div>
                                                <?php
                                                $a = 0;
                                                while ($userrow = $result->fetch_assoc()) {
                                                    $sname = $userrow['tname'];
                                                    $sprice = $userrow['price'];
                                                    $imgname = $userrow['imagename'];
                                                    $sid = $userrow['mtid'];
                                                ?>
                                                    <div class="image-display">
                                                        <div class="special-box box-tests">
                                                            <img src="<?php echo $imgname ?>" alt="image" width="35px" height="35px">
                                                            <p id="sname-<?php echo $a; ?>"><?php echo $sname; ?></p>
                                                            <p class="sprice" id="sprice-<?php echo $a; ?>" style="display:none"><?php echo $sprice; ?></p>
                                                            <div class="add-icon-container">
                                                                <p class="login-btn btn-primary-soft add-btn" data-sid="<?php echo $sid; ?>">+ ADD</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    $a++;
                                                }
                                                ?>
                                            </div>
                                            <div class="billing-cart">
                                                <p class="nothing">No Tests Selected</p>
                                                <p>Total = ₹<span id="total">0.00</span></p>
                                                <p id="payButton" style="cursor:pointer;"><img src="../img/payment-btn.png" width="40%"></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </center>
                </td>
            </tr>
        </table>
    </div>


</body>
<script>
    const addButtons = document.querySelectorAll('.add-btn');
    const removeButtons = document.querySelectorAll('.remove-btn');
    const billingCart = document.querySelector('.billing-cart');
    const nothing = document.querySelector('.nothing');
    const totalElement = document.getElementById('total');

    let totalSum = 0;

    billingCart.addEventListener('click', event => {
        console.log('Click on billingCart:', event.target); // Debug
        if (event.target.classList.contains('remove-from-cart')) {
            const removeButton = event.target;
            const testContainer = removeButton.parentElement; // Get the parent container
            const testIndex = removeButton.getAttribute('data-sid');
            const snameElement = document.getElementById('sname-' + testIndex);
            const sname = snameElement.textContent;

            addButtons.forEach(addButton => {
                if (addButton.getAttribute('data-sid') === testIndex) {
                    addButton.style.display = 'block';
                }
            });
            testContainer.style.display = 'none';

            // Remove the corresponding test name from billing cart
            const billingCartTests = billingCart.querySelectorAll('p');
            billingCartTests.forEach(test => {
                if (test.getAttribute('data-sid') === testIndex) {
                    test.remove();
                }
            });
            fetch(`get_test_price.php?mtid=${testIndex}`)
                .then(response => response.text())
                .then(testPrice => {
                    console.log('Test Price:', testPrice);
                    // Update the totalSum and totalElement here based on the retrieved price
                    totalSum -= parseFloat(testPrice);
                    totalElement.textContent = totalSum.toFixed(2);
                    console.log('testindex:', testIndex);

                    if (totalSum <= 0) {
                        payButton.style.pointerEvents = "none";
                        payButton.style.opacity = ".7";
                    }
                })
                .catch(error => {
                    console.error('Error fetching test price:', error);
                });
        }
    });

    addButtons.forEach((addButton, index) => {
        addButton.addEventListener('click', () => {
            console.log('Click on addButton:', index); // Debug
            const testName = document.getElementById('sname-' + index).textContent;
            const testPrice = document.getElementById('sprice-' + index).textContent;
            const testIndex = addButton.getAttribute('data-sid');

            // Create a container div for the added test and remove button
            const testContainer = document.createElement('div');
            testContainer.className = 'test-container';
            const newTest = document.createElement('p');
            newTest.textContent = testName + ' - ₹' + testPrice; // Modified line
            newTest.setAttribute('data-sid', testIndex);

            console.log(testPrice);

            payButton.style.pointerEvents = "auto";
            payButton.style.opacity = "1";

            const removeButton = document.createElement('p');
            removeButton.textContent = 'REMOVE';
            removeButton.className = 'login-btn btn-primary-soft remove-from-cart';
            removeButton.setAttribute('data-sid', testIndex);

            testContainer.appendChild(newTest);
            testContainer.appendChild(removeButton);
            billingCart.appendChild(testContainer);


            totalSum += parseFloat(testPrice);
            totalElement.textContent = totalSum.toFixed(2);

            addButton.style.display = 'none';
            removeButtons[index].style.display = 'block';
            nothing.style.display = 'none';
        });
    });
    console.log('totalSum:', totalSum);
    console.log('totalElement:', totalElement);


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
        return (totalSum * 100);
    }

    function handlePaymentResponse(response) {
        // Handle the payment response here
        console.log('Payment Response:', response);

        if (response.razorpay_payment_id) {
            alert('Payment successful! Payment ID: ' + response.razorpay_payment_id);
        } else {
            alert('Payment failed! Reason: ' + response.error.description);
        }
    }
</script>
<script>
    var seatleft = <?php echo $seatleft ?>;
    var bookingLink = document.getElementById("bookingLink");

    if (seatleft === 0) {
        bookingLink.classList.add("disabled-link");
    }
</script>

</html>