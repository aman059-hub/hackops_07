
<?php

include("../includes/auth_check.php");
include("../config/db.php");
require_once("../mail/send_notification.php");

if($_SESSION['role']!="Vendor")
{
    die("Access Denied");
}

$msg="";

if(isset($_POST['submit']))
{
    $po_id=(int)$_POST['po_id'];

    $invoice_number=mysqli_real_escape_string(
    $conn,
    $_POST['invoice_number']
    );

    $amount=(float)$_POST['amount'];

    $gst_percentage=18;

    $tax=($amount*$gst_percentage)/100;

    $grand_total=$amount+$tax;

    $insert=mysqli_query($conn,

    "INSERT INTO invoices
    (
        po_id,
        invoice_number,
        tax,
        total_amount,
        gst_percentage,
        grand_total
    )
    VALUES
    (
        '$po_id',
        '$invoice_number',
        '$tax',
        '$amount',
        '$gst_percentage',
        '$grand_total'
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
            'Uploaded Invoice : $invoice_number'
        )");

        $procurement=mysqli_fetch_assoc(

        mysqli_query($conn,

        "SELECT email,fullname

        FROM users

        WHERE role='Procurement'

        LIMIT 1")
        );

        if($procurement)
        {
            sendNotification(

            $procurement['email'],

            "Invoice Uploaded",

            "
            <h2>VendorBridge ERP</h2>

            <p>Hello ".$procurement['fullname'].",</p>

            <p>A vendor has uploaded a new invoice.</p>

            <p><b>Invoice No :</b> ".$invoice_number."</p>

            <p><b>Amount :</b> ₹".$amount."</p>

            <p><b>GST :</b> ".$gst_percentage."%</p>

            <p><b>Total :</b> ₹".$grand_total."</p>

            <p>Please verify and process payment.</p>
            "
            );
        }

        $msg="
        <div class='alert alert-success'>
        Invoice Uploaded Successfully
        & Procurement Notified
        </div>";
    }
}

$po=mysqli_query($conn,

"SELECT
p.*,
v.vendor_name

FROM purchase_orders p

LEFT JOIN quotations q
ON p.quotation_id=q.quotation_id

LEFT JOIN vendors v
ON q.vendor_id=v.vendor_id

ORDER BY p.po_id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Upload Invoice</title>

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

<div class="card-header bg-success text-white">

<h3>

<i class="fa fa-file-invoice-dollar"></i>

Upload Invoice

</h3>

</div>

<div class="card-body">

<?php echo $msg; ?>

<form method="post">

<label class="fw-bold">
Purchase Order
</label>

<select
name="po_id"
class="form-control mb-3"
required>

<option value="">
Select PO
</option>

<?php

while($row=mysqli_fetch_assoc($po))
{
?>

<option
value="<?php echo $row['po_id']; ?>">

<?php

echo
$row['po_number'].
" - ".
$row['vendor_name'];

?>

</option>

<?php
}
?>

</select>

<label class="fw-bold">
Invoice Number
</label>

<input
type="text"
name="invoice_number"
class="form-control mb-3"
required>

<label class="fw-bold">
Invoice Amount
</label>

<input
type="number"
name="amount"
class="form-control mb-3"
required>

<button
type="submit"
name="submit"
class="btn btn-success">

<i class="fa fa-upload"></i>

Upload Invoice

</button>

<a href="invoice_list.php"
class="btn btn-secondary">

View Invoices

</a>

</form>

</div>

</div>

</div>

</body>

</html>

