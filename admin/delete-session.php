<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}


if ($_GET) {
    include("../connection.php");
    $id = $_GET["id"];

    if ($_GET['status'] == 'reject') {
        $sql = $database->query("UPDATE schedule SET leave_status = 0");
    } elseif ($_GET['status'] == 'accept' or $_GET['status'] == null) {
        $sql = $database->query("delete from schedule where scheduleid='$id';");
    }
    if ($_GET['status'] == 'reject' || $_GET['status'] == 'accept') {
        header("location: index.php");
    } else {
        header("location: schedule.php");
    }
}
