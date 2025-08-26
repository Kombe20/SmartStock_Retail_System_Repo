 
<?php
require_once '../includes/db_connection.php';

if (!isset($_GET['id'])) {
    header("Location: view_products.php");
    exit();
}

$product_id = $_GET['id'];

// Check if product exists
$product = $conn->query("SELECT * FROM products WHERE product_id = $product_id")->fetch_assoc();

if (!$product) {
    header("Location: view_products.php?error=Product not found");
    exit();
}

// Delete product
$stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);

if ($stmt->execute()) {
    header("Location: view_products.php?message=Product deleted successfully");
} else {
    header("Location: view_products.php?error=Error deleting product");
}

exit();
?>