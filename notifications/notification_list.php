<?php

include("../config/db.php");

$data=mysqli_query($conn,

"SELECT * FROM notifications

ORDER BY created_at DESC");
?>

<table class="table table-bordered">

<tr>

<th>Title</th>
<th>Message</th>
<th>Status</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($data))
{
?>

<tr>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['message']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php
}
?>

</table>