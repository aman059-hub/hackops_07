<?php

include("../config/db.php");

$id=$_GET['id'];

$data=mysqli_query($conn,

"SELECT r.*,
v.vendor_name

FROM rfq r

LEFT JOIN vendors v
ON r.vendor_id=v.vendor_id

WHERE rfq_id='$id'");

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
RFQ Details
</div>

<div class="card-body">

<p><b>RFQ ID :</b>
<?php echo $row['rfq_id']; ?>
</p>

<p><b>Title :</b>
<?php echo $row['title']; ?>
</p>

<p><b>Description :</b>
<?php echo $row['description']; ?>
</p>

<p><b>Quantity :</b>
<?php echo $row['quantity']; ?>
</p>

<p><b>Vendor :</b>
<?php echo $row['vendor_name']; ?>
</p>

<p><b>Deadline :</b>
<?php echo $row['deadline']; ?>
</p>

<p><b>Status :</b>
<?php echo $row['status']; ?>
</p>

</div>

</div>

</div>

</body>

</html>