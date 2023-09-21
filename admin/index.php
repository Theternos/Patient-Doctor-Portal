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
    <script type="text/javascript" src="../js/chart.js"></script>
    <script type="text/javascript" src="../js/highcharts.js"></script>
    <script type="text/javascript" src="../js/apexcharts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Dashboard</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container,
        #splineAreaChartContainer,
        .analytics,
        #chart-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .top-doctor {
            animation: transitionIn-Zoom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .top-doctor {
            width: 300px;
            height: 250px;
            border-radius: 5px;
            color: #f1f1f1;
            background-color: #000562;
            font-family: 'Montserrat', sans-serif;
            padding: 1px 20px 10px 20px;
            font-size: 12px;
        }

        .top-doctor h4 {
            font-size: 14px;
            letter-spacing: 1px;
            font-weight: 500;
        }

        .analytics {
            width: 26vw;
            height: 280px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .notification-center {
            color: #f1f1f1;
            background-color: #000562;
            width: 300px;
            height: 250px;
            border-radius: 5px;
            position: absolute;
            margin: 22px .9vw 0 0;
            right: 0;
            opacity: 0;
            display: none;
            transition: opacity 0.3s ease;
            padding: 1px 20px 10px 20px;
            font-family: 'Montserrat', sans-serif;
        }

        .notification-center h4 {
            font-size: 14px;
            letter-spacing: 1px;
            font-weight: 500;
        }

        .notification-center.visible {
            opacity: 1;
        }

        .accept,
        .reject {
            margin: 3px;
            height: 26px;
            width: 26px;
            background-color: #f1f1f1;
            padding: 6.5px 5px 5px 8px;
            border-radius: 10px;
            text-decoration: none;
            color: #000;
        }

        .accept:hover {
            background-color: green;
            color: #fff;
        }

        .reject:hover {
            background-color: red;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");

    date_default_timezone_set('Asia/Kolkata');
    $today = date('Y-m-d');
    $patientrow = $database->query("select  * from  patient;");
    $doctorrow = $database->query("select  * from  doctor;");
    $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
    $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");
    if (!$patientrow || !$doctorrow || !$appointmentrow || !$schedulerow) {
        die("Database query error: " . $database->error);
    }

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
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@bitsathy.ac.in</p>
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
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Dashboard</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Doctors</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Schedule</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Appointment</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-lab">
                        <a href="laboratory.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Lab Technicians</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Patients</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-feedback">
                        <a href="feedback.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Feedbacks</p>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
                <tr>
                    <td colspan="4">
                        <center>
                            <table class="filter-container" style="border: none;" border="0">
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row" style="align-items:center;">
                                                <img src="../img/icons/stethoscope.svg" alt="" width="40px" height="50px">
                                                <div class="flex_column" style="justify-content:flex-start; align-items:center;">
                                                    <h2 style="margin: 5px 0 0 0;"><?php echo $doctorrow->num_rows  ?></h2>
                                                    <p class="h3-dashboard" style="margin:0 0 5px 0; ">Doctors</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row" style="align-items:center;">
                                                <img src="../img/icons/syringe.svg" alt="" width="40px" height="45px">
                                                <div class="flex_column" style="justify-content:flex-start; align-items:center;">
                                                    <h2 style="margin: 5px 0 0 0;"><?php echo $patientrow->num_rows  ?></h2>
                                                    <p class="h3-dashboard" style="margin:0 0 5px 0; ">Patients</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row" style="align-items:center; margin: 0 5px 0 5px;">
                                                <img src="../img/icons/appointment.svg" alt="" width="40px" height="40px">
                                                <div class="flex_column" style="justify-content:flex-start; align-items:center;">
                                                    <h2 style="margin: 5px 0 0 5px;"><?php echo $appointmentrow->num_rows  ?></h2>
                                                    <p class="h3-dashboard" style="margin:0 0 5px 5px; ">Appointments</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row" style="align-items:center; margin: 0 5px 0 5px;">
                                                <img src="../img/icons/admin_session.svg" alt="" width="40px" height="40px">
                                                <div class="flex_column" style="justify-content:flex-start; align-items:center;">
                                                    <h2 style="margin: 5px 0 0 5px;"><?php echo $schedulerow->num_rows  ?></h2>
                                                    <p class="h3-dashboard" style="margin:0 0 5px 5px; ">Sessions</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row" style="padding: 17px; cursor:pointer">
                                                <?php
                                                $result = $database->query("SELECT * FROM schedule INNER JOIN doctor on doctor.docid = schedule.docid WHERE leave_status = 1 LIMIT 2");
                                                if ($result->num_rows > 0) {
                                                ?>
                                                    <img src="../img/icons/bell-notofication.svg" id="notificationToggle" alt="" width="30px">
                                                <?php } else { ?>
                                                    <img src="../img/icons/bell.svg" alt="" width="30px">
                                                <?php } ?>
                                            </div>
                                            <div class="notification-center" id="notificationCenter">
                                                <h4>Notification Center</h4>
                                                <div class=" flex-row" style="margin-top: 0; font-size:12px; border-bottom: 1px solid #ccc;">
                                                    <?php
                                                    for ($y = 0; $y < $result->num_rows; $y++) {
                                                        $row = $result->fetch_assoc();
                                                        $id = $row['scheduleid'];
                                                    ?><div class="flex-column" style="justify-content: flex-start; align-items:flex-start;">
                                                            <p style="font-weight: 500; margin-bottom: 0; padding: 0 0 0 0;"><?php echo $row['docname'] ?></p>
                                                            <p><?php echo $row['leave_reason'] ?></p>
                                                        </div>
                                                        <div class="flex-row" style="margin: auto; margin-left: auto;">
                                                            <a href="./delete-session.php?id=<?php echo $id ?>&status=accept" class="accept fa fa-check accept" style="padding-left: 7px;" aria-hidden="true" name="accept" onclick="return confirm('Are you sure you want to Accept?')"></a>
                                                            <a href="./delete-session.php?id=<?php echo $id ?>&status=reject" class="reject fa fa-close reject" aria-hidden="true" name="reject" onclick="return confirm('Are you sure you want to Reject?')"></a>
                                                        </div> <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
            <div class="flex-row">
                <div class="flex-column">
                    <div style="margin-bottom: 20px;">
                        <div id="splineAreaChartContainer" style="width: 54vw; height: 250px; border: 1px solid #ccc; border-radius: 5px;"></div>
                    </div>
                    <div class="flex-row" style="justify-content:space-between;">
                        <div class="analytics" id="chart"></div>
                        <div class="analytics" style="padding-top: 0px;">
                            <h4 style="text-align: center;">Top Reported Specialities - Last 5 Days</h4>
                            <canvas id="hospitalChart"></canvas>
                        </div>
                    </div>
                </div>
                <br>
                <div class="flex-column">
                    <div style="margin-bottom: 20px;">
                        <div class="top-doctor">
                            <h4>Popular Doctor List</h4>
                            <div>
                                <div class="flex-row" style="margin-top: 0;">
                                    <h5>Doctor Name</h5>
                                    <h5 style="margin-left: auto;">Rating</h4>
                                </div>
                                <div class=" flex-row" style="margin-top: 0; border-bottom: 1px solid #ccc;">
                                    <?php
                                    $query = "SELECT doctor.docname, AVG(doc_review.rating) AS average_rating FROM doc_review INNER JOIN doctor ON doctor.docid = doc_review.docid GROUP BY doctor.docname";

                                    $result = $database->query($query);

                                    if (!$result) {
                                        die("Query failed: " . $database->error);
                                    }

                                    // Loop through the results and display the average rating for each doctor
                                    while ($row = $result->fetch_assoc()) {
                                        $docname = $row['docname'];
                                        $averageRating = $row['average_rating'];

                                        // Display doctor name and average rating
                                        echo "<p> $docname </p>";
                                        echo '<p style="margin-left: auto;">' . substr($averageRating, 0, 3) . ' ⭐</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="chart-container" style="position: relative; border: 1px solid #ccc; border-radius: 5px; height: 280px; width: 300px; padding:0 0 5px 10px; background-color: #fcfcfc;">
                        <canvas id="myDoughnutChart" height="200px" width="200px"></canvas>
                        <div id="total-label" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, 130%); font-size: 12px; font-weight: bold;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    $result = $database->query("SELECT schedule.scheduledate, schedule.title,
    schedule.scheduleid, COUNT(appointment.scheduleid) AS patient_count FROM schedule LEFT JOIN appointment ON appointment.scheduleid = schedule.scheduleid
    WHERE schedule.scheduledate >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY schedule.scheduledate, schedule.scheduleid ORDER BY patient_count DESC;");

    // Initialize an array to store the sum of patient_count for each title
    $titleCounts = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row["title"];
            $patientCount = $row["patient_count"];

            if (!isset($titleCounts[$title])) {
                $titleCounts[$title] = 0;
            }

            $titleCounts[$title] += $patientCount;
        }
    }


    // Sort the titleCounts array in descending order by patient count
    arsort($titleCounts);

    // Get the top three titles
    $topTitles = array_slice($titleCounts, 0, 3);

    // Loop through the top three titles and fetch their schedule dates and patient counts
    foreach ($topTitles as $title => $count) {
        // echo "Title: $title<br>";
        // echo "Schedule Date\tPatient Count<br>";

        // Execute a new query to fetch schedule dates and patient counts for the title
        $sql = "SELECT schedule.scheduledate, COUNT(appointment.scheduleid) AS patient_count 
            FROM schedule 
            LEFT JOIN appointment ON appointment.scheduleid = schedule.scheduleid 
            WHERE schedule.title = '$title' 
            GROUP BY schedule.scheduledate 
            ORDER BY schedule.scheduledate ASC";

        $result = $database->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $scheduleDate = $row["scheduledate"];
                $patientCount = $row["patient_count"];

                // echo "$scheduleDate\t$patientCount<br>";
            }
        }

        // echo "<br>";
    }

    ?>
    <script>
        // Function to get day name for a given date
        function getDayName(date) {
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            return days[date.getDay()];
        }

        // Get today's date
        const today = new Date();

        // Generate labels for the past 7 days
        const labels = [];
        for (let i = 4; i >= 0; i--) {
            const pastDate = new Date(today);
            pastDate.setDate(today.getDate() - i);
            labels.push(getDayName(pastDate));
        }

        const config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Cardio',
                        data: [45, 32, 56, 43, 67], // Replace with your hospital data
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.5)',
                        yAxisID: 'y',
                    },
                    {
                        label: 'General OP',
                        data: [25, 42, 35, 62, 48], // Replace with your hospital data
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.5)',
                        yAxisID: 'y1',
                    },
                    {
                        label: 'Ortho',
                        data: [2, 24, 55, 12, 78], // Replace with your hospital data
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 255, 0, 0.5)',
                        yAxisID: 'y2',
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        },
                    },
                }
            },
        };

        const ctx = document.getElementById('hospitalChart').getContext('2d');
        new Chart(ctx, config);
    </script>

