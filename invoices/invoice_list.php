
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

if(isset($_GET['paid']))
{
    $id=(int)$_GET['paid'];

    mysqli_query($conn,

    "UPDATE invoices
    SET status='Paid'
    WHERE invoice_id='$id'");

    mysqli_query($conn,

    "INSERT INTO activity_logs
    (
        user_id,
        action
    )
    VALUES
    (
        '".$_SESSION['id']."',
        'Marked Invoice ID $id As Paid'
    )");

    $vendor=mysqli_fetch_assoc(

    mysqli_query($conn,

    "SELECT
    v.vendor_name,
    v.email,
    i.invoice_number,
    i.grand_total

    FROM invoices i

    JOIN purchase_orders p
    ON i.po_id=p.po_id

    JOIN quotations q
    ON p.quotation_id=q.quotation_id

    JOIN vendors v
    ON q.vendor_id=v.vendor_id

    WHERE i.invoice_id='$id'")
    );

    if($vendor)
    {
        sendNotification(

        $vendor['email'],

        "Invoice Payment Completed",

        "
        <h2>VendorBridge ERP</h2>

        <p>Dear ".$vendor['vendor_name'].",</p>

        <p>Your payment has been completed successfully.</p>

        <p><b>Invoice No :</b>
        ".$vendor['invoice_number']."</p>

        <p><b>Amount Paid :</b>
        ₹".$vendor['grand_total']."</p>

        <p>Thank you for working with us.</p>

        <br>

        <p>VendorBridge ERP Team</p>
        "
        );
    }

    echo "<script>
    alert('Invoice Marked Paid & Vendor Notified');
    window.location='invoice_list.php';
    </script>";
    exit();
}

$sql="SELECT i.*,
p.po_number

FROM invoices i

LEFT JOIN purchase_orders p
ON i.po_id=p.po_id

ORDER BY i.invoice_id DESC";

$data=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>Invoice Management</title>

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

<div class="container mt-4">

<div class="card p-4">

<div class="d-flex justify-content-between">

<h2>
<i class="fa fa-file-invoice-dollar"></i>
Invoice Management
</h2>

<a href="upload_invoice.php"
class="btn btn-success">

<i class="fa fa-upload"></i>

Upload Invoice

</a>

</div>

<hr>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Invoice No</th>
<th>PO Number</th>
<th>Amount</th>
<th>GST %</th>
<th>Tax</th>
<th>Grand Total</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($data))
{
?>

<tr>

<td><?php echo $row['invoice_id']; ?></td>

<td><?php echo $row['invoice_number']; ?></td>

<td><?php echo $row['po_number']; ?></td>

<td>₹ <?php echo $row['total_amount']; ?></td>

<td><?php echo $row['gst_percentage']; ?>%</td>

<td>₹ <?php echo $row['tax']; ?></td>

<td>₹ <?php echo $row['grand_total']; ?></td>

<td>

<?php

if($row['status']=="Paid")
{
echo "<span class='badge bg-success'>Paid</span>";
}
else
{
echo "<span class='badge bg-danger'>Unpaid</span>";
}

?>

</td>

<td>

<?php

if($row['status']=="Unpaid")
{
?>

<a href="?paid=<?php echo $row['invoice_id']; ?>"
class="btn btn-primary btn-sm"
onclick="return confirm('Mark Invoice Paid ?')">

Mark Paid

</a>

<?php
}
else
{
?>

<span class="badge bg-success">
Completed
</span>

<?php
}
?>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

<a href="../dashboard/dashboard.php"
class="btn btn-secondary">

<i class="fa fa-arrow-left"></i>

Dashboard

</a>

</div>

</div>

</body>

</html>

