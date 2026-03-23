<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo SITENAME; ?> - Vendor Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      background-color: #f4f6f9;
    }

    /* The Fixed Sidebar */
    .vendor-sidebar {
      height: 100vh;
      width: 260px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #2c3e50;
      /* Dark modern blue/gray */
      padding-top: 20px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    /* Sidebar Branding */
    .vendor-sidebar .brand {
      color: #fff;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 30px;
      padding-bottom: 10px;
      border-bottom: 1px solid #34495e;
    }

    /* Sidebar Links */
    .vendor-sidebar a {
      padding: 15px 25px;
      text-decoration: none;
      font-size: 16px;
      color: #bdc3c7;
      display: block;
      transition: 0.3s;
    }

    .vendor-sidebar a:hover,
    .vendor-sidebar a.active {
      color: #fff;
      background-color: #34495e;
      border-left: 4px solid #2ecc71;
      /* Fresh Market Green Accent */
    }

    .vendor-sidebar a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }

    /* Main Content Area */
    .vendor-main-content {
      margin-left: 260px;
      /* Must match sidebar width */
      padding: 30px;
    }
  </style>
</head>

<body>

  <div class="vendor-sidebar">
    <div class="brand">
      <i class="fas fa-store"></i> My Store
    </div>

    <a href="<?php echo URLROOT; ?>/vendors/index"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="<?php echo URLROOT; ?>/vendors/orders"><i class="fas fa-box-open"></i> Active Orders</a>
    <a href="<?php echo URLROOT; ?>/vendors/history"><i class="fas fa-history"></i> Order History</a>
    <a href="<?php echo URLROOT; ?>/vendors/products"><i class="fas fa-tags"></i> My Inventory</a>
    <a href="<?php echo URLROOT; ?>/vendors/addProduct"><i class="fas fa-plus-circle"></i> Add Product</a>

    <a href="<?php echo URLROOT; ?>/users/logout"
      style="position: absolute; bottom: 20px; width: 100%; border-top: 1px solid #34495e;">
      <i class="fas fa-sign-out-alt text-danger"></i> Logout
    </a>
  </div>

  <div class="vendor-main-content">