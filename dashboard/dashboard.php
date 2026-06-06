<?php

include("../includes/auth_check.php");
include("../config/db.php");

$vendor=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM vendors"));
$rfq=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM rfq"));
$quotation=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM quotations"));
$invoice=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM invoices"));

?>

<!DOCTYPE html>
<html>

<head>

<title>VendorBridge ERP Dashboard</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}
.counter{
font-size:40px;
font-weight:bold;
animation:pulse 2s infinite;
}

@keyframes pulse{
0%{transform:scale(1);}
50%{transform:scale(1.08);}
100%{transform:scale(1);}
}

body{
background:linear-gradient(
135deg,
#0f172a,
#1e293b,
#334155
);
min-height:100vh;
color:white;
overflow-x:hidden;
}

.circle1{
position:fixed;
width:250px;
height:250px;
background:#0d6efd;
border-radius:50%;
top:-100px;
left:-100px;
opacity:.3;
}

.circle2{
position:fixed;
width:300px;
height:300px;
background:#198754;
border-radius:50%;
bottom:-120px;
right:-120px;
opacity:.3;
}

.glass{
background:rgba(255,255,255,0.1);
backdrop-filter:blur(10px);
border-radius:20px;
border:1px solid rgba(255,255,255,0.2);
}

.header{
padding:20px;
}

.profile-img{
width:90px;
height:90px;
border-radius:50%;
border:3px solid white;
object-fit:cover;
}

.card-box{
padding:25px;
text-align:center;
height:180px;
transition:.4s;
}

.card-box:hover{
transform:translateY(-10px) scale(1.05);
box-shadow:0 15px 30px rgba(0,0,0,.3);
}

.card-box i{
font-size:50px;
margin-bottom:10px;
}

.counter{
font-size:40px;
font-weight:bold;
}

.menu-btn{
margin:8px;
transition:.3s;
}

.menu-btn:hover{
transform:scale(1.08);
}

.chart-box{
padding:20px;
margin-top:30px;
}

.logout{
position:fixed;
top:20px;
right:20px;
}

</style>

</head>

<body>

<div class="circle1"></div>
<div class="circle2"></div>

<a href="../auth/logout.php"
class="btn btn-danger logout">
<i class="fa fa-sign-out-alt"></i>
Logout
</a>

<div class="container">

<div class="header text-center">

<img
src="../uploads/<?php echo $_SESSION['photo']; ?>"
class="profile-img">

<h2 class="mt-3">
VendorBridge ERP Dashboard
</h2>

<h4>
Welcome,
<?php echo $_SESSION['name']; ?>
</h4>
<div class="glass p-3 mt-3 text-center">

<h5>
Procurement & Vendor Management System
</h5>

<p>
Digital Procurement Workflow • RFQ • Quotation • Approval • PO • Invoice
</p>

<h4 id="clock"></h4>

</div>
<span class="badge bg-warning text-dark">
<?php echo $_SESSION['role']; ?>
</span>

</div>

<div class="row g-4">

<div class="col-md-3">
<div class="glass card-box">
<i class="fa-solid fa-users text-primary"></i>
<div class="counter"><?php echo $vendor; ?></div>
<h5>Vendors</h5>
</div>
</div>

<div class="col-md-3">
<div class="glass card-box">
<i class="fa-solid fa-file-signature text-success"></i>
<div class="counter"><?php echo $rfq; ?></div>
<h5>RFQs</h5>
</div>
</div>

<div class="col-md-3">
<div class="glass card-box">
<i class="fa-solid fa-handshake text-warning"></i>
<div class="counter"><?php echo $quotation; ?></div>
<h5>Quotations</h5>
</div>
</div>

<div class="col-md-3">
<div class="glass card-box">
<i class="fa-solid fa-file-invoice-dollar text-danger"></i>
<div class="counter"><?php echo $invoice; ?></div>
<h5>Invoices</h5>
</div>
</div>

</div>

<div class="row mt-5">

<?php

/* ================= ADMIN ================= */

if($_SESSION['role']=="Admin")
{
?>

<div class="col-md-3 mb-3">
<a href="../vendors/vendor_list.php"
class="btn btn-primary w-100 p-4">
<i class="fa fa-users fa-2x"></i><br><br>
Vendor Management
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../users/user_list.php"
class="btn btn-warning w-100 p-4">
<i class="fa fa-user-shield fa-2x"></i><br><br>
User Management
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../logs/activity_logs.php"
class="btn btn-dark w-100 p-4">
<i class="fa fa-history fa-2x"></i><br><br>
Activity Logs
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../reports/analytics.php"
class="btn btn-secondary w-100 p-4">
<i class="fa fa-chart-line fa-2x"></i><br><br>
Analytics
</a>
</div>

<?php
}