</body>



<?php
$video_result = $database->query("SELECT EXTRACT(YEAR_MONTH FROM STR_TO_DATE(appointment.booking_date, '%Y-%m-%d %H:%i:%s')) AS booking_month, COUNT(*) AS booking_count FROM appointment INNER JOIN schedule ON schedule.scheduleid = appointment.scheduleid WHERE schedule.mode = 'Video Consultancy'");
$hospital_result = $database->query("SELECT EXTRACT(YEAR_MONTH FROM STR_TO_DATE(appointment.booking_date, '%Y-%m-%d %H:%i:%s')) AS booking_month, COUNT(*) AS booking_count FROM appointment INNER JOIN schedule ON schedule.scheduleid = appointment.scheduleid WHERE schedule.mode = 'Hospital Visit'");
$test_result = $database->query("SELECT DISTINCT payment_history.tid, payment_history.* FROM payment_history INNER JOIN test_booking ON test_booking.pid = payment_history.pid WHERE payment_history.tid IS NOT NULL;");
$video_row = $video_result->fetch_assoc();
$hospital_row = $hospital_result->fetch_assoc();
$test_report = $test_result->num_rows;

?>
<script type="text/javascript">
    var currentDate = new Date();

    // Create an array of real months for the past five months
    var categories = [];
    for (var i = 4; i >= 0; i--) {
        var month = new Date(currentDate);
        month.setMonth(currentDate.getMonth() - i);
        categories.push(month.toLocaleString('en-us', {
            month: 'short'
        }));
    }

    // Sample data
    var data = {
        categories: categories,
        series: [{
            name: 'Video Consultancy',
            data: [4, 14, 15, 9, <?php echo $video_row['booking_count'] ?>]
        }, {
            name: 'Hospital Visit',
            data: [12, 8, 1, 21, <?php echo $hospital_row['booking_count'] ?>]
        }, {
            name: 'Medical Tests',
            data: [10, 23, 9, 6, <?php echo $test_report ?>]
        }]
    };

    // Create the spline area chart
    Highcharts.chart('splineAreaChartContainer', {
        chart: {
            type: 'areaspline' // Set chart type to spline area
        },
        title: {
            text: 'Registration Analytics'
        },
        xAxis: {
            categories: data.categories
        },
        yAxis: {
            title: {
                text: 'No.of Patients'
            }
        },
        series: data.series
    });
