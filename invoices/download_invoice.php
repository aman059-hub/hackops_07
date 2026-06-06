<?php

require '../vendor/autoload.php';

use Dompdf\Dompdf;

include("../config/db.php");

$id=$_GET['id'];

$data=mysqli_query($conn,

"SELECT * FROM invoices
WHERE invoice_id='$id'");

$row=mysqli_fetch_assoc($data);

$html='

<h1>VendorBridge Invoice</h1>

Invoice No :
'.$row['invoice_number'].'<br>

Amount :
'.$row['total_amount'].'<br>

GST :
'.$row['tax'].'<br>

Total :
'.$row['grand_total'];

$dompdf=new Dompdf();

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream(
"Invoice.pdf"
);