/* ================= PROCUREMENT ================= */

if($_SESSION['role']=="Procurement")
{
?>

<div class="col-md-3 mb-3">
<a href="../rfq/rfq_list.php"
class="btn btn-success w-100 p-4">
<i class="fa fa-file-signature fa-2x"></i><br><br>
RFQ Management
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../quotations/quotation_list.php"
class="btn btn-warning w-100 p-4">
<i class="fa fa-handshake fa-2x"></i><br><br>
Review Quotations
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../purchase_orders/create_po.php"
class="btn btn-primary w-100 p-4">
<i class="fa fa-file-circle-plus fa-2x"></i><br><br>
Generate PO
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../purchase_orders/po_list.php"
class="btn btn-dark w-100 p-4">
<i class="fa fa-cart-shopping fa-2x"></i><br><br>
Purchase Orders
</a>
</div>

<div class="col-md-6 mb-3">
<a href="../invoices/invoice_list.php"
class="btn btn-danger w-100 p-4">
<i class="fa fa-file-invoice-dollar fa-2x"></i><br><br>
Invoice Verification
</a>
</div>

<div class="col-md-6 mb-3">
<a href="../reports/procurement_report.php"
class="btn btn-info w-100 p-4">
<i class="fa fa-chart-column fa-2x"></i><br><br>
Procurement Reports
</a>
</div>

<?php
}

/* ================= VENDOR ================= */

if($_SESSION['role']=="Vendor")
{
?>

<div class="col-md-4 mb-3">
<a href="../rfq/rfq_list.php"
class="btn btn-info w-100 p-4">
<i class="fa fa-eye fa-2x"></i><br><br>
View RFQ
</a>
</div>

<div class="col-md-4 mb-3">
<a href="../quotations/submit_quote.php"
class="btn btn-success w-100 p-4">
<i class="fa fa-file-contract fa-2x"></i><br><br>
Submit Quotation
</a>
</div>

<div class="col-md-4 mb-3">
<a href="../quotations/my_quote.php"
class="btn btn-warning w-100 p-4">
<i class="fa fa-list fa-2x"></i><br><br>
My Quotations
</a>
</div>

<div class="col-md-6 mb-3">
<a href="../purchase_orders/my_po.php"
class="btn btn-primary w-100 p-4">
<i class="fa fa-file-invoice fa-2x"></i><br><br>
My Purchase Orders
</a>
</div>

<div class="col-md-6 mb-3">
<a href="../invoices/upload_invoice.php"
class="btn btn-danger w-100 p-4">
<i class="fa fa-upload fa-2x"></i><br><br>
Upload Invoice
</a>
</div>

<?php
}

/* ================= MANAGER ================= */

if($_SESSION['role']=="Manager")
{
?>

<div class="col-md-3 mb-3">
<a href="../quotations/compare_quotes.php"
class="btn btn-warning w-100 p-4">
<i class="fa fa-scale-balanced fa-2x"></i><br><br>
Compare Quotes
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../approvals/approval_list.php"
class="btn btn-info w-100 p-4">
<i class="fa fa-check-circle fa-2x"></i><br><br>
Approvals
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../reports/analytics.php"
class="btn btn-secondary w-100 p-4">
<i class="fa fa-chart-pie fa-2x"></i><br><br>
Reports
</a>
</div>

<div class="col-md-3 mb-3">
<a href="../reports/vendor_performance.php"
class="btn btn-success w-100 p-4">
<i class="fa fa-star fa-2x"></i><br><br>
Vendor Performance
</a>
</div>

<?php
}
?>

</div>



<div class="glass chart-box">

<h4 class="mb-4">
ERP Analytics
</h4>

<canvas id="analyticsChart"></canvas>

</div>

<div class="text-center mt-4 mb-3">
VendorBridge ERP © 2026
</div>

</div>

<script>

const ctx=document.getElementById('analyticsChart');

new Chart(ctx,{

type:'bar',

data:{

labels:[
'Vendors',
'RFQs',
'Quotations',
'Invoices'
],

datasets:[{

label:'System Data',

data:[
<?php echo $vendor;?>,
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

},

options:{
responsive:true
}

});
<script>

function updateClock()
{
let now=new Date();

document.getElementById("clock").innerHTML=
now.toLocaleString();
}

setInterval(updateClock,1000);

updateClock();

</script>
</script>

</body>
</html>