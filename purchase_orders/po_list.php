
<?php

include("../includes/auth_check.php");
include("../config/db.php");

$data=mysqli_query($conn,

"SELECT p.*,
q.quotation_id,
v.vendor_name

FROM purchase_orders p

LEFT JOIN quotations q
ON p.quotation_id=q.quotation_id

LEFT JOIN vendors v
ON q.vendor_id=v.vendor_id

ORDER BY p.po_id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Purchase Orders</title>

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
overflow:hidden;
}

.card-header{
background:linear-gradient(
135deg,
#0d6efd,
#198754
);
color:white;
padding:20px;
}

.table th{
background:#212529;
color:white;
}

.table tbody tr:hover{
background:#f8fafc;
transition:.3s;
}

.btn{
border-radius:10px;
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="card">

<div class="card-header">

<div class="d-flex justify-content-between align-items-center">

<h2 class="mb-0">

<i class="fa fa-cart-shopping"></i>

Purchase Orders

</h2>

<div>

<a href="../dashboard/dashboard.php"
class="btn btn-dark">

<i class="fa fa-home"></i>

Dashboard

</a>

<a href="create_po.php"
class="btn btn-light">

<i class="fa fa-plus"></i>

Generate PO

</a>

</div>

</div>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>PO ID</th>
<th>PO Number</th>
<th>Vendor</th>
<th>Quotation ID</th>
<th>Amount</th>
<th>Status</th>
<th>Date</th>

</tr>

</thead>

<tbody>

<?php

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
<?php echo $row['vendor_name']; ?>
</td>

<td>
<?php echo $row['quotation_id']; ?>
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
echo "<span class='badge bg-warning text-dark'>
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
?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>

