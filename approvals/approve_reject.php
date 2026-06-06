<?php

include("../includes/auth_check.php");
include("../config/db.php");

$id=$_GET['id'];

$data=mysqli_query($conn,

"SELECT * FROM quotations

WHERE quotation_id='$id'");

$row=mysqli_fetch_assoc($data);

if(isset($_POST['approve']))
{
    $remarks=$_POST['remarks'];

    mysqli_query($conn,

    "UPDATE quotations SET

    workflow_status='Approved',
    status='Approved'

    WHERE quotation_id='$id'");

    mysqli_query($conn,

    "INSERT INTO approvals

    (quotation_id,
    approved_by,
    remarks,
    status,
    timeline)

    VALUES

    ('$id',
    '".$_SESSION['id']."',
    '$remarks',
    'Approved',
    NOW())");

    header("location:approval_list.php");
}

if(isset($_POST['reject']))
{
    $remarks=$_POST['remarks'];

    mysqli_query($conn,

    "UPDATE quotations SET

    workflow_status='Rejected',
    status='Rejected'

    WHERE quotation_id='$id'");
mysqli_query($conn,

"INSERT INTO activity_logs
(user_id,action)

VALUES

('".$_SESSION['id']."',
'Rejected Quotation')");

    mysqli_query($conn,

    "INSERT INTO approvals

    (quotation_id,
    approved_by,
    remarks,
    status,
    timeline)

    VALUES

    ('$id',
    '".$_SESSION['id']."',
    '$remarks',
    'Rejected',
    NOW())");
mysqli_query($conn,

"INSERT INTO activity_logs
(user_id,action)

VALUES

('".$_SESSION['id']."',
'Approved Quotation')");

    header("location:approval_list.php");
}
?>

<!DOCTYPE html>
<html>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header">

Approve / Reject Quotation

</div>

<div class="card-body">

<h4>

Quotation Price :
₹<?php echo $row['price']; ?>

</h4>

<form method="post">

<label>Approval Remarks</label>

<textarea
name="remarks"
class="form-control mb-3"
required>
</textarea>

<button
name="approve"
class="btn btn-success">

Approve

</button>

<button
name="reject"
class="btn btn-danger">

Reject

</button>

</form>

</div>

</div>

</div>

</body>

</html>