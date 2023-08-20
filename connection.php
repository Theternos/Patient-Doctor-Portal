<?php


    $database= new mysqli("localhost","root","","peas");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }
