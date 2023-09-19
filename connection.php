<?php

// $database = new mysqli("sql12.freesqldatabase.com", "sql12647197", "iyz1Fh63tI", "sql12647197");
$database = new mysqli("localhost", "root", "", "peas");

if ($database->connect_error) {
    die("Connection failed:  " . $database->connect_error);
}
