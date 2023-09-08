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

    <title>Doctors</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .text-input {
            height: 35px;
            margin-bottom: 1vh;
            border: 0;
            cursor: pointer;
            letter-spacing: 1px;
            font-style: italic;
            font-weight: 400;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com
    include("./config.php");
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
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];

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
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor menu-active menu-icon-doctor-active">
                        <a href="doctors.php" class="non-style-link-menu non-style-link-menu-active">
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
                                <font class="tn-in-text"><?php echo $lang['ddback'] ?></font>
                            </button></a>
                    </td>
                    <td>
                        <form action="" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="<?php echo $lang['drcsearch'] ?>" list="doctors">&nbsp;&nbsp;
                            <?php
                            echo '<datalist id="doctors">';
                            $list11 = $database->query("select  docname,docemail from  doctor;");

                            for ($y = 0; $y < $list11->num_rows; $y++) {
                                $row00 = $list11->fetch_assoc();
                                $d = $row00["docname"];
                                $c = $row00["docemail"];
                                echo "<option value='$d'><br/>";
                                echo "<option value='$c'><br/>";
                            };

                            echo ' </datalist>';
                            ?>
                            <input type="Submit" value="<?php echo $lang['dsearch'] ?>" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                        </form>

                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            <?php echo $lang['tddate'] ?>
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');

                            $date = date('Y-m-d');
                            echo $date;
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
                                    <option value="en">en</option>
                                    <option value="tm">tm</option>
                                    <option value="ka">ka</option>
                                    <option value="ml">ml</option>
                                    <option value="te">te</option>
                                    <option value="hi">hi</option>
                                </select><br>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $lang['alldoctors'] ?> (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                </tr>
                <?php
                if ($_POST) {
                    $keyword = $_POST["search"];

                    $sqlmain = "select * from doctor where docemail='$keyword' or docname='$keyword' or docname like '$keyword%' or docname like '%$keyword' or docname like '%$keyword%'";
                } else {
                    $sqlmain = "select * from doctor order by docid desc";
                }
                ?>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">
                                                <?php echo $lang['drname'] ?>
                                            </th>
                                            <th class="table-headin">
                                                <?php echo $lang['dremail'] ?>
                                            </th>
                                            <th class="table-headin">
                                                <?php echo $lang['drspecialties'] ?>
                                            </th>
                                            <th class="table-headin">
                                                <?php echo $lang['drevents'] ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php


                                        $result = $database->query($sqlmain);

                                        if ($result->num_rows == 0) {
                                            echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">' . $lang['search'] . '</p>
                                    <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                        } else {
                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                $row = $result->fetch_assoc();
                                                $docid = $row["docid"];
                                                $name = $row["docname"];
                                                $email = $row["docemail"];
                                                $spe = $row["specialties"];
                                                $spcil_res = $database->query("select sname from specialties where id='$spe'");
                                                $spcil_array = $spcil_res->fetch_assoc();
                                                $spcil_name = $spcil_array["sname"];
                                                echo '<tr>
                                                        <td> &nbsp;' . substr($name, 0, 30) . '</td>
                                                        <td>' . substr($email, 0, 40) . '</td>
                                                        <td>' . substr($spcil_name, 0, 40) . '</td>
                                                        <td>
                                                            <div style="display:flex;justify-content: center;">
                                                                <a href="?action=view&id=' . $docid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">' . $lang['view'] . '</font></button></a>
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
                        ' . $lang['deleterecord'] . '<br>(' . substr($nameget, 0, 40) . ').
                            
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
            $sqlmain = "SELECT * FROM doctor WHERE docid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $name = $row["docname"];
            $email = $row["docemail"];
            $spe = $row["specialties"];
            $qualification = $row["qualification"];

            $stmt = $database->prepare("select sname from specialties where id=?");
            $stmt->bind_param("s", $spe);
            $stmt->execute();
            $spcil_res = $stmt->get_result();
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["sname"];
            $nic = $row['docnic'];
            $tele = $row['doctel'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details of Dr. ' . $name . '.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="td-label" colspan="2">
                                    <label for="email" class="form-label">' . $lang['dremail'] . '</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td text-input" colspan="2">
                                    ' . $email . '<br><br>
                                </td>
                            </tr>
                                <td class="td-label" colspan="2">
                                <label for="licence" class="form-label">' . $lang['drlicence'] . '</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td text-input" colspan="2">
                                    ' . $nic . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-label" colspan="2">
                                <label for="qualification" class="form-label">' . $lang['drqualification'] . '</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td text-input" colspan="2">
                                ' . $qualification . '<br><br>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td class="td-label" colspan="2">
                                <label for="Tele" class="form-label">' . $lang['drtele'] . '</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
                                </td>
                            </tr> -->
                            <tr>
                                <td class="td-label" colspan="2">
                                <label for="spec" class="form-label">' . $lang['drspecialties'] . ' </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td text-input" colspan="2">
                            ' . $spcil_name . '<br><br>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        } elseif ($action == 'session') {
            $name = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Redirect to Doctors sessions?</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                        ' . $lang['drviewall'] . ' <br>(' . substr($name, 0, 40) . ').
                            
                        </div>
                        <form action="schedule.php" method="post" style="display: flex">

                                <input type="hidden" name="search" value="' . $name . '">

                                
                        <div style="display: flex;justify-content:center;margin-left:45%;margin-top:6%;;margin-bottom:6%;">
                        
                        <input type="submit"  value="Yes" class="btn-primary btn"   >
                        
                        
                        </div>
                    </center>
            </div>
            </div>
            ';
        }
    } elseif ($action == 'edit') {
        $sqlmain = "select * from doctor where docid=?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $name = $row["docname"];
        $email = $row["docemail"];
        $spe = $row["specialties"];

        $sqlmain = "select sname from specialties where id='?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s", $spe);
        $stmt->execute();
        $result = $stmt->get_result();

        $spcil_array = $spcil_res->fetch_assoc();
        $spcil_name = $spcil_array["sname"];
        $nic = $row['docnic'];
        $tele = $row['doctel'];

        $error_1 = $_GET["error"];
        $errorlist = array(
            '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
            '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
            '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
            '4' => "",
            '0' => '',

        );

        if ($error_1 != '4') {
            echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="doctors.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                         
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">' .
                $errorlist[$error_1]
                . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">' . $lang['dredit'] . '</p>
                                        Doctor ID : ' . $id . ' (Auto Generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-doc.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="' . $id . '" name="id00">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="email" name="email" class="input-text" placeholder="' . $lang['dremailad'] . '" value="' . $email . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name:' . $lang['drname'] . '
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="' . $lang['drspdenmae'] . ' value="' . $name . '" required><br>
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="nic" class="form-label">NIC: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="nic" class="input-text" placeholder="' . $lang['drnicno'] . '" value="' . $nic . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">' . $lang['drtele'] . ' </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="' . $lang['drdisptele'] . '" value="' . $tele . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">' . $lang['drchspec'] . ' (Current' . $spcil_name . ')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="spec" id="" class="box">';


            $list11 = $database->query("select  * from  specialties;");

            for ($y = 0; $y < $list11->num_rows; $y++) {
                $row00 = $list11->fetch_assoc();
                $sn = $row00["sname"];
                $id00 = $row00["id"];
                echo "<option value=" . $id00 . ">$sn</option><br/>";
            };




            echo     '       </select><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">' . $lang['drpass'] . '</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="' . $lang['drippass'] . '" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">' . $lang['drcnpass'] . ' </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="' . $lang['drcnpass'] . '" required><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
        } else {
            echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>' . $lang['dreditsuc'] . '</h2>
                            <a class="close" href="doctors.php">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';
        };
    };

    ?>
    </div>

</body>
<script>
    // Get a reference to the language dropdown
    const languageDropdown = document.getElementById("language");

    // Add an event listener to the dropdown
    languageDropdown.addEventListener("change", function() {
        // Get the selected language code
        const selectedLanguage = this.value;

        // Get the current URL
        const currentURL = "./doctors.php"

        // Check if there's already a query string in the URL
        const separator = currentURL.includes("?") ? "&" : "?";

        // Construct the new URL with the selected language
        const newURL = currentURL + separator + "lang=" + selectedLanguage;

        // Redirect to the new URL
        window.location.href = newURL;
    });
</script>

</html>