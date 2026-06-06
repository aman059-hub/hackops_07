<?php

include("../config/db.php");

$id=$_GET['id'];

mysqli_query($conn,
"DELETE FROM vendors
WHERE vendor_id='$id'");

header("location:vendor_list.php");

?>