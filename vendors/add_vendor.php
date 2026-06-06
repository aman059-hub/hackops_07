<?php
include("../includes/auth_check.php");
include("../config/db.php");

if(isset($_POST['save']))
{
    $code="VEN".rand(1000,9999);

    $name=$_POST['vendor_name'];
    $category=$_POST['category'];
    $gst=$_POST['gst_no'];
    $person=$_POST['contact_person'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];

    $sql="INSERT INTO vendors
    (vendor_code,vendor_name,category,gst_no,
    contact_person,phone,email,address,
    city,state,pincode)

    VALUES

    ('$code','$name','$category','$gst',
    '$person','$phone','$email','$address',
    '$city','$state','$pincode')";

    mysqli_query($conn,$sql);

    header("location:vendor_list.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Vendor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<div class="card">

<div class="card-header">
<h3>Add Vendor</h3>
</div>

<div class="card-body">

<form method="post">

<div class="row">

<div class="col-md-6">
<label>Vendor Name</label>
<input type="text" name="vendor_name" class="form-control" required>
</div>

<div class="col-md-6">
<label>Category</label>
<select name="category" class="form-control">

<option>Electronics</option>
<option>Hardware</option>
<option>Software</option>
<option>Office Supplies</option>

</select>
</div>

<div class="col-md-6 mt-3">
<label>GST Number</label>
<input type="text" name="gst_no" class="form-control">
</div>

<div class="col-md-6 mt-3">
<label>Contact Person</label>
<input type="text" name="contact_person" class="form-control">
</div>

<div class="col-md-6 mt-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="col-md-6 mt-3">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="col-md-12 mt-3">
<label>Address</label>
<textarea name="address" class="form-control"></textarea>
</div>

<div class="col-md-4 mt-3">
<label>City</label>
<input type="text" name="city" class="form-control">
</div>

<div class="col-md-4 mt-3">
<label>State</label>
<input type="text" name="state" class="form-control">
</div>

<div class="col-md-4 mt-3">
<label>Pincode</label>
<input type="text" name="pincode" class="form-control">
</div>

<div class="col-md-12 mt-3">
<button class="btn btn-success" name="save">
Save Vendor
</button>
</div>

</div>

</form>

</div>

</div>

</div>

</body>
</html>