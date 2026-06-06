<?php

include("../config/db.php");

$id=$_GET['id'];

mysqli_query($conn,

"DELETE FROM rfq

WHERE rfq_id='$id'");

header("location:rfq_list.php");