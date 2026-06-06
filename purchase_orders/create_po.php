
<?php

include("../includes/auth_check.php");
include("../config/db.php");
require_once("../mail/send_notification.php");

if(
$_SESSION['role']!="Procurement" &&
$_SESSION['role']!="Admin"
)
{
    die("Access Denied");
}

$msg="";

if(isset($_POST['generate']))
{
    $quotation_id=(int)$_POST['quotation_id'];

    $amount=$_POST['amount'];

    $po_number=
    "PO".
    date("YmdHis");

    $insert=mysqli_query($conn,

    "INSERT INTO purchase_orders
    (
        quotation_id,
        po_number,
        amount
    )
    VALUES
    (
        '$quotation_id',
        '$po_number',
        '$amount'
    )");

    if($insert)
    {
        mysqli_query($conn,

        "INSERT INTO activity_logs
        (
            user_id,
            action
        )
        VALUES
        (
            '".$_SESSION['id']."',
            'Generated PO : $po_number'
        )");

        $vendor=mysqli_fetch_assoc(

        mysqli_query($conn,

        "SELECT
        v.vendor_name,
        v.email

        FROM quotations q

        JOIN vendors v
        ON q.vendor_id=v.vendor_id

        WHERE q.quotation_id='$quotation_id'")
        );

        if($vendor)
        {
            sendNotification(

            $vendor['email'],

            "Purchase Order Generated",

            "
            <h2>VendorBridge ERP</h2>

            <p>Dear ".$vendor['vendor_name'].",</p>

            <p>Your quotation has been approved.</p>

            <p><b>PO Number :</b> ".$po_number."</p>

            <p><b>Amount :</b> ₹".$amount."</p>

            <p>Please proceed with delivery.</p>

            <br>

            <p>VendorBridge ERP Team</p>
            "
            );
        }

        $msg="
        <div class='alert alert-success'>
        Purchase Order Generated Successfully
        & Email Sent To Vendor
        </div>";
    }
}

$data=mysqli_query($conn,

"SELECT
q.quotation_id,
q.price,
v.vendor_name

FROM quotations q

LEFT JOIN vendors v
ON q.vendor_id=v.vendor_id

WHERE q.workflow_status='Approved'

ORDER BY q.quotation_id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Generate Purchase Order</title>

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
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-dark text-white">

<h3>

<i class="fa fa-file-invoice"></i>

Generate Purchase Order

</h3>

</div>

<div class="card-body">

<?php echo $msg; ?>

<form method="post">

<label class="fw-bold">
Select Approved Quotation
</label>

<select
name="quotation_id"
class="form-control mb-3"
required>

<option value="">
Select Quotation
</option>

<?php
while($row=mysqli_fetch_assoc($data))
{
?>

<option
value="<?php echo $row['quotation_id']; ?>">

<?php

echo
"Quotation #".
$row['quotation_id'].
" | ".
$row['vendor_name'].
" | ₹".
$row['price'];

?>

</option>

<?php
}
?>

</select>

<label class="fw-bold">
PO Amount
</label>

<input
type="number"
name="amount"
class="form-control mb-3"
required>

<button
type="submit"
name="generate"
class="btn btn-primary">

<i class="fa fa-plus-circle"></i>

Generate PO

</button>

<a href="po_list.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>

