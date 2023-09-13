<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Doctor</title>
    <style>
        .popup {
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



    if ($_POST) {
        //print_r($_POST);
        $result = $database->query("select * from webuser");
        $name = $_POST['name'];
        $nic = $_POST['nic'];
        $spec = $_POST['spec'];
        $email = $_POST['email'];
        $tele = $_POST['Tele'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $qualification = $_POST['qualification'];


        if ($password == $cpassword) {
            $error = '3';
            $result = $database->query("select * from webuser where email='$email';");
            if ($result->num_rows == 1) {
                $error = '1';
            } else {

                $sql1 = "insert into doctor(docemail,docname,docpassword,docnic,doctel,qualification,specialties) values('$email','$name','$password','$nic','$tele','$qualification','$spec');";
                $sql2 = "insert into webuser values('$email','d')";
                $database->query($sql1);
                $database->query($sql2);
                // Get docid based on docemail
                $docid_sql = "SELECT docid FROM doctor WHERE docemail = ?";
                $docid_stmt = $database->prepare($docid_sql);
                $docid_stmt->bind_param('s', $email);
                $docid_stmt->execute();
                $docid_result = $docid_stmt->get_result();
                $docid_row = $docid_result->fetch_assoc();
                $docid_stmt->close();
                $docid = $docid_row['docid'];
                $rmemail = $docid . '@bitsathy.ac.in';
                $sql3 = "insert into review_machine (docid, rmemail, rmpassword) values('$docid','$rmemail', '$password')";
                $sql4 = "insert into webuser values('$rmemail','rm')";
                $database->query($sql3);
                $database->query($sql4);

                if (!empty($_POST['language'])) {
                    $selectedLanguages = $_POST['language'];

                    // Get docid based on docemail
                    $docid_sql = "SELECT docid FROM doctor WHERE docemail = ?";
                    $docid_stmt = $database->prepare($docid_sql);
                    $docid_stmt->bind_param('s', $email);
                    $docid_stmt->execute();
                    $docid_result = $docid_stmt->get_result();
                    $docid_row = $docid_result->fetch_assoc();
                    $docid_stmt->close();

                    if ($docid_row) {
                        $docid = $docid_row['docid'];
                        // Insert selected languages into the database

                        $insertQuery = "INSERT INTO doc_language (docid, `language`) VALUES (?, ?)";
                        $stmt = $database->prepare($insertQuery);

                        foreach ($selectedLanguages as $language) {
                            $stmt->bind_param('ss', $docid, $language);
                            $stmt->execute();
                        }

                        $stmt->close();
                    } else {
                        echo "Error: Invalid docemail";
                    }
                }


                //echo $sql1;
                //echo $sql2;
                $error = '4';
            }
        } else {
            $error = '2';
        }
    } else {
        //header('location: signup.php');
        $error = '3';
    }


    header("location: doctors.php?action=add&error=" . $error);
    ?>



</body>

</html>