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
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];

echo "hi";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selected_tests"])) {
    $selectedTests = $_POST["selected_tests"];
    foreach ($selectedTests as $testID) {
        echo $testID . '<br>';
        $result = $database->query("SELECT tid, payment_id, price from test_booking INNER JOIN medical_test ON medical_test.mtid = test_booking.mtid WHERE test_booking.mtid = '$testID' and pid = '$userid' and `status` = 0");
        $inforow = $result->fetch_assoc();
        $payment_id =  $inforow['payment_id'];
        $rps = $inforow['price'];
        $tid = $inforow['tid'];
        echo $tid . '<br>';
        echo $rps . '<br>';
        // $result = $database->query("INSERT INTO refund (pid, tid, rps, payment_id) VALUES ('$userid','$tid', '$rps', '$payment_id')");
        $result = $database->query("SELECT amount, discount from payment_history WHERE payment_id = '$payment_id' and tid = '$tid'");
        $inforow = $result->fetch_assoc();
        $amount = $inforow['amount'];
        $discount = $inforow['discount'];
        $amount_paid = $discount + $amount;
        echo $amount_paid . '<br>';
        $refund_amt = $amount_paid - $rps;
        if ($refund_amt < 0) {
            $refund_amt = $amount_paid;
        }
        $refund_amt = $amount_paid - $refund_amt;
        echo $refund_amt;
        $result = $database->query("UPDATE wallet SET balance = balance + '$refund_amt' WHERE pid = '$userid'");
        $result = $database->query("UPDATE payment_history SET phstatus = 3 WHERE payment_id = '$payment_id' and tid = '$tid'");
        $result = $database->query("DELETE from test_booking WHERE mtid = '$testID' and pid = '$userid' and `status` = 0");
        header("location: ./appointment.php?action=removed-test");
    }
} else {
    echo "No tests selected for cancellation.";
}
