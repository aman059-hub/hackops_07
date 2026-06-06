<?php
include("../includes/auth_check.php");
include("../config/db.php");

$data=mysqli_query($conn,"SELECT * FROM vendors");
?>

<!DOCTYPE html>
<html>

<head>

<title>Vendor List</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Vendor Management</h2>

<a href="add_vendor.php"
class="btn btn-primary mb-3">
Add Vendor
</a>

<table id="mytable"
class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Code</th>
<th>Name</th>
<th>Category</th>
<th>Phone</th>
<th>Email</th>
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

<td><?php echo $row['vendor_id']; ?></td>

<td><?php echo $row['vendor_code']; ?></td>

<td><?php echo $row['vendor_name']; ?></td>

<td><?php echo $row['category']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a href="view_vendor.php?id=<?php echo $row['vendor_id']; ?>"
class="btn btn-info btn-sm">

View

</a>

<a href="edit_vendor.php?id=<?php echo $row['vendor_id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="delete_vendor.php?id=<?php echo $row['vendor_id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Vendor?')">

Delete

</a>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function(){
$('#mytable').DataTable();
});
</script>

</body>

</html>