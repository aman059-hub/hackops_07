
<?php

include("../includes/auth_check.php");
include("../config/db.php");
require_once("../mail/send_notification.php");

if($_SESSION['role']!="Manager")
{
    die("Access Denied");
}

if(!isset($_GET['id']))
{
    die("Quotation ID Missing");
}

$quotation_id=(int)$_GET['id'];

$q=mysqli_query($conn,

"SELECT q.*,
r.title

FROM quotations q

LEFT JOIN rfq r
ON q.rfq_id=r.rfq_id

WHERE q.quotation_id='$quotation_id'");

$row=mysqli_fetch_assoc($q);

if(!$row)
{
    die("Quotation Not Found");
}

mysqli_query($conn,

"UPDATE quotations

SET
status='Approved',
workflow_status='Approved'

WHERE quotation_id='$quotation_id'");

$manager_id=$_SESSION['id'];

mysqli_query($conn,

"INSERT INTO approvals
(
quotation_id,
approved_by,
remarks,
status,
timeline
)

VALUES
(
'$quotation_id',
'$manager_id',
'Quotation Approved',
'Approved',
NOW()
)");

mysqli_query($conn,

"INSERT INTO activity_logs
(
user_id,
action
)

VALUES
(
'$manager_id',
'Approved Quotation ID $quotation_id'
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

    "Quotation Approved",

    "
    <h2>VendorBridge ERP</h2>

    <p>Hello ".$procurement['fullname'].",</p>

    <p>A quotation has been approved by Manager.</p>

    <p><b>RFQ:</b> ".$row['title']."</p>

    <p>Please generate Purchase Order.</p>

    <br>

    <p>VendorBridge ERP</p>
    "
    );
}

header("location:approval_list.php");
exit();

?>
