<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel='stylesheet' href='../css/materialize.css'>
    <title>View Documents</title>
</head>
<?php
if ($_GET) {
    $pid = $_GET['pid'];
    include("../connection.php");
    $sqlmain = "select * from patient where pid=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("i", $pid);  // Bind the variable $useremail as a string parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];
}
?>
<style>
    /* fallback */
    @font-face {
        font-family: 'Material Icons';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/materialicons/v140/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
    }

    .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-smoothing: antialiased;
    }

    body {
        background-color: #f0f0f0;
        font-size: 13px;
    }

    .card,
    .card-panel {
        padding: 15px 20px;
        box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
    }

    .container-fluid {
        padding: 1rem 2.5rem;
        margin: auto;
    }

    .row {
        margin: 0 -0.75rem;
    }

    .main {
        position: absolute;
        width: calc(100% - 250px);
        top: 125px;
        margin-left: 250px;
    }

    .subheader {
        color: rgba(0, 0, 0, 0.54);
        font-weight: 500;
    }

    /* nav */
    nav {
        box-shadow: 0 1px 8px rgba(0, 0, 0, 0.3);
    }

    nav ul li {
        text-align: center;
    }

    nav ul.right {
        padding-right: 12px;
    }

    nav ul.right li {
        max-width: 48px;
    }

    nav ul a {
        padding: 0 12px;
    }

    nav ul a img {
        height: 32px;
        width: 32px;
        vertical-align: middle;
        margin-left: -5px;
    }

    .nav-wrapper {
        padding-left: 12px;
    }

    .nav-wrapper ul a:hover {
        background-color: transparent;
    }

    .nav-wrapper .title {
        font-size: 1.4rem;
    }

    .nav-wrapper .btn-flat {
        background-color: #4285f4 !important;
        font-size: 13px;
        font-weight: 500;
        height: 30px;
        line-height: 30px;
        width: 94px;
    }

    .nav-2,
    .nav-2 i {
        height: 56px !important;
        line-height: 56px !important;
        min-height: 56px !important;
    }

    .search-wrapper {
        margin: 10px auto 0 210px;
        width: calc(100% - 450px);
        max-width: 650px;
        height: 46px;
        position: fixed;
    }

    .search-wrapper i {
        color: #757575;
        position: absolute;
        font-size: 24px;
        top: 5px;
        left: 24px;
        line-height: 38px !important;
    }

    input[type=search]:not(.browser-default) {
        display: block;
        padding: 11px 8px 11px 72px;
        width: 100%;
        background: #f5f5f5;
        height: 24px;
        border: none;
        font-size: 16px;
        outline: none;
        border-radius: 2px;
        color: #757575;
    }

    input[type=search]:focus {
        border-bottom: none !important;
        box-shadow: none !important;
    }

    input[type=search]::placeholder {
        color: #757575;
    }

    /* sidenav */
    .side-nav.floating {
        width: 250px;
        padding: 12px 8px 0 !important;
        height: calc(100% - 130px);
        left: initial;
        right: initial;
        top: 125px;
        transform: initial;
        z-index: auto;
        margin: 0.5rem 0 1rem 0;
        border-radius: 2px;
        background: transparent;
        box-shadow: none;
    }

    .side-nav .divider {
        margin: 8px 0;
    }

    .side-nav .active {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .side-nav .active a {
        color: #212121;
        font-weight: 500;
    }

    .side-nav .subheader {
        line-height: 24px;
        height: 32px;
        margin: 0;
        padding: 4px 16px;
        color: #616161;
        font-weight: normal;
        font-size: 13px;
    }

    .side-nav li>a,
    .side-nav li>a>i.material-icons {
        height: 40px;
        line-height: 40px;
    }

    .side-nav li>a>i.material-icons {
        margin-right: 24px;
    }

    .side-nav li>a {
        padding: 0 16px;
        font-weight: normal;
        font-size: 13px;
        color: #616161;
    }

    .side-nav li>a:hover {
        border-radius: 2px;
    }

    /* folders */
    .folder {
        width: 185px;
        display: inline-block;
        margin: 15px 20px 15px 0;
        font-weight: 500;
    }

    .folder i {
        color: rgba(0, 0, 0, 0.54);
        margin-top: -3px;
    }

    button {
        border: 0px solid #ccc;
    }

    /* Add custom styles here */

    /* Background and text color palette */
    body {
        background-color: #f5f5f5;
        /* Light gray background */
        font-size: 16px;
        color: #333;
        /* Dark text color */
    }

    .navbar-fixed nav {
        background-color: #ffffff;
        /* White navbar background */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-fixed .search-wrapper input[type="search"] {
        background-color: #f0f0f0;
        /* Light gray search input background */
        color: #555;
        /* Gray text color for search input */
    }

    /* Folder cards */
    .card-panel.folder {
        background-color: #ffffff;
        /* White card background */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
        cursor: pointer;
    }

    .card-panel.folder:hover {
        transform: scale(1.05);
        /* Slightly grow on hover */
    }

    .subheader {
        color: #666;
        /* Gray subheader text color */
        font-weight: 500;
    }

    /* Icon colors */
    .material-icons {
        color: #4285f4;
        /* Google blue for icons */
    }


    /* Add animations to folder icons */
    .card-panel.folder i.material-icons {
        transition: transform 0.2s ease-in-out;
    }

    .card-panel.folder:hover i.material-icons {
        transform: rotate(360deg);
    }

    /* Custom styles for a sleek and colorful UI */

    /* Background and text color palette */
    body {
        background-color: #f8f8f8;
        /* Light gray background */
        font-size: 16px;
        color: #333;
        /* Dark text color */
    }

    .navbar-fixed nav {
        background-color: #2196F3;
        /* Material blue for navbar background */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-fixed .search-wrapper input[type="search"] {
        background-color: #ffffff;
        /* White search input background */
        color: #333;
        /* Dark text color for search input */
    }

    /* Folder cards */
    .card-panel.folder {
        background-color: #ffffff;
        /* White card background */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
        cursor: pointer;
    }

    .card-panel.folder:hover {
        transform: translateY(-5px);
        /* Slight vertical lift on hover */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        /* Enhanced shadow on hover */
    }

    .subheader {
        color: #666;
        /* Gray subheader text color */
        font-weight: 500;
    }

    /* Icon colors */
    .material-icons {
        color: #FF5722;
        /* Deep orange for icons */
    }

    /* Button styles */
    button {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    /* Add animations to folder icons */
    .card-panel.folder i.material-icons {
        transition: transform 0.2s ease-in-out;
    }

    .card-panel.folder:hover i.material-icons {
        transform: rotate(20deg);
    }
</style>

<body>
    <!-- partial:index.partial.html -->
    <div class="navbar-fixed">
        <nav class="nav-extended white">
            <div class="nav-wrapper white">
                <ul>
                    <li><a href="#!" class="title grey-text text-darken-1">Document Vault</a></li>
                </ul>
                <div class="search-wrapper">
                    <i class="material-icons">search</i>
                    <input type="search" name="Search" placeholder="Search your Documents here" />
                </div>
                <ul class="right">
                    <li><a href="#!"><i class="material-icons grey-text text-darken-1">apps</i></a></li>
                    <li><a href="#!"><i class="material-icons grey-text text-darken-1">notifications</i></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="main">
        <div class="container-fluid">
            <?php
            $result = $database->query("SELECT * FROM report");
            if ($result->num_rows) { ?>
                <!-- <p class="subheader">Report</p> -->
                <?php for ($x = 0; $x < ($result->num_rows); $x++) {
                    $row = $result->fetch_assoc();
                    $report = $row['report']; ?>
                    <!-- <div class="card-panel folder"><i class="material-icons left">folder</i> Report</div> -->
                <?php    }
            }
            $result = $database->query("SELECT * FROM test_report");
            if ($result->num_rows) { ?>
                <p class="subheader">Test Report</p>
                <?php for ($x = 0; $x < ($result->num_rows); $x++) {
                    $row = $result->fetch_assoc();
                    $file_name =  $row['file_name']; ?>
                    <form action="file-view-only.php" method='POST'>
                        <input type="hidden" name="file_name" value="<?php echo $file_name; ?>">
                        <button name="file_name_btn" class="card-panel folder"><i class="material-icons left">folder</i> Test Report</button>
                    </form>
                <?php    }
            }
            $result = $database->query("SELECT * FROM report");
            if ($result->num_rows) { ?>
                <p class="subheader">Prescriptions</p>
                <?php
                for ($x = 0; $x < ($result->num_rows); $x++) {
                    $row = $result->fetch_assoc();
                    $prescription = $row['prescription']; ?>
                    <form action="file-view-only.php" method='POST'>
                        <input type="hidden" name="prescription" value="<?php echo $prescription; ?>">
                        <button name="prescription_btn" class="card-panel folder"><i class="material-icons left">folder</i> Prescription</button>
                    </form>
            <?php   }
            } ?>
        </div>
    </div>
    <!-- partial -->
</body>

</html>