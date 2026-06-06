<?php

$host="localhost";
$user="root";
$pass="";
$db="vendorbridge";

$conn=mysqli_connect($host,$user,$pass,$db);

if(!$conn)
{
    die("Connection Failed");
}
?>