<?php
session_start();
include('../connection.php');

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'rm') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}

$sqlmain = "select * from review_machine where rmemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();

$docid = $userfetch["docid"];
$userid = $userfetch["rmid"];

$result =  $database->query("SELECT doctor.docname, patient.pname FROM doc_review INNER JOIN patient ON patient.pid = doc_review.pid INNER JOIN doctor ON doctor.docid = doc_review.docid WHERE doc_review.docid = '$docid' and seen_status = 0;");
if ($result) {
    $row = $result->fetch_assoc();
    $data = [
        "docname" => $row['docname'],
        "pname" => $row['pname'],
    ];
    echo json_encode($data);

    // Close the database connection
    $database->close();
} else {
    // Close the database connection
    $database->close();
    echo json_encode(['error' => 'Query failed']);
}
