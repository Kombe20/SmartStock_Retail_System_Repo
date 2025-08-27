<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Receipt #000023 | SmartStock</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #f1f1f1;
            font-family: 'Segoe UI', sans-serif;
        }
        .receipt-container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .receipt-header {
            background: #2193b0;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .receipt-body {
            padding: 2rem;
        }
        .table th {
            font-weight: 600;
            border-top: 1px solid #dee2e6;
        }
        .total-row {
            font-weight: bold;
            font-size: 1.1rem;
        }
        .footer-note {
            text-align: center;
            margin-top: 2rem;
            color: #6c757d;
            font-style: italic;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header -->
        <div class="receipt-header">
            <h3><i class="fas fa-receipt me-2"></i> OFFICIAL RECEIPT</h3>
            <p class="mb-0">SmartStock Retail System</p>
        </div>

        <!-- Body -->
        <div class="receipt-body">
            <!-- Sale Info -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Receipt #: </strong> #000023</p>
                    <p><strong>Date: </strong> April 5, 2025</p>
                    <p><strong>Time: </strong> 14:32</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Cashier: </strong> Grace Mwansa</p>
                    <p><strong>Payment: </strong> <span class="badge bg-primary">Card</span></p>
                </div>
            </div>

            <!-- Items Table -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Milk 1L</td>
                            <td>2</td>
                            <td>R 15.50</td>
                            <td>R 31.00</td>
                        </tr>
                        <tr>
                            <td>Rice 5kg</td>
                            <td>1</td>
                            <td>R 85.00</td>
                            <td>R 85.00</td>
                        </tr>
                        <tr>
                            <td>Bread Loaf</td>
                            <td>1</td>
                            <td>R 12.00</td>
                            <td>R 12.00</td>
                        </tr>
                        <tr>
                            <td>Soft Drinks (6pk)</td>
                            <td>2</td>
                            <td>R 45.00</td>
                            <td>R 90.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                            <td><strong>R 218.00</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Footer Note -->
            <div class="footer-note">
                <p><i class="fas fa-thumbs-up me-1"></i> Thank you for shopping with SmartStock!</p>
                <small>Returns accepted within 7 days with receipt.</small>
            </div>

            <!-- Print & Back Buttons -->
            <div class="text-center mt-3 no-print">
                <a href="view_sales.php" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i> Back to Sales
                </a>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print me-2"></i> Print Receipt
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>