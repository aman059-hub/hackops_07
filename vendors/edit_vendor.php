<?php

include("../config/db.php");

$id=$_GET['id'];

$data=mysqli_query($conn,
"SELECT * FROM vendors WHERE vendor_id='$id'");

$row=mysqli_fetch_assoc($data);

if(isset($_POST['update']))
{
$name=$_POST['vendor_name'];
$category=$_POST['category'];
$phone=$_POST['phone'];

mysqli_query($conn,

"UPDATE vendors SET

vendor_name='$name',
category='$category',
phone='$phone'

WHERE vendor_id='$id'");

header("location:vendor_list.php");
}
?>

<form method="post">

<input type="text"
name="vendor_name"
value="<?php echo $row['vendor_name']; ?>">

<input type="text"
name="category"
value="<?php echo $row['category']; ?>">

<input type="text"
name="phone"
value="<?php echo $row['phone']; ?>">

<button name="update">

Update

</button>

</form>