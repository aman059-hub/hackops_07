
<?php

include("../includes/auth_check.php");
include("../config/db.php");
require_once("../mail/send_notification.php");

if(
$_SESSION['role']!="Admin" &&
$_SESSION['role']!="Procurement"
)
{
    die("Access Denied");
}

$msg="";

if(isset($_POST['save']))
{
    $title=mysqli_real_escape_string(
    $conn,
    $_POST['title']
    );

    $description=mysqli_real_escape_string(
    $conn,
    $_POST['description']
    );

    $quantity=(int)$_POST['quantity'];

    $deadline=$_POST['deadline'];

    $vendor_id=(int)$_POST['vendor_id'];

    $created_by=$_SESSION['id'];

    $insert=mysqli_query($conn,

    "INSERT INTO rfq
    (
        title,
        description,
        quantity,
        deadline,
        vendor_id,
        created_by
    )
    VALUES
    (
        '$title',
        '$description',
        '$quantity',
        '$deadline',
        '$vendor_id',
        '$created_by'
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
            '$created_by',
            'Created RFQ : $title'
        )");

        $vendor=mysqli_fetch_assoc(

        mysqli_query($conn,

        "SELECT vendor_name,email
         FROM vendors
         WHERE vendor_id='$vendor_id'")
        );

        if(!empty($vendor['email']))
        {
            sendNotification(

            $vendor['email'],

            "New RFQ Assigned",

            "
            <h2>VendorBridge ERP</h2>

            <p>Dear ".$vendor['vendor_name'].",</p>

            <p>A new RFQ has been assigned to you.</p>

            <p><b>Title:</b> ".$title."</p>

            <p><b>Quantity:</b> ".$quantity."</p>

            <p><b>Deadline:</b> ".$deadline."</p>

            <p>Please login and submit quotation.</p>
            "
            );
        }

        $msg="
        <div class='alert alert-success'>
        RFQ Created Successfully &
        Email Sent To Vendor
        </div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Create RFQ</title>

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

<div class="card-header bg-primary text-white">

<h3>
<i class="fa fa-file-signature"></i>
Create RFQ
</h3>

</div>

<div class="card-body">

<?php echo $msg; ?>

<form method="post">

<label class="fw-bold">
RFQ Title
</label>

<input
type="text"
name="title"
class="form-control mb-3"
required>

<label class="fw-bold">
Description
</label>

<textarea
name="description"
class="form-control mb-3"
rows="4"></textarea>

<label class="fw-bold">
Quantity
</label>

<input
type="number"
name="quantity"
class="form-control mb-3"
required>

<label class="fw-bold">
Deadline
</label>

<input
type="date"
name="deadline"
class="form-control mb-3"
required>

<label class="fw-bold">
Assign Vendor
</label>

<select
name="vendor_id"
class="form-control mb-3"
required>

<option value="">
Select Vendor
</option>

<?php

$vendors=mysqli_query(
$conn,
"SELECT * FROM vendors
 ORDER BY vendor_name ASC"
);

while($v=mysqli_fetch_assoc($vendors))
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

<button
type="submit"
name="save"
class="btn btn-success">

<i class="fa fa-save"></i>

Create RFQ

</button>

<a href="rfq_list.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>

