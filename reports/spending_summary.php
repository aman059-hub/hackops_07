<?php

include("../config/db.php");

$data=mysqli_query($conn,

"SELECT SUM(grand_total)
as total_spend

FROM invoices");

$row=mysqli_fetch_assoc($data);

?>

<div class="alert alert-success">

Total Procurement Spending :

₹ <?php echo $row['total_spend']; ?>

</div>