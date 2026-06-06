# VendorBridge ERP

## Procurement & Vendor Management System

### Project Overview

VendorBridge ERP is a web-based Procurement and Vendor Management System developed using PHP, MySQL, Bootstrap, JavaScript, and PHPMailer. The system automates the procurement lifecycle from RFQ creation to quotation approval, purchase order generation, invoice processing, and vendor communication.

---

## Features

### User Management

* User Registration
* Login Authentication
* Role-Based Access Control
* Email OTP Verification
* Forgot Password with OTP Reset
* Profile Photo Upload

### Vendor Management

* Add Vendor
* Edit Vendor
* Delete Vendor
* Vendor Rating Management
* Vendor Status Tracking

### RFQ Management

* Create RFQ
* Assign Vendor
* View RFQ
* Edit RFQ
* Delete RFQ
* Email Notification to Vendor

### Quotation Management

* Submit Quotation
* View Quotations
* Compare Quotations
* Vendor-wise Quotation Tracking
* Approval Workflow

### Approval Workflow

* Review Quotations
* Approve Quotations
* Reject Quotations
* Email Notification to Procurement Team

### Purchase Order Management

* Generate Purchase Orders
* View Purchase Orders
* Vendor Purchase Order Tracking
* Email Notification to Vendor

### Invoice Management

* Upload Invoice
* View Invoice List
* GST Calculation
* Tax Calculation
* Mark Invoice as Paid
* Email Notification on Invoice Upload
* Email Notification on Invoice Payment

### Reports

* Procurement Report
* Vendor Report
* Quotation Report
* Analytics Dashboard

### Activity Logs

* Track User Actions
* Audit Trail

---

## Technology Stack

### Frontend

* HTML5
* CSS3
* Bootstrap 5
* JavaScript
* jQuery
* DataTables

### Backend

* PHP 8+

### Database

* MySQL

### Email Service

* PHPMailer
* Gmail SMTP

---

## User Roles

### Admin

* Manage Vendors
* Manage RFQs
* Manage Users
* View Reports
* View Logs

### Procurement Officer

* Create RFQ
* Manage Quotations
* Generate Purchase Orders
* Manage Invoices

### Vendor

* View Assigned RFQs
* Submit Quotations
* View Purchase Orders
* Upload Invoices

### Manager

* Compare Quotations
* Approve/Reject Quotations
* View Reports

---

## Workflow

### Procurement Flow

RFQ Created
↓
Vendor Receives Email
↓
Vendor Submits Quotation
↓
Manager Reviews Quotation
↓
Quotation Approved
↓
Procurement Generates PO
↓
Vendor Receives PO Email
↓
Vendor Delivers Goods
↓
Vendor Uploads Invoice
↓
Procurement Reviews Invoice
↓
Invoice Marked Paid
↓
Vendor Receives Payment Confirmation Email

---

## Email Notifications

### RFQ Created

* Sent to Vendor

### Quotation Approved

* Sent to Procurement Team

### Purchase Order Generated

* Sent to Vendor

### Invoice Uploaded

* Sent to Procurement Team

### Invoice Paid

* Sent to Vendor

### User Registration

* OTP Verification Email

### Forgot Password

* Password Reset OTP Email

---

## Database Tables

### users

* id
* fullname
* email
* password
* role
* photo
* otp
* email_verified

### vendors

* vendor_id
* vendor_name
* email
* rating
* status

### rfq

* rfq_id
* title
* description
* quantity
* deadline
* vendor_id
* created_by

### quotations

* quotation_id
* rfq_id
* vendor_id
* price
* delivery_days
* remarks
* workflow_status

### purchase_orders

* po_id
* quotation_id
* po_number
* amount
* status

### invoices

* invoice_id
* po_id
* invoice_number
* total_amount
* gst_percentage
* tax
* grand_total
* status

### activity_logs

* log_id
* user_id
* action
* created_at

---

## Installation

### Step 1

Install XAMPP

### Step 2

Copy project to:

```
htdocs/VendorBridge
```

### Step 3

Create Database

```
vendorbridge_db
```

### Step 4

Import SQL File

```
database/vendorbridge.sql
```

### Step 5

Configure Database

File:

```
config/db.php
```

Update:

```php
$conn=mysqli_connect(
"localhost",
"root",
"",
"vendorbridge_db"
);
```

### Step 6

Install PHPMailer

```bash
composer require phpmailer/phpmailer
```

### Step 7

Configure SMTP

File:

```
mail/mail_config.php
```

Add:

```php
$mail->Host='smtp.gmail.com';
$mail->Username='your_email@gmail.com';
$mail->Password='gmail_app_password';
```

### Step 8

Run Project

```
http://localhost/VendorBridge
```

---

## Future Enhancements

* Razorpay Payment Integration
* PDF Purchase Orders
* PDF Invoices
* Vendor Performance Analytics
* Inventory Management
* Mobile Responsive Dashboard
* Multi-Level Approvals
* REST API Integration

---

