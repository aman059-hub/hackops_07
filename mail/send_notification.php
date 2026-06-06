
<?php

require_once("mail_config.php");

function sendNotification(
    $email,
    $subject,
    $content
)
{
    try
    {
        $mail=getMailer();

        $mail->isHTML(true);

        $mail->addAddress($email);

        $template="

        <div style='
        font-family:Segoe UI,sans-serif;
        max-width:700px;
        margin:auto;
        border:1px solid #e5e7eb;
        border-radius:12px;
        overflow:hidden;
        '>

        <div style='
        background:#0d6efd;
        color:white;
        padding:20px;
        text-align:center;
        '>

        <h1 style='margin:0'>
        VendorBridge ERP
        </h1>

        <p style='margin:5px 0 0'>
        Procurement & Vendor Management System
        </p>

        </div>

        <div style='padding:30px;'>

        ".$content."

        </div>

        <div style='
        background:#f8f9fa;
        text-align:center;
        padding:15px;
        font-size:12px;
        color:#666;
        '>

        VendorBridge ERP © 2026

        <br>

        Automated Notification

        </div>

        </div>

        ";

        $mail->Subject=$subject;

        $mail->Body=$template;

        $mail->AltBody=strip_tags($content);

        return $mail->send();
    }
    catch(Exception $e)
    {
        return false;
    }
}
?>

