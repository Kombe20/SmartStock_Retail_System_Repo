<?php
$page_title = "Add Supplier"; // Optional: Set dynamic title
require_once 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SmartStock</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Card Animations */
        .stat-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 5px;
            background: currentColor;
        }

        .stat-card .card-body {
            padding: 1.5rem;
        }

        .stat-icon {
            font-size: 2rem;
            opacity: 0.2;
            position: absolute;
            right: 15px;
            top: 15px;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #6c757d;
        }

        /* Gradient Backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }
        .bg-gradient-warning {
            background: linear-gradient(45deg, #f7b731, #fc4a1a);
            color: white;
        }
        .bg-gradient-success {
            background: linear-gradient(45deg, #4CAF50, #8BC34A);
            color: white;
        }
        .bg-gradient-info {
            background: linear-gradient(45deg, #2193b0, #6dd5ed);
            color: white;
        }

        /* Quick Actions */
        .quick-action-btn {
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 12px 0;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .quick-action-btn:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        /* Recent Sales Table */
        .table th {
            font-weight: 600;
            color: #495057;
            border-top: none;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        /* Fade-in Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Dashboard</h2>
        <span class="text-muted small">Welcome back, John Doe!</span>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Products -->
        <div class="col-md-3 col-sm-6 animate-fade-in delay-1">
            <div class="card stat-card bg-gradient-primary text-white">
                <div class="card-body">
                    <i class="fas fa-box-open stat-icon"></i>
                    <div class="stat-value">142</div>
                    <div class="stat-label">Total Products</div>
                </div>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="col-md-3 col-sm-6 animate-fade-in delay-2">
            <div class="card stat-card bg-gradient-warning text-white">
                <div class="card-body">
                    <i class="fas fa-exclamation-triangle stat-icon"></i>
                    <div class="stat-value">8</div>
                    <div class="stat-label">Low Stock Items</div>
                </div>
            </div>
        </div>

        <!-- Today's Sales -->
        <div class="col-md-3 col-sm-6 animate-fade-in delay-3">
            <div class="card stat-card bg-gradient-success text-white">
                <div class="card-body">
                    <i class="fas fa-shopping-cart stat-icon"></i>
                    <div class="stat-value">19</div>
                    <div class="stat-label">Today's Sales</div>
                </div>
            </div>
        </div>

        <!-- Today's Revenue -->
        <div class="col-md-3 col-sm-6 animate-fade-in delay-4">
            <div class="card stat-card bg-gradient-info text-white">
                <div class="card-body">
                    <i class="fas fa-coins stat-icon"></i>
                    <div class="stat-value">R 4,872.50</div>
                    <div class="stat-label">Today's Revenue</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Sales -->
    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-lg-6 animate-fade-in delay-1">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="fas fa-bolt text-warning"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="sales/record_sale.php" class="btn btn-primary quick-action-btn">
                            <i class="fas fa-plus-circle me-2"></i> Record New Sale
                        </a>
                        <a href="products/view_products.php" class="btn btn-outline-primary quick-action-btn">
                            <i class="fas fa-cubes me-2"></i> Manage Products
                        </a>
                        <a href="suppliers/view_suppliers.php" class="btn btn-outline-primary quick-action-btn">
                            <i class="fas fa-truck me-2"></i> Manage Suppliers
                        </a>
                        <a href="reports/daily_sales.php" class="btn btn-outline-primary quick-action-btn">
                            <i class="fas fa-chart-line me-2"></i> View Sales Report
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Sales -->
        <div class="col-lg-6 animate-fade-in delay-2">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-clock text-info"></i> Recent Sales</h5>
                    <a href="sales/view_sales.php" class="small text-primary text-decoration-none">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sale #</th>
                                    <th>Time</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>#000023</strong></td>
                                    <td>14:32</td>
                                    <td><span class="badge bg-success">R 245.00</span></td>
                                    <td><span class="badge bg-primary">Card</span></td>
                                </tr>
                                <tr>
                                    <td><strong>#000022</strong></td>
                                    <td>13:15</td>
                                    <td><span class="badge bg-success">R 189.50</span></td>
                                    <td><span class="badge bg-success">Cash</span></td>
                                </tr>
                                <tr>
                                    <td><strong>#000021</strong></td>
                                    <td>11:48</td>
                                    <td><span class="badge bg-success">R 632.20</span></td>
                                    <td><span class="badge bg-info">Mobile</span></td>
                                </tr>
                                <tr>
                                    <td><strong>#000020</strong></td>
                                    <td>10:22</td>
                                    <td><span class="badge bg-success">R 98.00</span></td>
                                    <td><span class="badge bg-success">Cash</span></td>
                                </tr>
                                <tr>
                                    <td><strong>#000019</strong></td>
                                    <td>09:10</td>
                                    <td><span class="badge bg-success">R 412.75</span></td>
                                    <td><span class="badge bg-primary">Card</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-5">
        <small class="text-muted">
            <i class="fas fa-copyright"></i> 2025 SmartStock Retail System. All rights reserved.
        </small>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php require_once 'includes/footer.php'; ?>