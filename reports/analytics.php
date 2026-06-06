
<?php

include("../config/db.php");

$vendors=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM vendors"));
$rfq=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM rfq"));
$quotation=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM quotations"));
$invoice=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM invoices"));

?>

<!DOCTYPE html>
<html>

<head>

<title>VendorBridge Analytics</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
min-height:100vh;
color:white;
}

.glass{
background:rgba(255,255,255,0.1);
backdrop-filter:blur(10px);
border-radius:20px;
border:1px solid rgba(255,255,255,0.2);
}

.stat-card{
padding:25px;
text-align:center;
transition:.4s;
height:180px;
}

.stat-card:hover{
transform:translateY(-10px) scale(1.05);
box-shadow:0px 15px 30px rgba(0,0,0,.3);
}

.icon{
font-size:50px;
margin-bottom:10px;
}

.number{
font-size:40px;
font-weight:bold;
}

.chart-box{
padding:20px;
margin-top:30px;
}

.title{
font-weight:bold;
margin-bottom:25px;
}

</style>

</head>

<body>

<div class="container py-4">

<h2 class="title">
<i class="fa-solid fa-chart-line"></i>
 VendorBridge Analytics Dashboard
</h2>

<div class="row g-4">

<div class="col-md-3">
<div class="glass stat-card">
<i class="fa-solid fa-users icon text-primary"></i>
<div class="number"><?php echo $vendors; ?></div>
<h5>Vendors</h5>
</div>
</div>

<div class="col-md-3">
<div class="glass stat-card">
<i class="fa-solid fa-file-signature icon text-success"></i>
<div class="number"><?php echo $rfq; ?></div>
<h5>RFQs</h5>
</div>
</div>

<div class="col-md-3">
<div class="glass stat-card">
<i class="fa-solid fa-handshake icon text-warning"></i>
<div class="number"><?php echo $quotation; ?></div>
<h5>Quotations</h5>
</div>
</div>

<div class="col-md-3">
<div class="glass stat-card">
<i class="fa-solid fa-file-invoice-dollar icon text-danger"></i>
<div class="number"><?php echo $invoice; ?></div>
<h5>Invoices</h5>
</div>
</div>

</div>

<div class="row mt-5">

<div class="col-md-8">

<div class="glass chart-box">

<h4>Procurement Analytics</h4>

<canvas id="barChart"></canvas>

</div>

</div>

<div class="col-md-4">

<div class="glass chart-box">

<h4>Distribution</h4>

<canvas id="pieChart"></canvas>

</div>

</div>

</div>

</div>

<script>

new Chart(
document.getElementById("barChart"),
{
type:'bar',
data:{
labels:['Vendors','RFQs','Quotations','Invoices'],
datasets:[{
label:'ERP Analytics',
data:[
<?php echo $vendors;?>,
<?php echo $rfq;?>,
<?php echo $quotation;?>,
<?php echo $invoice;?>
],
backgroundColor:[
'#0d6efd',
'#198754',
'#ffc107',
'#dc3545'
]
}]
}
});

new Chart(
document.getElementById("pieChart"),
{
type:'doughnut',
data:{
labels:['Vendors','RFQs','Quotations','Invoices'],
datasets:[{
data:[
<?php echo $vendors;?>,
<?php echo $rfq;?>,
<?php echo $quotation;?>,
<?php echo $invoice;?>
],
backgroundColor:[
'#0d6efd',
'#198754',
'#ffc107',
'#dc3545'
]
}]
}
});

</script>

</body>

</html>

