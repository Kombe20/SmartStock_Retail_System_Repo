 
<?php
require_once '../includes/header.php';
require_once '../includes/db_connection.php';
require_once '../config/auth.php';

requireRole('admin');

if (!isset($_GET['id'])) {
    header("Location: view_products.php");
    exit();
}

$product_id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE product_id = $product_id")->fetch_assoc();
$suppliers = $conn->query("SELECT supplier_id, company_name FROM suppliers ORDER BY company_name");

if (!$product) {
    header("Location: view_products.php?error=Product not found");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $unit_price = $_POST['unit_price'];
    $cost_price = $_POST['cost_price'];
    $reorder_level = $_POST['reorder_level'];
    $supplier_id = $_POST['supplier_id'];
    
    // Handle image upload
    $image_update = '';
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $target_dir = "../uploads/products/";
        $imageFileType = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
        $filename = "product_" . time() . "." . $imageFileType;
        $target_file = $target_dir . $filename;
        
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            $image_update = ", image_path = '$filename'";
            
            // Delete old image if exists
            if (!empty($product['image_path'])) {
                @unlink($target_dir . $product['image_path']);
            }
        }
    }
    
    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, category = ?, unit_price = ?, cost_price = ?, reorder_level = ?, supplier_id = ? $image_update WHERE product_id = ?");
    $stmt->bind_param("sssddiii", $name, $description, $category, $unit_price, $cost_price, $reorder_level, $supplier_id, $product_id);
    
    if ($stmt->execute()) {
        header("Location: view_products.php?message=Product updated successfully");
        exit();
    } else {
        $error = "Error updating product: " . $conn->error;
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Edit Product</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" value="<?php echo $product['category']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?php echo $product['description']; ?></textarea>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Unit Price (R)</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" value="<?php echo $product['unit_price']; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cost Price (R)</label>
                            <input type="number" step="0.01" name="cost_price" class="form-control" value="<?php echo $product['cost_price']; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Reorder Level</label>
                            <input type="number" name="reorder_level" class="form-control" value="<?php echo $product['reorder_level']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Supplier</label>
                            <select name="supplier_id" class="form-select" required>
                                <option value="">Select Supplier</option>
                                <?php while ($supplier = $suppliers->fetch_assoc()): ?>
                                <option value="<?php echo $supplier['supplier_id']; ?>" <?php echo ($supplier['supplier_id'] == $product['supplier_id']) ? 'selected' : ''; ?>>
                                    <?php echo $supplier['company_name']; ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="product_image" class="form-control" accept="image/*">
                            <?php if (!empty($product['image_path'])): ?>
                            <div class="mt-2">
                                <img src="../uploads/products/<?php echo $product['image_path']; ?>" alt="Product Image" height="50">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <a href="view_products.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>