</script>
<?php
$video_result = $database->query("SELECT * from appointment INNER JOIN schedule ON schedule.scheduleid = appointment.scheduleid WHERE mode = 'Video Consultancy'");
$hospital_result = $database->query("SELECT * from appointment INNER JOIN schedule ON schedule.scheduleid = appointment.scheduleid WHERE mode = 'Hospital Visit'");
$test_result = $database->query("SELECT DISTINCT payment_history.tid, payment_history.* FROM payment_history INNER JOIN test_booking ON test_booking.pid = payment_history.pid WHERE payment_history.tid IS NOT NULL;");
$test_money = 0;


if (($video_result->num_rows) > 0) {
    $video_consultancy = $video_result->num_rows;
    $video_consultancy_price = $video_consultancy * 250;
} else {
    $video_consultancy_price = 0;
}
if ($hospital_result->num_rows > 0) {
    $hospital_consultancy = $hospital_result->num_rows;
    $hospital_consultancy_price = $hospital_consultancy * 100;
} else {
    $hospital_consultancy_price = 0;
}
if ($test_result->num_rows > 0) {
    while ($price_row = $test_result->fetch_assoc())
        $test_money += $price_row['amount'];
} else
    $test_money = 0;
?>
<script type="text/javascript">
    var hospital_consultancy = <?php echo $hospital_consultancy_price ?>;
    var video_consultancy = <?php echo $video_consultancy_price ?>;
    var test_result = <?php echo $test_money ?>;

    // Calculate the total
    var total = video_consultancy + hospital_consultancy + test_result;

    // Rest of your JavaScript code
    var data = {
        labels: ["Video Consultancy", "Hospital Visit", "Medical Tests"],
        datasets: [{
            data: [video_consultancy, hospital_consultancy, test_result],
            backgroundColor: ["#D6E3F8", "#61c9a8", "#FF5A5F"],
        }],
    };

    var ctx1 = document.getElementById("myDoughnutChart").getContext("2d");

    var myDoughnutChart = new Chart(ctx1, {
        type: "doughnut",
        data: data,
        options: {
            tooltips: {
                enabled: false, // Disable default tooltips
            },
            animation: {
                duration: 1200, // Animation duration in milliseconds
                easing: "easeOutBounce", //  Easing function for the animation
            },
        },
    });

    // Update the total in the center
    var totalLabel = document.getElementById("total-label");
    totalLabel.textContent = "Rs. " + total.toFixed(2);
