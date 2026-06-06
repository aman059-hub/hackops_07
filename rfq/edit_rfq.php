<?php

include("../config/db.php");

$id=$_GET['id'];

$data=mysqli_query($conn,
"SELECT * FROM rfq WHERE rfq_id='$id'");

$row=mysqli_fetch_assoc($data);

if(isset($_POST['update']))
{
$title=$_POST['title'];
$quantity=$_POST['quantity'];

mysqli_query($conn,

"UPDATE rfq SET

title='$title',
quantity='$quantity'

WHERE rfq_id='$id'");

header("location:rfq_list.php");
}
?>

<form method="post">

<input type="text"
name="title"
value="<?php echo $row['title']; ?>">

<input type="number"
name="quantity"
value="<?php echo $row['quantity']; ?>">

<button name="update">

Update RFQ

</button>

</form>