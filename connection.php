<?php

# Change the below details according to your Backend Needs
$host = '';
$user = '';
$password = '';
$database_name = '';


$database = new mysqli($host, $user, $password, $database_name);

if ($database->connect_error) {
    die("Connection failed:  " . $database->connect_error);
}
