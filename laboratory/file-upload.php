<?php
session_start();
error_reporting(0);
if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'l') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}



//import database
include("../connection.php");
$userrow = $database->query("select * from laboratory where lemail='$useremail'");
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["lid"];
$username = $userfetch["lname"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = $_POST['pid'];
    $mtid = $_POST['mtid'];
    $tid = $_POST["tid"];
    $uploadDirectory = '../uploads/test-report/' . $pid . $mtid . $userid; // Specify the directory where you want to store uploaded files
    echo $uploadDirectory . '<br>';
    $uploadedFile = $_FILES['uploadedFile']['name'];
    $fileExtension = pathinfo($uploadedFile, PATHINFO_EXTENSION);
    $randomFileName = uniqid() . '.' . $fileExtension;
    $uploadPath = $uploadDirectory . $randomFileName;
    print_r($_FILES);
    if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $uploadPath)) {
        $sql = $database->query("INSERT INTO test_report (pid, lid, tid, mtid, file_name) VALUES ('$pid','$userid', '$tid', '$mtid', '$uploadPath')");
        $sql = $database->query("UPDATE test_booking SET `status` = 1 WHERE tid = '$tid'");
    } else {
        echo "Error uploading file.";
    }
    header("location: ./appointment.php");
}
