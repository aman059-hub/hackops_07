```php
<?php

session_start();

include("../config/db.php");

$msg="";

if(isset($_POST['login']))
{
    $email=mysqli_real_escape_string(
    $conn,
    $_POST['email']
    );

    $password=$_POST['password'];

    $sql="SELECT * FROM users
          WHERE email='$email'";

    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);

        if(password_verify(
            $password,
            $row['password']
        ))
        {
            if($row['email_verified']==0)
            {
                $msg="
                <div class='alert alert-warning'>
                Please verify your email first.
                </div>";
            }
            else
            {
                $_SESSION['id']=$row['id'];

                $_SESSION['name']=$row['fullname'];

                $_SESSION['role']=$row['role'];

                $_SESSION['photo']=$row['photo'];

                header(
                "location:../dashboard/dashboard.php"
                );

                exit();
            }
        }
        else
        {
            $msg="
            <div class='alert alert-danger'>
            Wrong Password
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

<title>VendorBridge ERP Login</title>

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
}

.circle1{
position:absolute;
width:250px;
height:250px;
background:#0d6efd;
border-radius:50%;
top:-100px;
left:-100px;
opacity:.3;
}

.circle2{
position:absolute;
width:300px;
height:300px;
background:#198754;
border-radius:50%;
bottom:-120px;
right:-120px;
opacity:.3;
}

.login-box{
width:430px;
padding:35px;
border-radius:20px;
background:rgba(255,255,255,0.1);
backdrop-filter:blur(12px);
box-shadow:0 10px 30px rgba(0,0,0,.4);
animation:fadeIn 1s ease;
}

.logo{
font-size:50px;
text-align:center;
color:white;
margin-bottom:10px;
}

.title{
text-align:center;
color:white;
font-weight:bold;
}

.subtitle{
text-align:center;
color:#ddd;
margin-bottom:25px;
}

.form-control{
height:50px;
border-radius:10px;
}

.btn-login{
height:50px;
font-size:18px;
font-weight:bold;
border-radius:10px;
}

.form-check-label{
color:white;
}

.link{
color:white;
text-decoration:none;
}

.link:hover{
color:#0d6efd;
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

<div class="login-box">

<div class="logo">
<i class="fa-solid fa-building"></i>
</div>

<h3 class="title">
VendorBridge ERP
</h3>

<div class="subtitle">
Procurement & Vendor Management System
</div>

<?php echo $msg; ?>

<form method="post">

<div class="mb-3">

<input
type="email"
name="email"
class="form-control"
placeholder="Enter Email"
required>

</div>

<div class="mb-3">

<input
type="password"
name="password"
id="password"
class="form-control"
placeholder="Enter Password"
required>

</div>

<div class="form-check mb-3">

<input
type="checkbox"
class="form-check-input"
onclick="togglePassword()">

<label class="form-check-label">

Show Password

</label>

</div>

<button
type="submit"
name="login"
class="btn btn-success w-100 btn-login">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>
<div class="text-center mt-3">

<a href="forgot_password.php">

Forgot Password ?

</a>

</div>
</form>

<div class="text-center mt-3">

<a href="signup.php"
class="link">

Create New Account

</a>

</div>

</div>

<script>

function togglePassword()
{
var x=
document.getElementById("password");

if(x.type==="password")
{
x.type="text";
}
else
{
x.type="password";
}
}

</script>

</body>

</html>
```
