<?php

include("../config/db.php");

$data=mysqli_query($conn,

"SELECT l.*,
u.fullname

FROM activity_logs l

LEFT JOIN users u
ON l.user_id=u.id

ORDER BY l.created_at DESC");

?>

<table class="table table-bordered">

<tr>

<th>User</th>
<th>Action</th>
<th>Date</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($data))
{
?>

<tr>

<td><?php echo $row['fullname']; ?></td>

<td><?php echo $row['action']; ?></td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php
}
?>

</table>