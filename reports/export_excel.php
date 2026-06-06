<?php

include("../config/db.php");

header(
"Content-Type: application/vnd.ms-excel"
);

header(
"Content-Disposition: attachment; filename=VendorReport.xls"
);

$data=mysqli_query($conn,
"SELECT * FROM vendors");

echo "Vendor Name\tEmail\tPhone\n";

while($row=mysqli_fetch_assoc($data))
{
echo

$row['vendor_name']."\t".

$row['email']."\t".

$row['phone']."\n";
}
?>