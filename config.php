<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "facebook";

$page_name = 'Vũ Mạnh Cường';
$version = 'v.1.0';

$connection = mysqli_connect($host,$username,$password);

if (!$connection){
    die('Could not connect: ' . mysqli_error($connection));
}


mysqli_select_db($connection, $dbname) or die(mysqli_error($connection));

mysqli_query($connection, "SET NAMES utf8");
