<?php

include("../config/db.php");

$id=$_GET['id'];

$data=mysqli_query($conn,

"SELECT * FROM invoices
WHERE invoice_id='$id'");

$row=mysqli_fetch_assoc($data);

?>

<html>

<head>

<script>
window.print();
</script>

</head>

<body>

<h2>VendorBridge Invoice</h2>

<hr>

Invoice Number :
<?php echo $row['invoice_number']; ?>

<br><br>

Amount :
₹<?php echo $row['total_amount']; ?>

<br><br>

GST :
₹<?php echo $row['tax']; ?>

<br><br>

Grand Total :
₹<?php echo $row['grand_total']; ?>

</body>

</html>