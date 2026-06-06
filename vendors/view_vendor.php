<?php

include("../config/db.php");

$id=$_GET['id'];

$data=mysqli_query($conn,
"SELECT * FROM vendors
WHERE vendor_id='$id'");

$row=mysqli_fetch_assoc($data);

?>

<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header">

<h3>Vendor Details</h3>

</div>

<div class="card-body">

<p><b>Vendor Code :</b> <?php echo $row['vendor_code']; ?></p>

<p><b>Name :</b> <?php echo $row['vendor_name']; ?></p>

<p><b>Category :</b> <?php echo $row['category']; ?></p>

<p><b>GST :</b> <?php echo $row['gst_no']; ?></p>

<p><b>Phone :</b> <?php echo $row['phone']; ?></p>

<p><b>Email :</b> <?php echo $row['email']; ?></p>

<p><b>Address :</b> <?php echo $row['address']; ?></p>

<p><b>Status :</b> <?php echo $row['status']; ?></p>

</div>

</div>

</div>

</body>

</html>