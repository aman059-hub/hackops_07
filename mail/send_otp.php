```php
<?php

require_once("mail_config.php");

function sendOTP($email,$otp)
{
    try
    {
        $mail = getMailer();

        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject =
        "VendorBridge ERP - Email Verification OTP";

        $mail->Body = "

        <div style='font-family:Arial;padding:20px;'>

        <h2 style='color:#0d6efd;'>
        VendorBridge ERP
        </h2>

        <p>
        Thank you for registering.
        </p>

        <p>
        Your OTP Verification Code:
        </p>

        <h1 style='color:#198754;'>
        $otp
        </h1>

        <p>
        This OTP is valid for one verification attempt.
        </p>

        </div>

        ";

        return $mail->send();
    }
    catch(Exception $e)
    {
        return false;
    }
}
?>
```
