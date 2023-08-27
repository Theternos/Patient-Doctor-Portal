<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}


if ($_POST) {
    //import database
    include("../connection.php");
    if ($_POST['shedulesubmit']) {
        $title = $_POST["title"];
        $docid = $_POST["doctorid"];
        $nop = $_POST["nop"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $mode = $_POST["mode"];
        $sql = "insert into schedule (docid,title,scheduledate,scheduletime,nop,mode) values ('$docid','$title','$date','$time','$nop','$mode');";
        echo $sql;
        $result = $database->query($sql);
    }
    header("location: schedule.php?action=session-added&title=$title");
}
