
<?php

session_start();

include("../config/db.php");

require_once("../mail/send_otp.php");

$msg="";

if(isset($_POST['register']))
{
    $fullname=mysqli_real_escape_string(
        $conn,
        trim($_POST['fullname'])
    );

    $email=mysqli_real_escape_string(
        $conn,
        trim($_POST['email'])
    );

    $role=mysqli_real_escape_string(
        $conn,
        $_POST['role']
    );

    $password=password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $check=mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE email='$email'"
    );

    if(mysqli_num_rows($check)>0)
    {
        $msg="
        <div class='alert alert-danger'>
        Email already registered
        </div>";
    }
    else
    {
        $otp=rand(100000,999999);

        $photo="default.png";

        if(
            isset($_FILES['photo']) &&
            $_FILES['photo']['error']==0
        )
        {
            $uploadDir="../uploads/";

            if(!is_dir($uploadDir))
            {
                mkdir($uploadDir,0777,true);
            }

            $photo=time()."_".
            basename($_FILES['photo']['name']);

            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                $uploadDir.$photo
            );
        }

        $insert=mysqli_query($conn,

        "INSERT INTO users
        (
            fullname,
            email,
            password,
            role,
            photo,
            otp,
            email_verified
        )
        VALUES
        (
            '$fullname',
            '$email',
            '$password',
            '$role',
            '$photo',
            '$otp',
            0
        )");

        if(!$insert)
        {
            die(mysqli_error($conn));
        }

        if(sendOTP($email,$otp))
        {
            $_SESSION['verify_email']=$email;

            header(
            "location:verify_otp.php"
            );

            exit();
        }
        else
        {
            $msg="
            <div class='alert alert-danger'>
            OTP email sending failed
            </div>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>VendorBridge ERP Signup</title>

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
width:520px;
border:none;
border-radius:20px;
padding:30px;
box-shadow:0 10px 30px rgba(0,0,0,.3);
}

.logo{
text-align:center;
font-size:55px;
color:#0d6efd;
}

</style>

</head>

<body>

<div class="card">

<div class="logo">
<i class="fa fa-building"></i>
</div>

<h2 class="text-center mb-4">
VendorBridge ERP Signup
</h2>

<?php echo $msg; ?>

<form
method="post"
enctype="multipart/form-data">

<input
type="text"
name="fullname"
class="form-control mb-3"
placeholder="Full Name"
required>

<input
type="email"
name="email"
class="form-control mb-3"
placeholder="Email Address"
required>

<select
name="role"
class="form-control mb-3"
required>

<option value="">
Select Role
</option>

<option value="Vendor">
Vendor
</option>

<option value="Procurement">
Procurement
</option>

<option value="Manager">
Manager
</option>

</select>

<input
type="password"
name="password"
class="form-control mb-3"
placeholder="Password"
required>

<label class="mb-2">
Profile Photo
</label>

<input
type="file"
name="photo"
class="form-control mb-3"
accept="image/*"
required>

<button
type="submit"
name="register"
class="btn btn-primary w-100">

Register

</button>

</form>

<div class="text-center mt-3">

<a href="login.php">

Already have an account?

</a>

</div>

</div>

</body>

</html>

