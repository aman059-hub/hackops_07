
<?php

include("../includes/auth_check.php");
include("../config/db.php");

$data=mysqli_query($conn,

"SELECT r.*,
v.vendor_name

FROM rfq r

LEFT JOIN vendors v
ON r.vendor_id=v.vendor_id

ORDER BY r.rfq_id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>RFQ Management</title>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"
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
box-shadow:0 5px 20px rgba(0,0,0,.1);
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

<i class="fa fa-file-signature"></i>

RFQ Management

</h2>

<div>

<a href="../dashboard/dashboard.php"
class="btn btn-dark">

<i class="fa fa-home"></i>

Dashboard

</a>

<a href="create_rfq.php"
class="btn btn-light">

<i class="fa fa-plus"></i>

Create RFQ

</a>

</div>

</div>

</div>

<div class="card-body">

<table
id="rfqtable"
class="table table-bordered table-hover">

<thead>

<tr>

<th>ID</th>
<th>Title</th>
<th>Vendor</th>
<th>Quantity</th>
<th>Deadline</th>
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
<?php echo $row['rfq_id']; ?>
</td>

<td>
<?php echo $row['title']; ?>
</td>

<td>
<?php echo $row['vendor_name']; ?>
</td>

<td>
<?php echo $row['quantity']; ?>
</td>

<td>
<?php echo $row['deadline']; ?>
</td>

<td>

<?php

if($row['status']=="Open")
{
echo "<span class='badge bg-success'>Open</span>";
}
elseif($row['status']=="Approved")
{
echo "<span class='badge bg-primary'>Approved</span>";
}
else
{
echo "<span class='badge bg-danger'>Closed</span>";
}

?>

</td>

<td>

<a href="view_rfq.php?id=<?php echo $row['rfq_id']; ?>"
class="btn btn-info btn-sm">

<i class="fa fa-eye"></i>

</a>

<a href="edit_rfq.php?id=<?php echo $row['rfq_id']; ?>"
class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a href="delete_rfq.php?id=<?php echo $row['rfq_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete RFQ?')">

<i class="fa fa-trash"></i>

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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function()
{
    $('#rfqtable').DataTable();
});

</script>

</body>

</html>

