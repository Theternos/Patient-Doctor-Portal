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
    include("./config.php");
    // error_reporting(0);
    ?>

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

        .special-box:hover {
            transform: scale(1.03);
            transition: .25s;
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

        .booooking-test:hover {
            transform: scale(1) !important;
            transition: 0s !important;
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
            border-radius: 5px;
            margin: 15px;
            text-align: center;
            align-items: center;
            color: #000;
            font-size: 15px;
            width: 95%;
            max-height: 48vh;
            min-height: 48vh;
            overflow-y: scroll;
        }

        .billing-cart p {
            padding-left: 10px;
        }

        .bill-cart {
            padding: 5px 8px 5px 8px;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 5px #eaeaea;
            border-radius: 20px;
            margin: 15px;
            width: fit-content;
            text-align: center;
            align-items: center;
            color: #000;
            font-size: 15px;
            width: 35vw;
            max-height: 74vh;
            font-family: 'Montserrat', sans-serif;
        }

        .bill-cart h3 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            margin-left: 10px;
            letter-spacing: 1px;
        }

        .test-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 0px;
            padding: 0px;
            border-radius: 5px;
            border-bottom: 1px solid #ccc;
            width: 30vw;
            text-align: left;
            color: #000;
            font-size: 15px;
            justify-content: center;
            margin: auto;
            margin-top: 5px;
            font-family: 'Montserrat', sans-serif;
            transition: .1s;
        }

        .test-container:hover {
            box-shadow: 0 0px 0px 0 #00000033, 0 0px 3px 0 #00000030;
            transition: .1s;
        }

        #payButton {
            pointer-events: none;
            opacity: .7;
            cursor: pointer;
            width: fit-content;
            padding: 8px 40px 8px 40px;
            border-radius: 5px;
            margin: auto;
            letter-spacing: 1px;
        }

        .bill-amount {
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            letter-spacing: 1px;
        }

        .bill-amount span,
        .bill-amount b {
            font-weight: 500;
        }

        .speciality-name-list {
            min-width: 35vw;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com



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
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text"><?php echo $lang['sp-home'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['sp-all-doctors'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>

                <tr class="menu-row">
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="specialities.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text"><?php echo $lang['sp-book-appointment'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['sp-my-bookings'] ?></p>

                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-recent">
                        <a href="recent.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['sp-recent-consultancy'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-test">
                        <a href="recent_tests.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['sp-analysis-history'] ?></p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-payment">
                        <a href="payment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text"><?php echo $lang['sp-payments'] ?></p>
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
        <?php
        if ($_GET['action'] == null) {
            $sqlmain = "SELECT * from specialties order by sname ASC";
            $sqlpt1 = "";
            $insertkey = "";
            $q = '';
            $searchtype = $lang['sp-all'];
            if ($_POST) {
                //print_r($_POST);

                if (!empty($_POST["search"])) {
                    /*TODO: make and understand */
                    $keyword = $_POST["search"];
                    $sqlmain = "select * from specialties where (sname='$keyword' or sname like '$keyword%' or sname like '%$keyword' or sname like '%$keyword%') order by sname asc";
                    #echo $sqlmain;
                    $insertkey = $keyword;
                    $searchtype = $lang['sp-search-result'];
                    $q = '"';
                }
            }
        } else if ($_GET['action'] == 'book_test') {
            $sqlmain = "SELECT * from medical_test order by tname ASC";
            $sqlpt1 = "";
            $insertkey = "";
            $q = '';
            $searchtype = $lang['sp-all'];
            if ($_POST) {
                //print_r($_POST);

                if (!empty($_POST["search"])) {
                    /*TODO: make and understand */
                    $keyword = $_POST["search"];
                    $sqlmain = "SELECT * from medical_test where (tname='$keyword' or tname like '$keyword%' or tname like '%$keyword' or tname like '%$keyword%') order by tname ASC";
                    #echo $sqlmain;
                    $insertkey = $keyword;
                    $searchtype = $lang['sp-search-result'];
                    $q = '"';
                }
            }
        }
        $stmt = $database->prepare($sqlmain);
        $stmt->execute();
        $result = $stmt->get_result();


        ?>

        <div class="dash-body">
            <table border="0" width="0%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; max-width:90%">
                <tr>
                    <td>
                        <a href="specialities.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text"><?php echo $lang['sp-back'] ?></font>
                            </button></a>
                    </td>
                    <td>
                        <form action="" method="post" class="header-search">
                            <?php
                            $action = isset($_GET['action']) ? $_GET['action'] : '';

                            if ($action === '') {
                                $placeholder = "Search Specialities";
                                $query = "SELECT DISTINCT * FROM specialties;";
                            } elseif ($action === 'book_test') {
                                $placeholder = "Search Tests";
                                $query = "SELECT DISTINCT * FROM medical_test;";
                            }

                            $insertkey = isset($_POST['search']) ? $_POST['search'] : '';

                            echo '<input type="search" name="search" class="input-text header-searchbar" placeholder="' . $placeholder . '" list="options" value="' . $insertkey . '">&nbsp;&nbsp;';

                            // Fetch data and populate the datalist
                            $list = $database->query($query);

                            echo '<datalist id="options">';

                            while ($row = $list->fetch_assoc()) {
                                $value = $row["docname"] ?? $row["title"];
                                echo "<option value='$value'>";
                            }

                            echo '</datalist>';
                            ?>

                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </form>

                    </td>
                    <td>
                        <div class="flex-row" style="margin-left: auto;">
                            <div class="flex-row" style="margin-left:auto;">
                                <div class="flex-column">
                                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                        <?php echo $lang['sp-todays-date'] ?>
                                    </p>
                                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                                        <?php
                                        echo $today;
                                        ?>
                                    </p>
                                </div>
                                <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </div>
                            <div class="language-select" style="width: 70px; margin-left:auto;">
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
                        </div>
                    </td>

                </tr>

                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <?php if ($_GET['action'] == null) { ?>
                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $searchtype . $lang["sp-sp"] . "(" . $result->num_rows . ")"; ?> </p>
                        <?php } else if ($_GET['action'] == 'book_test') { ?>
                            <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $searchtype . $lang["sp-test"] . "(" . $result->num_rows . ")"; ?> </p>
                        <?php } ?>
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
                                                        <div class="special-box booooking-test" style="width:73.9vw; padding:0 0 0 0; display:flex; flex-direction: row; justify-content: center;">
                                                            <img src="../img/sicon/medical-test.png" alt="image" width="55px" height="55px">
                                                            <p class="book-text-button"><?php echo $lang['sp-book-for-test'] ?></p>
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
                                                                    <p><?php echo $lang[$sname]; ?></p>
                                                                </div>
                                                            </a>
                                                        <?php } else if ($a % 3 == 1) { ?>
                                                            <a href="schedule.php?id=<?php echo $sid ?>">
                                                                <div class="special-box"><img src="<?php echo $imgname ?>" alt="image" width="35px" height="35px">
                                                                    <p><?php echo $lang[$sname]; ?></p>
                                                                </div>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="schedule.php?id=<?php echo $sid ?>">
                                                                <div class="special-box"><img src="<?php echo $imgname ?>" alt="image" width="35px" height="35px">
                                                                    <p><?php echo $lang[$sname]; ?></p>
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
                                                <div class="speciality-name-list" style="height: 76vh; overflow-y:scroll; margin-top: 1vh">
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
                                                                <p id="sname-<?php echo $a; ?>"><?php echo $lang[$sname]; ?></p>
                                                                <p class="sprice" id="sprice-<?php echo $a; ?>" style="display:none"><?php echo $sprice; ?></p>
                                                                <div class="add-icon-container">
                                                                    <p class="login-btn btn-primary-soft add-btn" data-sid="<?php echo $sid; ?>"><?php echo $lang['sp-add'] ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                        $a++;
                                                    }
                                                    ?>
                                                </div>
                                                <div class="bill-cart">
                                                    <div class="flex-row" style="justify-content: center; border-bottom: 1px solid #ccc; border-radius: 10px;background-color: #202020;color: #eaeaea;">
                                                        <img src="../img/shoping-cart.svg" alt="" width="25px">
                                                        <h3><?php echo $lang['sp-cart'] ?></h3>
                                                    </div>
                                                    <div class="billing-cart">
                                                        <div id="nothing" style="padding-top: 11vh;">
                                                            <img src="../img/notfound.svg" width="45%"><br>
                                                            <p style="color: #4c4c4c;"><?php echo $lang['sp-no-selected'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-column" style="border-top: 2px solid #202020;">
                                                        <p class="bill-amount"><?php echo $lang['sp-total'] ?> &nbsp;&nbsp; - &nbsp;&nbsp; <b>Rs.</b><span id="total">0.00</span></p>
                                                        <p id="payButton" class="login-btn btn-primary-soft"><?php echo $lang['sp-checkout'] ?></p>
                                                    </div>
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
    const nothing1 = document.getElementById('nothing');
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
                        nothing1.style.display = 'block';
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
            newTest.textContent = testName + ' - Rs. ' + testPrice; // Modified line
            newTest.setAttribute('data-sid', testIndex);

            console.log(testPrice);

            payButton.style.pointerEvents = "auto";
            payButton.style.opacity = "1";
            nothing1.style.display = 'none';

            const removeButton = document.createElement('p');
            removeButton.textContent = "<?php echo $lang['sp-remove'] ?>";
            removeButton.className = 'login-btn btn-primary-soft remove-from-cart';
            removeButton.setAttribute('data-sid', testIndex);

            testContainer.appendChild(newTest);
            testContainer.appendChild(removeButton);
            billingCart.appendChild(testContainer);


            totalSum += parseFloat(testPrice);
            totalElement.textContent = totalSum.toFixed(2);

            addButton.style.display = 'none';
            removeButtons[index].style.display = 'block';
        });
    });
    console.log('totalSum:', totalSum);
    console.log('totalElement:', totalElement);

    const payButton = document.getElementById('payButton');

    payButton.addEventListener('click', () => {
        const selectedTests = [];
        const selectedTestElements = billingCart.querySelectorAll('.test-container');

        selectedTestElements.forEach(testContainer => {
            const testIndex = testContainer.querySelector('p').getAttribute('data-sid');
            selectedTests.push(testIndex);
        });

        if (selectedTests.length > 0) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'booking_test.php';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selectedTests';
            input.value = selectedTests.join(',');

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
</script>
<script>
    var seatleft = <?php echo $seatleft ?>;
    var bookingLink = document.getElementById("bookingLink");

    if (seatleft === 0) {
        bookingLink.classList.add("disabled-link");
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