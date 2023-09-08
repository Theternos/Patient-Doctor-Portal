<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['lang']))
    $_SESSION['lang'] = "en";
else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
    if ($_GET['lang'] == "en")
        $_SESSION['lang'] = "en";
    else if ($_GET['lang'] == "tm")
        $_SESSION['lang'] = "tm";
    else if ($_GET['lang'] == "ml")
        $_SESSION['lang'] = "ml";
    else if ($_GET['lang'] == "ka")
        $_SESSION['lang'] = "ka";
    else if ($_GET['lang'] == "te")
        $_SESSION['lang'] = "te";
    else if ($_GET['lang'] == "hi")
        $_SESSION['lang'] = "hi";
}

if (file_exists("../languages/" . $_SESSION['lang'] . ".php")) {
    require_once("../languages/" . $_SESSION['lang'] . ".php");
} else {
    echo "Error: Language file not found.";
}
