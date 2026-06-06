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

WHERE q.workflow_status='Pending'

OR q.workflow_status='Under Review'");
?>

<!DOCTYPE html>
<html>


<head>

<title>Approval Workflow</title>

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

.badge{
font-size:14px;
padding:8px 12px;
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="card">

<div class="card-header">

<div class="d-flex justify-content-between align-items-center">

<h2 class="mb-0">

<i class="fa fa-check-circle"></i>

Approval Workflow

</h2>

<a href="../dashboard/dashboard.php"
class="btn btn-dark">

<i class="fa fa-home"></i>

Dashboard

</a>

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
<th>Status</th>
<th>Action</th>

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
₹ <?php echo number_format($row['price'],2); ?>
</td>

<td>

<?php

if($row['workflow_status']=="Pending")
{
echo "<span class='badge bg-warning text-dark'>
Pending
</span>";
}
else
{
echo "<span class='badge bg-info'>
Under Review
</span>";
}

?>

</td>

<td>

<a href="approve_reject.php?id=<?php echo $row['quotation_id']; ?>"
class="btn btn-primary btn-sm">

<i class="fa fa-eye"></i>

Review

</a>

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