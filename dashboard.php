 
<?php
require_once 'includes/header.php';
require_once 'includes/db_connection.php';

// Get counts for dashboard
$product_count = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$low_stock_count = $conn->query("SELECT COUNT(*) FROM inventory WHERE quantity_in_stock <= (SELECT reorder_level FROM products WHERE products.product_id = inventory.product_id)")->fetch_row()[0];
$today_sales = $conn->query("SELECT COUNT(*) FROM sales WHERE DATE(sale_date) = CURDATE()")->fetch_row()[0];
$today_revenue = $conn->query("SELECT COALESCE(SUM(total_amount), 0) FROM sales WHERE DATE(sale_date) = CURDATE()")->fetch_row()[0];
?>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $product_count; ?></h5>
                <p class="card-text">Total Products</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $low_stock_count; ?></h5>
                <p class="card-text">Low Stock Items</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $today_sales; ?></h5>
                <p class="card-text">Today's Sales</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">R <?php echo number_format($today_revenue, 2); ?></h5>
                <p class="card-text">Today's Revenue</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="sales/record_sale.php" class="btn btn-primary">Record New Sale</a>
                    <a href="products/view_products.php" class="btn btn-outline-primary">Manage Products</a>
                    <a href="reports/daily_sales.php" class="btn btn-outline-primary">View Reports</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Recent Sales</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Sale ID</th>
                                <th>Time</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $recent_sales = $conn->query("SELECT sale_id, sale_date, total_amount FROM sales ORDER BY sale_date DESC LIMIT 5");
                            while ($sale = $recent_sales->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $sale['sale_id']; ?></td>
                                <td><?php echo date('H:i', strtotime($sale['sale_date'])); ?></td>
                                <td>R <?php echo number_format($sale['total_amount'], 2); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>