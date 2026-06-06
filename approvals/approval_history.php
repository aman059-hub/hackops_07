<?php

include("../config/db.php");

$data=mysqli_query($conn,

"SELECT a.*,
u.fullname

FROM approvals a

LEFT JOIN users u
ON a.approved_by=u.id

ORDER BY a.approval_date DESC");


?>

<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Approval Timeline</h2>

<table class="table table-bordered">

<tr>

<th>ID</th>
<th>Approver</th>
<th>Status</th>
<th>Remarks</th>
<th>Date</th>

</tr>

<?php
while($row=mysqli_fetch_assoc($data))
{
?>

<tr>

<td><?php echo $row['quotation_id']; ?></td>

<td><?php echo $row['fullname']; ?></td>

<td>

<?php
if($row['status']=="Approved")
{
echo "<span class='badge bg-success'>Approved</span>";
}
else
{
echo "<span class='badge bg-danger'>Rejected</span>";
}
?>

</td>

<td><?php echo $row['remarks']; ?></td>

<td><?php echo $row['approval_date']; ?></td>

</tr>

<?php
}
?>

</table>

</div>

</body>

</html>