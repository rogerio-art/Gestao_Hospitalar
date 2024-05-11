<?php 
          ob_start();
    if(!isset($_SESSION)) {
     session_start();
    }

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "academia_do_saber";
    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");
    $base_url ="http://localhost/academiadosaber/";  
?>