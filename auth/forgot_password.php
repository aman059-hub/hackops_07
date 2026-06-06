```php
<?php

session_start();

include("../config/db.php");
require_once("../mail/send_otp.php");

$msg="";

if(isset($_POST['send']))
{
    $email=mysqli_real_escape_string(
    $conn,
    $_POST['email']
    );

    $check=mysqli_query($conn,

    "SELECT *
     FROM users
     WHERE email='$email'");

    if(mysqli_num_rows($check)>0)
    {
        $otp=rand(100000,999999);

        mysqli_query($conn,

        "UPDATE users
         SET otp='$otp'
         WHERE email='$email'");

        if(sendOTP($email,$otp))
        {
            $_SESSION['reset_email']=$email;

            header(
            "location:verify_reset_otp.php"
            );
            exit();
        }
        else
        {
            $msg="
            <div class='alert alert-danger'>
            Failed To Send OTP Email
            </div>";
        }
    }
    else
    {
        $msg="
        <div class='alert alert-danger'>
        Email Not Found
        </div>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Forgot Password</title>

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
color:#0d6efd;
}

</style>

</head>

<body>

<div class="card">

<div class="logo">
<i class="fa fa-key"></i>
</div>

<h3 class="text-center mb-4">

Forgot Password

</h3>

<?php echo $msg; ?>

<form method="post">

<label class="fw-bold">
Registered Email
</label>

<input
type="email"
name="email"
class="form-control mb-3"
placeholder="Enter Email Address"
required>

<button
type="submit"
name="send"
class="btn btn-primary w-100">

<i class="fa fa-paper-plane"></i>

Send OTP

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
