
<?php

include("../includes/auth_check.php");
include("../config/db.php");

$data=mysqli_query($conn,

"SELECT
vendor_name,
rating,
status

FROM vendors

ORDER BY vendor_name ASC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Vendor Report</title>

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

<i class="fa fa-users"></i>

Vendor Report

</h2>

<div>

<a href="../dashboard/dashboard.php"
class="btn btn-dark">

<i class="fa fa-home"></i>

Dashboard

</a>

<button
onclick="window.print()"
class="btn btn-warning">

<i class="fa fa-print"></i>

Print

</button>

</div>

</div>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>Vendor Name</th>
<th>Rating</th>
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

<?php echo $row['vendor_name']; ?>

</td>

<td>

⭐ <?php echo $row['rating']; ?>

</td>

<td>

<?php

if($row['status']=="Active")
{
echo "<span class='badge bg-success'>
Active
</span>";
}
else
{
echo "<span class='badge bg-danger'>
Inactive
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
