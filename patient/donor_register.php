<?php
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
$sqlmain = "select * from patient where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);  // Bind the variable $useremail as a string parameter
$stmt->execute();
$result = $stmt->get_result();
$userfetch = $result->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];

if ($_SERVER["REQUEST_METHOD"] === "POST" || $_GET['donate_type']) {
    // Retrieve the values for each organ
    $donate_type = $_POST["donate_type"];
    if ($donate_type == null)
        $donate_type = $_GET['donate_type'];
    $heart = $_POST["heart"];
    $lungs = $_POST["lungs"];
    $kidneys = $_POST["kidneys"];
    $liver = $_POST["liver"];
    $corneas = $_POST["corneas"];
    $pancreas = $_POST["pancreas"];
    $tissue = $_POST["tissue"];
    $small_bowel = $_POST["small_bowel"];

    if ($donate_type == 1) {
        $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Heart')");
        $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Lungs')");
        $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Kidneys')");
        $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Liver')");
        $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Corneas')");
        $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Pancreas')");
        $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Tissue')");
        $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Small Bowel')");
        header('Location: settings.php?action=donate_reg__success');
    } else {
        if ($heart == 'Yes')
            $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Heart')");
        if ($lungs == 'Yes')
            $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Lungs')");
        if ($kidneys == 'Yes')
            $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Kidneys')");
        if ($liver == 'Yes')
            $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Liver')");
        if ($corneas == 'Yes')
            $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Corneas')");
        if ($pancreas == 'Yes')
            $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Pancreas')");
        if ($tissue == 'Yes')
            $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Tissue')");
        if ($small_bowel == 'Yes')
            $sql = $database->query("INSERT INTO organ_donation (pid, organ) VALUES ('$userid', 'Small Bowel')");
    }
    header('Location: settings.php?action=donate_reg__success');
} else {
    echo "Form not submitted.";
    header('Location: settings.php?action=donor_reg_canceled');
}
