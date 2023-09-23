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

    <?php include("../patient/config.php") ?>
    <title>Patients</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
            width: 80%;
            margin: auto;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: relative;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content label {
            display: block;
            padding: 8px 16px;
            cursor: pointer;
        }

        .dropdown-content label:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com


    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'm') {
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
                                    <p class="profile-title">Pharmacy</p>
                                    <p class="profile-subtitle">pharmacy@bitsathy.ac.in</p>
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
                                <p class="menu-text">Home</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="medicine.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Medicines</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient-active menu-active">
                        <a href="patient.php" class="non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Today's Patients</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-recent">
                        <a href="recent.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">All Consultancy</p>
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
                        <a href="doctors.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>

                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Patient by Patient ID or Name or Schedule ID" list="doctors">&nbsp;&nbsp;

                            <?php
                            echo '<datalist id="doctors">';
                            $list11 = $database->query("select pname from report INNER JOIN patient ON patient.pid = report.pid;");
                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                $row00 = $list11->fetch_assoc();
                                $d = $row00["pname"];
                                echo "<option value='$d'><br/>";
                            };
                            echo ' </datalist>';
                            ?>
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </form>
                        <?php
                        if ($_POST) {
                            $keyword = $_POST["search"];

                            $sqlmain = "SELECT * from report INNER JOIN patient ON patient.pid = report.pid where pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' or report.pid='$keyword' or report.pid like '$keyword%' or report.pid like '%$keyword' or report.pid like '%$keyword%' or scheduleid='$keyword' or scheduleid like '$keyword%' or scheduleid like '%$keyword' or scheduleid like '%$keyword%'";
                        } else {
                            $sqlmain = "SELECT * from report INNER JOIN patient ON patient.pid = report.pid order by repid desc";
                        }
                        $result = $database->query($sqlmain);
                        ?>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');

                            $date = date('Y-m-d');
                            echo $date;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Patients (<?php echo $result->num_rows; ?>)</p>
                    </td>
                </tr>


                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">
                                                Patient ID
                                            </th>
                                            <th class="table-headin">
                                                Patient Name
                                            </th>
                                            <th class="table-headin">
                                                Schedule ID
                                            </th>
                                            <th class="table-headin">
                                                Appointment ID
                                            </th>
                                            <th class="table-headin">
                                                Events
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php



                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                        } else {
                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                $row = $result->fetch_assoc();
                                                $pid = $row["pid"];
                                                $name = $row["pname"];
                                                $scheduleid = $row["scheduleid"];
                                                $appoid = $row["appoid"];

                                                echo '<tr>
                                        <td style="text-align:center"> &nbsp;' .
                                                    substr('P-' . $pid, 0, 30)
                                                    . '</td>
                                        <td style="text-align:center">
                                        ' . substr($name, 0, 30) . '
                                        </td>
                                        <td style="text-align:center">
                                        ' . substr($scheduleid, 0, 30) . '
                                        </td>                                        
                                        <td style="text-align:center">
                                        ' . substr($appoid, 0, 30) . '
                                        </td>
                                        <td style="text-align:center">
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=view&id=' . $pid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                        </div>
                                        </td>
                                    </tr>';
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
    <?php
    if ($_GET) {

        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-doctor.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $pid = $_GET["id"];
            $sqlmain = "SELECT * from report WHERE presc_flag = 0 and pid = '$pid'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $prescription = $row["prescription"];

    ?>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="patient.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                            <table width="100%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                    <td>
                                        <div class="flex-row">
                                            <img src="<?php echo $prescription; ?>" alt="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="flex-row">
                                        <a href="patient.php?action=seen&pid=<?php echo $pid ?>"><input type="button" value="Seen" class="login-btn btn-primary-soft btn"></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </center><br><br>
                </div>
            </div>
    <?php
        } elseif ($action == 'seen') {
            $sqlmain = "SELECT * from report WHERE presc_flag = 0";
            $result = $database->query($sqlmain);
        }
    }
    ?>
    </div>
    <script>
        const toggleButton = document.querySelector('.dropdown-toggle');
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedLanguages);
        });

        function updateSelectedLanguages() {
            const selectedLanguages = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedLanguages.push(checkbox.value);
                }
            });
            toggleButton.textContent = selectedLanguages.length > 0 ? selectedLanguages.join(', ') : 'Select Languages';
        }

        function validateForm() {
            var checkboxes = document.querySelectorAll('input[name="language[]"]');
            var checked = false;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checked = true;
                }
            });

            if (!checked) {
                alert("Please select at least one language.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>