</script>
<?php

$sql = "SELECT DATE(paid_at) AS payment_date, COUNT(*) AS payment_count
        FROM payment_history
        GROUP BY payment_date
        ORDER BY payment_date DESC LIMIT 7";

$result = mysqli_query($database, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($database));
}

$dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
$paymentCounts = [];
$xAxisCategories = [];

while ($row = mysqli_fetch_assoc($result)) {
    $paymentDate = date("Y-m-d", strtotime($row['payment_date']));
    $dayOfWeek = date("w", strtotime($paymentDate)); // Get the numeric day of the week (0 = Sunday, 1 = Monday, ...)
    $dayName = $dayNames[$dayOfWeek]; // Get the corresponding day name

    $xAxisCategories[] = $dayName; // Store day name in x-axis categories array
    $paymentCounts[] = $row['payment_count']; // Store payment count in payment counts array
}

?>
<script type="text/javascript">
    var paymentCounts = <?php echo json_encode($paymentCounts); ?>;
    var xAxisCategories = <?php echo json_encode($xAxisCategories); ?>;

    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Patients',
            data: paymentCounts
        }],
        title: {
            text: 'Average Patient Visits '
        },
        xaxis: {
            categories: xAxisCategories
        },
        plotOptions: {
            bar: {
                distributed: true
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.5,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 100],
                colorStops: []
            }
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get references to the toggle button and notification center
        const toggleButton = document.getElementById("notificationToggle");
        const notificationCenter = document.getElementById("notificationCenter");

        // Variable to keep track of the notification center state
        let isNotificationCenterVisible = false;

        // Function to toggle the visibility of the notification center
        function toggleNotificationCenter() {
            if (isNotificationCenterVisible) {
                // Remove the "visible" class to hide with animation
                notificationCenter.classList.remove("visible");
                // Add a delay before hiding the element (same duration as the transition)
                setTimeout(() => {
                    notificationCenter.style.display = "none";
                }, 300);
            } else {
                // Display with animation
                notificationCenter.style.display = "block";
                // Add the "visible" class to show with animation
                setTimeout(() => {
                    notificationCenter.classList.add("visible");
                }, 0);
            }
            isNotificationCenterVisible = !isNotificationCenterVisible;
        }

        // Add a click event listener to the toggle button
        toggleButton.addEventListener("click", toggleNotificationCenter);
    });
</script>

</html>