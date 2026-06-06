
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
q.*,
r.title

FROM quotations q

LEFT JOIN rfq r
ON q.rfq_id=r.rfq_id

WHERE q.vendor_id='$vendor_id'

ORDER BY q.quotation_id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>My Quotations</title>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
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

<i class="fa fa-file-contract"></i>

My Quotations

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

<th>ID</th>
<th>RFQ</th>
<th>Price</th>
<th>Delivery Days</th>
<th>Status</th>
<th>Workflow Status</th>
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
<?php echo $row['quotation_id']; ?>
</td>

<td>
<?php echo $row['title']; ?>
</td>

<td>
₹ <?php echo $row['price']; ?>
</td>

<td>
<?php echo $row['delivery_days']; ?>
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
    echo "<span class='badge bg-warning'>
    Pending
    </span>";
}

?>

</td>

<td>

<?php

if($row['workflow_status']=="Approved")
{
    echo "<span class='badge bg-success'>
    Approved
    </span>";
}
elseif($row['workflow_status']=="Rejected")
{
    echo "<span class='badge bg-danger'>
    Rejected
    </span>";
}
elseif($row['workflow_status']=="Under Review")
{
    echo "<span class='badge bg-info'>
    Under Review
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
<?php echo $row['quotation_date']; ?>
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

No Quotations Found

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
