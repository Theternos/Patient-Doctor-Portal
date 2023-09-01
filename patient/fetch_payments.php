<?php
session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}

// Import database
include("../connection.php");

$sqlmain = "select * from patient where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();

$userid = $userfetch["pid"];
$username = $userfetch["pname"];

$page = isset($_GET['page']) ? $_GET['page'] : 0;
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 10;   # : 10
$offset = $page * $pageSize;

// Use prepared statement for the query
$query = "SELECT * FROM payment_history WHERE pid = ? ORDER BY phid DESC LIMIT ?, ?";
$stmt = $database->prepare($query);
$stmt->bind_param("iii", $userid, $offset, $pageSize);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    echo '<tr>
<td colspan="4">
<br><br><br><br>
<center>
<img src="../img/notfound.svg" width="25%">

<br>
<p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">No payment history found !</p>
</center>
<br><br><br><br>
</td>
</tr>';
} else {
    while ($payment_row = $result->fetch_assoc()) {
        $paid_at = $payment_row['paid_at'];
        $title = $payment_row['title'];
        $amount = $payment_row['amount'];
        $paid_at = $payment_row['paid_at'];
        $status = $payment_row['phstatus'];
        $discount = $payment_row['discount'];

?>
        <tr style="height:40px; text-align:center;">
            <td><?php echo substr($paid_at, 0, 10); ?></td>
            <td><?php echo $title; ?></td>
            <td><?php if ($discount > 0) {
                    echo '₹' . $discount;
                } else {
                    echo '-';
                } ?>
            </td>
            <td><?php echo '₹' . $amount; ?></td>
            <?php if ($status == 1) { ?> <!--Payment Done to Hospital -->
                <td>
                    <p class=" btn" style="width: 13vw; margin: auto; background-color: #1b998a20; color:#13af9d; font-weight:500">Paid</p>
                </td>
            <?php } elseif ($status == 2) { ?> <!-- Refund intiated -->
                <td>
                    <p class="btn" style="width: 13vw; margin: auto; background-color: #ece2d040; color:#f8cf82; font-weight:500">Refund Initiated</p>
                </td>
            <?php } elseif ($status == 3) { ?> <!-- Refund Completed -->
                <td>
                    <p class="btn" style="width: 13vw; margin: auto; background-color: #e7908e30; color:#ec7a78; font-weight:500">Refunded</p>
                </td>
            <?php } ?>
        </tr>
<?php }
} ?>