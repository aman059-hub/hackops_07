<?php

include("../includes/auth_check.php");
include("../config/db.php");

if(isset($_POST['submit']))
{
    $rfq_id=$_POST['rfq_id'];
    $vendor_id=$_POST['vendor_id'];
    $price=$_POST['price'];
    $delivery=$_POST['delivery_days'];
    $remarks=$_POST['remarks'];

    mysqli_query($conn,

    "INSERT INTO quotations
    (rfq_id,vendor_id,price,
    delivery_days,remarks)

    VALUES

    ('$rfq_id','$vendor_id',
    '$price','$delivery','$remarks')");

    header("location:quotation_list.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Submit Quotation</title>

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
max-width:800px;
margin:auto;
}

.card-header{
background:linear-gradient(
135deg,
#0d6efd,
#198754
);
color:white;
font-size:24px;
font-weight:bold;
padding:20px;
}

.form-control{
border-radius:10px;
}

textarea{
resize:none;
}

.btn{
border-radius:10px;
}

label{
font-weight:600;
margin-bottom:5px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header d-flex justify-content-between">

<span>

<i class="fa fa-file-contract"></i>

Submit Quotation

</span>

<a href="../dashboard/dashboard.php"
class="btn btn-dark">

<i class="fa fa-home"></i>

Dashboard

</a>

</div>

<div class="card-body">

<form method="post">

<label>
Select RFQ
</label>

<select
name="rfq_id"
class="form-control mb-3"
required>

<?php

$rfq=mysqli_query($conn,
"SELECT * FROM rfq");

while($r=mysqli_fetch_assoc($rfq))
{
?>

<option
value="<?php echo $r['rfq_id']; ?>">

<?php echo $r['title']; ?>

</option>

<?php
}
?>

</select>

<label>
Select Vendor
</label>

<select
name="vendor_id"
class="form-control mb-3"
required>

<?php

$vendor=mysqli_query($conn,
"SELECT * FROM vendors");

while($v=mysqli_fetch_assoc($vendor))
{
?>

<option
value="<?php echo $v['vendor_id']; ?>">

<?php echo $v['vendor_name']; ?>

</option>

<?php
}
?>

</select>

<label>
Price (₹)
</label>

<input
type="number"
step="0.01"
name="price"
class="form-control mb-3"
required>

<label>
Delivery Days
</label>

<input
type="number"
name="delivery_days"
class="form-control mb-3"
required>

<label>
Remarks
</label>

<textarea
name="remarks"
rows="4"
class="form-control mb-3"></textarea>

<button
type="submit"
name="submit"
class="btn btn-success">

<i class="fa fa-paper-plane"></i>

Submit Quote

</button>

<a href="quotation_list.php"
class="btn btn-secondary">

<i class="fa fa-arrow-left"></i>

Back

</a>

</form>

</div>

</div>

</div>

</body>



</html>