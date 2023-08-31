<?php



//import database
include("../connection.php");



if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from webuser");
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $oldemail = $_POST["oldemail"];
    $spec = $_POST['spec'];
    $email = $_POST['email'];
    $tele = $_POST['Tele'];
    $qualification = $_POST['qualification'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $id = $_POST['id00'];

    if ($password == $cpassword) {
        $error = '3';
        $result = $database->query("select laboratory.lid from laboratory inner join webuser on laboratory.lemail=webuser.email where webuser.email='$email';");
        //$resultqq= $database->query("select * from doctor where docid='$id';");
        if ($result->num_rows == 1) {
            $id2 = $result->fetch_assoc()["lid"];
        } else {
            $id2 = $id;
        }

        echo $id2 . "jdfjdfdh";
        if ($id2 != $id) {
            $error = '1';
            //$resultqq1= $database->query("select * from doctor where docemail='$email';");
            //$did= $resultqq1->fetch_assoc()["docid"];
            //if($resultqq1->num_rows==1){

        } else {

            $sql1 = "update laboratory set lemail='$email',lname='$name',lpassword='$password',llicence='$nic',ltel='$tele',mtid='$spec',lqualification='$qualification' where lid=$id;";
            $database->query($sql1);

            $sql1 = "update webuser set email='$email' where email='$oldemail' ;";
            $database->query($sql1);
            //echo $sql1;
            //echo $sql2;
            $error = '4';
        }
    } else {
        $error = '2';
    }
} else {
    //header('location: signup.php');
    $error = '3';
}


header("location: laboratory.php?action=edit&error=" . $error . "&id=" . $id);
?>



</body>

</html>