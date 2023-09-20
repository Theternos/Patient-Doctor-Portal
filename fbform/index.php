<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback Form</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <?php
  error_reporting(0);
  include("../connection.php");
  $drid = $_GET['drid'];
  $result = $database->query("SELECT drid FROM feedback WHERE drid = '$drid'");
  if ($result->num_rows > 0) { ?>
    <section class="content">
      <div class="feedback-description">
        <h1 class="title">
          Duplicate Entry Found!
        </h1>
        <br>
        <p class="subtitle">You have already submitted the Feedback.</p>
      </div>
    </section>
  <?php
  } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
    $drid = $_POST['drid'];
    $feedback = $_POST['feedback'];
    $result = $database->query("SELECT drid FROM feedback WHERE drid = '$drid'");
    if ($result->num_rows == 0) {
      $stmt = $database->prepare("INSERT INTO feedback (drid, pid, feedback) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $drid, $userid, $feedback);
      $stmt->execute();
    }
  ?>
    <section class="content">
      <div class="feedback-description">
        <h1 class="title">
          Feedback Submited!
        </h1>
        <br>
        <p class="subtitle">Thankyou for your response.</p>
      </div>
    </section>
  <?php } elseif ($_GET['id']) {
    $id = $_GET['id'];
    $drid = $_GET['drid'];
    $result = $database->query("SELECT pemail, pname from patient WHERE pid = '$id'");
    $userfetch = $result->fetch_assoc();
    $pemail = $userfetch['pemail'];
    $pname = $userfetch['pname'];
  ?>
    <section class="content">
      <div class="feedback-description">
        <h1 class="title">
          Have a feedback?
        </h1>
        <p class="subtitle">
          Share your feedback, and we'll be at your service. </p>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="feedback-form">
        <input type="hidden" name="userid" value="<?php echo $id ?>">
        <input type="hidden" name="drid" value="<?php echo $drid ?>">
        <input class="feedback-form__email" value="<?php echo $pemail ?>" placeholder="Email" disabled />
        <input class="feedback-form__email" value="<?php echo $pname ?>" placeholder="Name" disabled />
        <textarea name="feedback" class="feedback-form__message" cols="30" name="text" placeholder="Message" required="" rows="5"></textarea>
        <button name="feedback-submit" class="feedback-form__submit">Sumbit</button>
      </form>
    </section>
  <?php } else { ?>
    <section class="content">
      <div class="feedback-description">
        <h1 class="title">
          You are Authorized!
        </h1>
        <br>
        <p class="subtitle">
          You are not using the proper link given. Kindly use only given links. </p>
      </div>
    </section>
  <?php } ?>
</body>

</html>