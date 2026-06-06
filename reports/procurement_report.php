
<?php

include("../includes/auth_check.php");
include("../config/db.php");

$vendors=mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM vendors")
);

$rfqs=mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM rfq")
);

$quotations=mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM quotations")
);

$purchase_orders=mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM purchase_orders")
);

$invoices=mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM invoices")
);

$amount=mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT SUM(amount) total
FROM purchase_orders")

);

$total_amount=$amount['total'] ?? 0;

?>

<!DOCTYPE html>
<html>

<head>

<title>Procurement Report</title>

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
box-shadow:0 5px 20px rgba(0,0,0,.1);
}

.header{
background:linear-gradient(
135deg,
#0d6efd,
#198754
);
color:white;
padding:20px;
border-radius:20px 20px 0 0;
}

.report-box{
padding:20px;
font-size:18px;
font-weight:600;
border-bottom:1px solid #eee;
}

.value{
float:right;
color:#0d6efd;
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="card">

<div class="header">

<div class="d-flex justify-content-between">

<h2>

<i class="fa fa-chart-column"></i>

Procurement Report

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

<div class="report-box">

Total Vendors

<span class="value">

<?php echo $vendors; ?>

</span>

</div>

<div class="report-box">

Total RFQs

<span class="value">

<?php echo $rfqs; ?>

</span>

</div>

<div class="report-box">

Total Quotations

<span class="value">

<?php echo $quotations; ?>

</span>

</div>

<div class="report-box">

Total Purchase Orders

<span class="value">

<?php echo $purchase_orders; ?>

</span>

</div>

<div class="report-box">

Total Invoices

<span class="value">

<?php echo $invoices; ?>

</span>

</div>

<div class="report-box">

Total Procurement Amount

<span class="value">

₹ <?php echo number_format($total_amount,2); ?>

</span>

</div>

<div class="p-4 text-center">

<h4 class="text-success">

VendorBridge ERP Procurement Summary

</h4>

<p>

Generated on :
<?php echo date("d-m-Y H:i:s"); ?>

</p>

</div>

</div>

</div>

</body>

</html>

