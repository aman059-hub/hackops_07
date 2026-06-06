```php
<?php

session_start();

include("../config/db.php");

if(!isset($_SESSION['reset_email']))
{
    header("location:forgot_password.php");
    exit();
}

$msg="";

if(isset($_POST['reset']))
{
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];

    if($password!=$confirm_password)
    {
        $msg="
        <div class='alert alert-danger'>
        Passwords do not match
        </div>";
    }
    else
    {
        $hash=password_hash(
        $password,
        PASSWORD_DEFAULT
        );

        $email=$_SESSION['reset_email'];

        mysqli_query($conn,

        "UPDATE users

        SET
        password='$hash',
        otp=NULL

        WHERE email='$email'");

        unset($_SESSION['reset_email']);

        echo "<script>

        alert('Password Reset Successfully');

        window.location='login.php';

        </script>";

        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Reset Password</title>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
background:linear-gradient(
135deg,
#141e30,
#243b55
);
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.card{
width:450px;
border:none;
border-radius:20px;
padding:30px;
box-shadow:0px 10px 30px rgba(0,0,0,.3);
}

.logo{
font-size:50px;
text-align:center;
color:#dc3545;
}

</style>

</head>

<body>

<div class="card">

<div class="logo">
<i class="fa fa-lock"></i>
</div>

<h3 class="text-center mb-4">

Reset Password

</h3>

<?php echo $msg; ?>

<form method="post">

<label class="fw-bold">
New Password
</label>

<input
type="password"
name="password"
class="form-control mb-3"
required>

<label class="fw-bold">
Confirm Password
</label>

<input
type="password"
name="confirm_password"
class="form-control mb-3"
required>

<button
type="submit"
name="reset"
class="btn btn-danger w-100">

<i class="fa fa-key"></i>

Reset Password

</button>

</form>

<div class="text-center mt-3">

<a href="login.php">

Back To Login

</a>

</div>

</div>

</body>

</html>
```
