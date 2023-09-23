<?php
session_start();
error_reporting(0);
if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}

include("../connection.php");
$userrow = $database->query("select * from doctor where docemail='$useremail'");
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["docid"];
$username = $userfetch["docname"];

$prescription_name = $_COOKIE['prescription_name'];
$pid = $_POST['pid'];
$scheduleid = $_POST['scheduleid'];
$appoid = $_POST['appoid'];
$uid = $_POST['uid'];
$nextappointchoice = $_POST['nextappointchoice'];
if ($nextappointchoice != NULL) {
    $nextappointment = $_POST['nextappointment'];
}
if ($nextappointchoice == 'Not needed') {
    $nextappointment = 0;
}
echo $pid . '<br>';
echo $scheduleid . '<br>';
echo $appoid . '<br>';
echo $uid . '<br>';
echo $nextappointchoice . '<br>';
echo $nextappointment . '<br>';
echo $prescription_name . '<br>';

$uploadDirectory = '../uploads/report/' . $pid . $appoid . $scheduleid; // Specify the directory where you want to store uploaded files
echo $uploadDirectory . 'upload <br>';
$uploadedFile = $_FILES['uploadedFile']['name'];
if ($uploadedFile) {
    $fileExtension = pathinfo($uploadedFile, PATHINFO_EXTENSION);

    // Generate a unique random name for the uploaded file
    $randomFileName = uniqid() . '.' . strtoupper($fileExtension);

    $uploadPath = $uploadDirectory . $randomFileName;
    print_r($_FILES);
    if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $uploadPath)) {
        echo "File uploaded successfully!";
    } else {
        echo "Error uploading file.";
    }
}
$sqll = "INSERT INTO report (pid, docid, scheduleid, appoid, `uid`, prescription, report, next_appointment) VALUES ('$pid', '$userid', '$scheduleid', '$appoid', '$uid', '$prescription_name', '$uploadPath', '$nextappointment')";
echo $sqll . "<br>";
$sql = "UPDATE appointment SET `status` = 1 WHERE appoid = '$appoid'";
echo $sql;
$result = $database->query($sqll);
$result = $database->query($sql);
header("location: appointment.php");
