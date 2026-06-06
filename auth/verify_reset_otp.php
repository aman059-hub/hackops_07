
<?php

session_start();

include("../config/db.php");

if(!isset($_SESSION['reset_email']))
{
    header("location:forgot_password.php");
    exit();
}

$msg="";

if(isset($_POST['verify']))
{
    $otp=$_POST['otp'];

    $email=$_SESSION['reset_email'];

    $check=mysqli_query($conn,

    "SELECT *
     FROM users
     WHERE email='$email'
     AND otp='$otp'");

    if(mysqli_num_rows($check)>0)
    {
        header("location:reset_password.php");
        exit();
    }
    else
    {
        $msg="
        <div class='alert alert-danger'>
        Invalid OTP
        </div>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>OTP Verification</title>

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

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(
135deg,
#0f172a,
#1e293b,
#334155
);
overflow:hidden;
position:relative;
}

.circle1{
position:absolute;
width:300px;
height:300px;
background:#0d6efd;
border-radius:50%;
top:-120px;
left:-120px;
opacity:.3;
}

.circle2{
position:absolute;
width:350px;
height:350px;
background:#198754;
border-radius:50%;
bottom:-150px;
right:-150px;
opacity:.3;
}

.card{
width:450px;
padding:35px;
background:rgba(255,255,255,0.1);
backdrop-filter:blur(15px);
border-radius:25px;
border:1px solid rgba(255,255,255,0.2);
box-shadow:0 10px 40px rgba(0,0,0,.3);
z-index:1;
animation:fadeIn 1s ease;
}

.logo{
font-size:60px;
text-align:center;
color:#22c55e;
margin-bottom:10px;
}

h3{
color:white;
font-weight:bold;
text-align:center;
}

.subtitle{
text-align:center;
color:#d1d5db;
margin-bottom:20px;
}

label{
color:white;
font-weight:600;
}

.form-control{
height:55px;
border-radius:12px;
font-size:20px;
text-align:center;
letter-spacing:5px;
}

.btn-success{
height:55px;
font-size:18px;
font-weight:bold;
border-radius:12px;
}

.btn-success:hover{
transform:scale(1.03);
transition:.3s;
}

.back-link{
text-decoration:none;
color:#60a5fa;
font-weight:600;
}

.back-link:hover{
color:white;
}

@keyframes fadeIn{
from{
opacity:0;
transform:translateY(50px);
}
to{
opacity:1;
transform:translateY(0);
}
}

</style>

</head>

<body>

<div class="circle1"></div>
<div class="circle2"></div>

<div class="card">

<div class="logo">
<i class="fa fa-shield-halved"></i>
</div>

<h3>
OTP Verification
</h3>

<div class="subtitle">
Enter the OTP sent to your registered email
</div>

<?php echo $msg; ?>

<form method="post">

<label>
Enter OTP
</label>

<input
type="text"
name="otp"
class="form-control mb-3"
placeholder="000000"
maxlength="6"
required>

<button
type="submit"
name="verify"
class="btn btn-success w-100">

<i class="fa fa-check-circle"></i>

Verify OTP

</button>

</form>

<div class="text-center mt-3">

<a href="forgot_password.php"
class="back-link">

<i class="fa fa-arrow-left"></i>

Back

</a>

</div>

</div>

</body>

</html>

