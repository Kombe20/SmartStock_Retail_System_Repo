 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History | SmartStock</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .page-header {
            background: linear-gradient(45deg, #2193b0, #6dd5ed);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .table th {
            font-weight: 600;
            color: #495057;
        }
        .table-hover tbody tr:hover {
            background-color: #e8f5e9;
            cursor: pointer;
        }
        .badge-sale {
            font-size: 0.8em;
            padding: 0.4em 0.7em;
        }
        .total-footer {
            background: #f1f1f1;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header text-center">
            <h2><i class="fas fa-shopping-cart me-2"></i> Sales Transactions</h2>
            <p class="mb-0">Browse all completed sales</p>
        </div>

        <!-- Filter & Export -->
        <div class="d-flex justify-content-between mb-3">
            <form class="d-flex" style="gap: 10px;">
                <input type="date" class="form-control" value="2025-04-05">
                <button type="submit" class="btn btn-outline-secondary">Filter</button>
            </form>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-file-export me-2"></i> Export CSV
            </a>
        </div>

        <!-- Sales Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Sale #</th>
                                <th>Date & Time</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>#000023</strong></td>
                                <td>05 Apr 2025, 14:32</td>
                                <td>Alice Chanda</td>
                                <td><span class="text-success">R 245.00</span></td>
                                <td><span class="badge bg-primary badge-sale">Card</span></td>
                                <td>
                                    <a href="receipt.php?id=23" class="btn btn-sm btn-outline-info me-1" title="View Receipt">
                                        <i class="fas fa-receipt"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary" title="Refund">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#000022</strong></td>
                                <td>05 Apr 2025, 13:15</td>
                                <td>Brian Mulenga</td>
                                <td><span class="text-success">R 189.50</span></td>
                                <td><span class="badge bg-success badge-sale">Cash</span></td>
                                <td>
                                    <a href="receipt.php?id=22" class="btn btn-sm btn-outline-info me-1">
                                        <i class="fas fa-receipt"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Add more rows -->
                        </tbody>
                        <tfoot>
                            <tr class="total-footer">
                                <td colspan="3" class="text-end"><strong>Total Sales:</strong></td>
                                <td><strong>R 1,420.75</strong></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require_once 'includes/footer.php'; ?>