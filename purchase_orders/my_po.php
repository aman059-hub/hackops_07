
<?php

include("../includes/auth_check.php");
include("../config/db.php");

if($_SESSION['role']!="Vendor")
{
    die("Access Denied");
}

$vendor_id=$_SESSION['id'];

$data=mysqli_query($conn,

"SELECT
p.po_id,
p.po_number,
p.amount,
p.status,
p.created_at,
r.title,
q.price

FROM purchase_orders p

JOIN quotations q
ON p.quotation_id=q.quotation_id

JOIN rfq r
ON q.rfq_id=r.rfq_id

WHERE q.vendor_id='$vendor_id'

ORDER BY p.po_id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>My Purchase Orders</title>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
background:#f4f6f9;
}

.card{
border:none;
border-radius:20px;
box-shadow:0px 5px 20px rgba(0,0,0,.1);
}

.table th{
background:#212529;
color:white;
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="card p-4">

<div class="d-flex justify-content-between">

<h2>
<i class="fa fa-file-invoice"></i>
My Purchase Orders
</h2>

<a href="../dashboard/dashboard.php"
class="btn btn-secondary">

<i class="fa fa-arrow-left"></i>
Dashboard

</a>

</div>

<hr>

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>PO ID</th>
<th>PO Number</th>
<th>RFQ Title</th>
<th>Quotation Price</th>
<th>PO Amount</th>
<th>Status</th>
<th>Date</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($data)>0)
{
    while($row=mysqli_fetch_assoc($data))
    {
?>

<tr>

<td>
<?php echo $row['po_id']; ?>
</td>

<td>
<?php echo $row['po_number']; ?>
</td>

<td>
<?php echo $row['title']; ?>
</td>

<td>
₹ <?php echo $row['price']; ?>
</td>

<td>
₹ <?php echo $row['amount']; ?>
</td>

<td>

<?php

if($row['status']=="Completed")
{
    echo "<span class='badge bg-success'>
    Completed
    </span>";
}
else
{
    echo "<span class='badge bg-warning'>
    Pending
    </span>";
}

?>

</td>

<td>
<?php echo $row['created_at']; ?>
</td>

</tr>

<?php
    }
}
else
{
?>

<tr>

<td colspan="7"
class="text-center text-danger">

No Purchase Orders Found

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</body>

</html>

