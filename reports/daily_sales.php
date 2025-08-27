<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Sales Report | SmartStock</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Chart.js (for bar chart) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .report-header {
            background: linear-gradient(45deg, #4CAF50, #8BC34A);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-box {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            text-align: center;
        }
        .chart-container {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Report Header -->
        <div class="report-header text-center">
            <h2><i class="fas fa-chart-line me-2"></i> Daily Sales Report</h2>
            <p class="mb-0">Sales summary for April 5, 2025</p>
        </div>

        <!-- Summary Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-box">
                    <h4 class="text-primary">19</h4>
                    <p class="text-muted mb-0">Total Sales</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <h4 class="text-success">R 4,872.50</h4>
                    <p class="text-muted mb-0">Total Revenue</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <h4 class="text-warning">R 256.45</h4>
                    <p class="text-muted mb-0">Avg. Sale Value</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <h4 class="text-info">142</h4>
                    <p class="text-muted mb-0">Items Sold</p>
                </div>
            </div>
        </div>

        <!-- Sales Chart -->
        <div class="row">
            <div class="col-lg-8">
                <div class="chart-container mb-4">
                    <canvas id="dailySalesChart"></canvas>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5><i class="fas fa-star text-warning me-2"></i> Top Sellers</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Milk 1L</span>
                                <span class="badge bg-success">32 sold</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Rice 5kg</span>
                                <span class="badge bg-success">28 sold</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Bread Loaf</span>
                                <span class="badge bg-success">25 sold</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Soft Drinks</span>
                                <span class="badge bg-success">19 sold</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Button -->
        <div class="text-end mt-4">
            <a href="#" class="btn btn-success px-4">
                <i class="fas fa-file-pdf me-2"></i> Export Report (PDF)
            </a>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('dailySalesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00'],
                datasets: [{
                    label: 'Sales Amount (R)',
                    data: [320, 410, 290, 520, 640, 480],
                    backgroundColor: '#4CAF50',
                    borderColor: '#388E3C',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>