<?php

session_start();

if(!isset($_SESSION['role']))
{
    header("location:../auth/login.php");
    exit();
}

function checkRole($allowedRoles)
{
    if(!in_array($_SESSION['role'], $allowedRoles))
    {
        die("
        <h2 style='color:red;text-align:center'>
        Access Denied
        </h2>
        ");
    }
}
?>