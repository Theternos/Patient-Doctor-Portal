<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Booking Success</title>

</head>
<style>
    .popup {
        animation: transitionIn-Y-bottom 0.5s;
        margin: 35vh 5vw 0 5vw;
        width: 90vw;
        padding-top: 7vh;
    }
</style>

<body>
    <?php
    include("./config.php");
    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'booking-added') {
            echo '
<div id="popup1" class="overlay">
    <div class="popup">
        <center>
            <br><br>
            <h2>' . $lang['booked-success-popup'] . '.</h2>
            <div class="content">
                ' . $lang["appointment-number"] . ' ' . $id . '.<br><br>

            </div>
            <div style="display: flex;justify-content: center;">
        <br><br><br><br>
            </div>
        </center>
    </div>
</div>
';
        }
    }
    ?>
</body>

<script>
    function closeWindow() {
        window.close();
    }
</script>

</html>