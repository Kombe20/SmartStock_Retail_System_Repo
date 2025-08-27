<?php
session_start();

// Redirect to login if not authenticated
// if (!isset($_SESSION['user_id'])) {
//     header("Location: /SmartStock_Retail_System/login/login.php");
//     exit();
// }

// Optional: Set page title from individual pages
$page_title = $page_title ?? 'SmartStock Retail System';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> | SmartStock</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS (from project root) -->
    <link rel="stylesheet" href="/SmartStock_Retail_System/css/style.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            margin: 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.3rem;
        }

        .navbar-brand img {
            margin-right: 8px;
        }

        .nav-link {
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #667eea !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #667eea;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .navbar-text a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .navbar-text a:hover {
            text-decoration: underline;
        }

        .container {
            padding-top: 20px;
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            .navbar-text {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <!-- Logo & Brand -->
            <a class="navbar-brand d-flex align-items-center" href="/SmartStock_Retail_System/dashboard.php">
                <img src="/SmartStock_Retail_System/assets/images/logo.png" alt="SmartStock Logo" height="30" class="me-2">
                <span>SmartStock</span>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php') ? 'active' : ''; ?>"
                           href="/SmartStock_Retail_System/dashboard.php">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($_SERVER['SCRIPT_NAME'], 'products/') !== false) ? 'active' : ''; ?>"
                           href="/SmartStock_Retail_System/products/view_products.php">
                            <i class="fas fa-cubes me-1"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($_SERVER['SCRIPT_NAME'], 'sales/record_sale.php') !== false) ? 'active' : ''; ?>"
                           href="/SmartStock_Retail_System/sales/record_sale.php">
                            <i class="fas fa-shopping-cart me-1"></i> Point of Sale
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($_SERVER['SCRIPT_NAME'], 'reports/') !== false) ? 'active' : ''; ?>"
                           href="/SmartStock_Retail_System/reports/daily_sales.php">
                            <i class="fas fa-chart-line me-1"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($_SERVER['SCRIPT_NAME'], 'suppliers/') !== false) ? 'active' : ''; ?>"
                           href="/SmartStock_Retail_System/suppliers/view_suppliers.php">
                            <i class="fas fa-truck me-1"></i> Suppliers
                        </a>
                    </li>
                </ul>

                <!-- User Info & Logout -->
                <div class="navbar-text d-flex align-items-center">
                    <span class="me-3">
                        <i class="fas fa-user-circle me-1"></i>
                        Welcome, <strong><?php echo htmlspecialchars($_SESSION['full_name'] ?? 'User'); ?></strong>
                    </span>
                    <a href="/SmartStock_Retail_System/login/logout.php" class="text-white text-decoration-none">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Container -->
    <div class="container mt-4">