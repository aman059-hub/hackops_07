```php
<?php

session_start();

include("../config/db.php");

if(!isset($_SESSION['verify_email']))
{
    header("location:signup.php");
    exit();
}

$email=$_SESSION['verify_email'];

$message="";

if(isset($_POST['verify']))
{
    $user_otp=$_POST['otp'];

    $result=mysqli_query($conn,

    "SELECT * FROM users
    WHERE email='$email'");

    $row=mysqli_fetch_assoc($result);

    if($row['otp']==$user_otp)
    {
        mysqli_query($conn,

       "UPDATE users
SET email_verified=1
WHERE email='$email'");

        unset($_SESSION['verify_email']);

        echo "<script>
        alert('Email Verified Successfully');
        window.location='login.php';
        </script>";

        exit();
    }
    else
    {
        $message="Invalid OTP";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Verify OTP</title>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
background:linear-gradient(
135deg,
#0f172a,
#1e293b,
#334155
);
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.card{
width:450px;
border:none;
border-radius:20px;
box-shadow:0px 10px 30px rgba(0,0,0,.3);
}

</style>

</head>

<body>

<div class="card p-4">

<h2 class="text-center mb-4">

Email Verification

</h2>

<p class="text-center">

OTP sent to

<b>
<?php echo $email; ?>
</b>

</p>

<?php

if($message!="")
{
?>

<div class="alert alert-danger">

<?php echo $message; ?>

</div>

<?php
}
?>

<form method="post">

<input
type="text"
name="otp"
class="form-control mb-3"
placeholder="Enter OTP"
required>

<button
type="submit"
name="verify"
class="btn btn-success w-100">

Verify OTP

</button>

</form>

<div class="text-center mt-3">

<a href="login.php">

Back to Login

</a>

</div>

</div>

</body>

</html>
```
