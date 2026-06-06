<?php

include("../config/db.php");

$id=$_GET['id'];

$data=mysqli_query($conn,

"SELECT * FROM quotations
WHERE quotation_id='$id'");

$row=mysqli_fetch_assoc($data);

if(isset($_POST['update']))
{
    $price=$_POST['price'];
    $days=$_POST['delivery_days'];

    mysqli_query($conn,

    "UPDATE quotations SET

    price='$price',
    delivery_days='$days'

    WHERE quotation_id='$id'");

    header("location:quotation_list.php");
}
?>

<form method="post">

<input type="text"
name="price"
value="<?php echo $row['price']; ?>">

<input type="text"
name="delivery_days"
value="<?php echo $row['delivery_days']; ?>">

<button name="update">

Update

</button>

</form>