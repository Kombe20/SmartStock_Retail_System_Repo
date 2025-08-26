 
<?php
require_once '../includes/header.php';
require_once '../includes/db_connection.php';
require_once '../config/auth.php';

requireRole('admin');

$suppliers = $conn->query("SELECT supplier_id, company_name FROM suppliers ORDER BY company_name");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $unit_price = $_POST['unit_price'];
    $cost_price = $_POST['cost_price'];
    $reorder_level = $_POST['reorder_level'];
    $supplier_id = $_POST['supplier_id'];
    
    // Handle image upload
    $image_path = '';
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $target_dir = "../uploads/products/";
        $imageFileType = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
        $filename = "product_" . time() . "." . $imageFileType;
        $target_file = $target_dir . $filename;
        
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            $image_path = $filename;
        }
    }
    
    // Insert product
    $stmt = $conn->prepare("INSERT INTO products (name, description, category, unit_price, cost_price, reorder_level, supplier_id, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddiis", $name, $description, $category, $unit_price, $cost_price, $reorder_level, $supplier_id, $image_path);
    
    if ($stmt->execute()) {
        $product_id = $conn->insert_id;
        
        // Initialize inventory
        $conn->query("INSERT INTO inventory (product_id, quantity_in_stock) VALUES ($product_id, 0)");
        
        header("Location: view_products.php?message=Product added successfully");
        exit();
    } else {
        $error = "Error adding product: " . $conn->error;
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Add New Product</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Unit Price (R)</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cost Price (R)</label>
                            <input type="number" step="0.01" name="cost_price" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Reorder Level</label>
                            <input type="number" name="reorder_level" class="form-control" value="5" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Supplier</label>
                            <select name="supplier_id" class="form-select" required>
                                <option value="">Select Supplier</option>
                                <?php while ($supplier = $suppliers->fetch_assoc()): ?>
                                <option value="<?php echo $supplier['supplier_id']; ?>">
                                    <?php echo $supplier['company_name']; ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="product_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                        <a href="view_products.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>