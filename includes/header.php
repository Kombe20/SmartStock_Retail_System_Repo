 
<?php
session_start();
// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStock Retail System</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">
                <img src="../assets/images/logo.png" alt="SmartStock Logo" height="30" class="d-inline-block align-text-top">
                SmartStock
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../products/view_products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../sales/record_sale.php">Point of Sale</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../reports/daily_sales.php">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../suppliers/view_suppliers.php">Suppliers</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Welcome, <?php echo $_SESSION['full_name']; ?> | 
                    <a href="../login/logout.php" class="text-light">Logout</a>
                </span>
            </div>
        </div>
    </nav>
    <div class="container mt-4">