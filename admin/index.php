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

    <title>Dashboard</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
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
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
                <?php
                date_default_timezone_set('Asia/Kolkata');
                $today = date('Y-m-d');
                $patientrow = $database->query("select  * from  patient;");
                $doctorrow = $database->query("select  * from  doctor;");
                $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");
                ?>
                <tr>
                    <td colspan="4">
                        <center>
                            <table class="filter-container" style="border: none;" border="0">
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row">
                                                <h2><?php echo $doctorrow->num_rows  ?></h2>
                                                <p class="h3-dashboard" style="margin-top: 22px; ">Doctors</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row">
                                                <h2><?php echo $patientrow->num_rows  ?></h2>
                                                <p class="h3-dashboard" style="margin-top: 22px; ">Patients</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row">
                                                <h2><?php echo $appointmentrow->num_rows  ?></h2>
                                                <p class="h3-dashboard" style="margin-top: 22px; ">Appointments</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items" style="margin:auto;width:70%;align-items:center;">
                                            <div class="flex-row">
                                                <h2><?php echo $schedulerow->num_rows  ?></h2>
                                                <p class="h3-dashboard" style="margin-top: 22px; ">Sessions</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <tr>
                    <div class="flex-row" style="justify-content: safe;">
                        <div>
                            <td>
                                <div id="splineAreaChartContainer" style="width: 50vw; height: 300px; border: 1px solid #ccc; border-radius: 5px; margin-left: 20px"></div>
                            </td>
                        </div>
                        <div>
                            <td>
                                <div id="chart-container" style="position: relative; border: 1px solid #ccc; border-radius: 5px; height: 300px; width: 300px; padding: 10px; background-color: #fcfcfc;">
                                    <canvas id="myDoughnutChart" height="200px" width="200px"></canvas>
                                    <div id="total-label" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, 150%); font-size: 12px; font-weight: bold;"></div>
                                </div>
                            </td>
                        </div>
                    </div>
                </tr>
            </table>
        </div>
    </div>


</body>

<script src="../js/chart.js"></script>
<script src="../js/highcharts.js"></script>


<?php
$video_result = $database->query("SELECT EXTRACT(YEAR_MONTH FROM STR_TO_DATE(appointment.booking_date, '%Y-%m-%d %H:%i:%s')) AS booking_month, COUNT(*) AS booking_count FROM appointment INNER JOIN schedule ON schedule.scheduleid = appointment.scheduleid WHERE schedule.mode = 'Video Consultancy'");
$hospital_result = $database->query("SELECT EXTRACT(YEAR_MONTH FROM STR_TO_DATE(appointment.booking_date, '%Y-%m-%d %H:%i:%s')) AS booking_month, COUNT(*) AS booking_count FROM appointment INNER JOIN schedule ON schedule.scheduleid = appointment.scheduleid WHERE schedule.mode = 'Hospital Visit'");
$test_result = $database->query("SELECT DISTINCT payment_history.tid, payment_history.* FROM payment_history INNER JOIN test_booking ON test_booking.pid = payment_history.pid WHERE payment_history.tid IS NOT NULL;");
$video_row = $video_result->fetch_assoc();
$hospital_row = $hospital_result->fetch_assoc();
$test_report = $test_result->num_rows;

?>
<script>
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
                text: 'Values'
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
<script>
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

    var ctx = document.getElementById("myDoughnutChart").getContext("2d");

    var myDoughnutChart = new Chart(ctx, {
        type: "doughnut",
        data: data,
        options: {
            tooltips: {
                enabled: false, // Disable default tooltips
            },
            animation: {
                duration: 1000, // Animation duration in milliseconds
                easing: "easeOutBounce", //  Easing function for the animation
            },
        },
    });

    // Update the total in the center
    var totalLabel = document.getElementById("total-label");
    totalLabel.textContent = "Rs. " + total.toFixed(2);
</script>

</html>