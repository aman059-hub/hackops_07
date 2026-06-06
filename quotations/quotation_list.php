
<?php

include("../includes/auth_check.php");
include("../config/db.php");

$data=mysqli_query($conn,

"SELECT q.*,
v.vendor_name,
r.title

FROM quotations q

LEFT JOIN vendors v
ON q.vendor_id=v.vendor_id

LEFT JOIN rfq r
ON q.rfq_id=r.rfq_id

ORDER BY q.quotation_id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Quotation Management</title>

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
background:#f1f5f9;
transition:.3s;
}

.badge{
font-size:14px;
padding:8px 12px;
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

<i class="fa fa-handshake"></i>

Quotation Management

</h2>

<div>

<a href="../dashboard/dashboard.php"
class="btn btn-dark">

<i class="fa fa-home"></i>

Dashboard

</a>

<a href="submit_quote.php"
class="btn btn-primary">

<i class="fa fa-plus"></i>

Submit Quote

</a>

<a href="compare_quotes.php"
class="btn btn-success">

<i class="fa fa-scale-balanced"></i>

Compare Quotes

</a>

</div>

</div>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>ID</th>
<th>RFQ</th>
<th>Vendor</th>
<th>Price</th>
<th>Delivery</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($data))
{
?>

<tr>

<td>
<?php echo $row['quotation_id']; ?>
</td>

<td>
<?php echo $row['title']; ?>
</td>

<td>
<?php echo $row['vendor_name']; ?>
</td>

<td>
₹ <?php echo $row['price']; ?>
</td>

<td>
<?php echo $row['delivery_days']; ?>
 Days
</td>

<td>

<?php

if($row['status']=="Approved")
{
    echo "<span class='badge bg-success'>
    Approved
    </span>";
}
elseif($row['status']=="Rejected")
{
    echo "<span class='badge bg-danger'>
    Rejected
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

