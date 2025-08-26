 
<?php
require_once '../includes/header.php';
require_once '../includes/db_connection.php';

// Handle product deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    header("Location: view_products.php?message=Product deleted successfully");
    exit();
}

// Fetch all products with their inventory
$products = $conn->query("
    SELECT p.*, i.quantity_in_stock, s.company_name 
    FROM products p 
    LEFT JOIN inventory i ON p.product_id = i.product_id 
    LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id
    ORDER BY p.name
");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Product Management</h2>
    <a href="add_product.php" class="btn btn-primary">Add New Product</a>
</div>

<?php if (isset($_GET['message'])): ?>
<div class="alert alert-success"><?php echo $_GET['message']; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Supplier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $product['product_id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['category']; ?></td>
                        <td>R <?php echo number_format($product['unit_price'], 2); ?></td>
                        <td>
                            <span class="<?php echo ($product['quantity_in_stock'] <= $product['reorder_level']) ? 'text-danger fw-bold' : ''; ?>">
                                <?php echo $product['quantity_in_stock']; ?>
                            </span>
                        </td>
                        <td><?php echo $product['company_name']; ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="view_products.php?delete_id=<?php echo $product['product_id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>