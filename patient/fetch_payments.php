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
    $prev_payment_id = NULL;
    while ($payment_row = $result->fetch_assoc()) {
        $paid_at = $payment_row['paid_at'];
        $title = $payment_row['title'];
        $sqlll = "SELECT price FROM medical_test WHERE tname = '$title'";
        $payment_id = $payment_row['payment_id'];
        $result12 = $database->query($sqlll);


        // Check if a row was found
        if ($result12->num_rows > 0) {
            // Fetch the price from the result
            $price_row = $result12->fetch_assoc();
            $price = $price_row['price'];
        } else {
            $sqlll = "SELECT schedule.mode FROM schedule INNER JOIN appointment on appointment.scheduleid = `schedule`.scheduleid INNER JOIN payment_history on payment_history.appoid = appointment.appoid WHERE payment_history.payment_id = '$payment_id' and payment_history.title = '$title' and appointment.pid = '$userid'";
            $result12 = $database->query($sqlll);
            $price_row = $result12->fetch_assoc();
            $mode = $price_row['mode'];
            if ($mode == 'Hospital Visit')
                $price = 100;
            else
                $price = 250;
        }
        $amount = $payment_row['amount'];
        $paid_at = $payment_row['paid_at'];
        $status = $payment_row['phstatus'];
        $discount = $payment_row['discount'];
        $total_paid = $payment_row['total_paid'];
?>
        <tr style="height:40px; text-align:center; font-size:14px;">
            <td><?php echo substr($paid_at, 0, 10); ?></td>
            <td><?php echo $title; ?></td>
            <td><?php if ($discount > 0) {
                    echo '₹' . $discount;
                } else {
                    echo '-';
                } ?>
            </td>
            <td><?php echo   '<strike>₹' . $price . '</strike> ₹' . $amount; ?></td>
            <td><?php
                echo '₹' . $total_paid;
                ?>
            </td>
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
<?php
        $prev_payment_id = $payment_id;
    }
} ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll(".row-clickable");
        rows.forEach(function(row) {
            row.addEventListener("click", function() {
                const paymentId = this.getAttribute("data-payment-id");
                const detailsRows = document.querySelectorAll('.hidden-details[data-payment-id="' + paymentId + '"]');
                detailsRows.forEach(function(detailsRow) {
                    detailsRow.classList.toggle("hidden-details");
                });
            });
        });
    });
</script>