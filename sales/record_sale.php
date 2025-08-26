<?php
require_once '../includes/header.php';
require_once '../includes/db_connection.php';

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    $product = $conn->query("SELECT * FROM products WHERE product_id = $product_id")->fetch_assoc();
    $inventory = $conn->query("SELECT quantity_in_stock FROM inventory WHERE product_id = $product_id")->fetch_assoc();
    
    if ($quantity <= $inventory['quantity_in_stock']) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                'price' => $product['unit_price'],
                'quantity' => $quantity
            ];
        }
    } else {
        $error = "Not enough stock available. Only " . $inventory['quantity_in_stock'] . " items in stock.";
    }
}

// Remove item from cart
if (isset($_GET['remove_from_cart'])) {
    $product_id = $_GET['remove_from_cart'];
    unset($_SESSION['cart'][$product_id]);
    header("Location: record_sale.php");
    exit();
}

// Process sale
if (isset($_POST['process_sale'])) {
    $total_amount = 0;
    
    // Calculate total
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }
    
    // Insert sale record
    $cashier_name = $_SESSION['full_name'];
    $stmt = $conn->prepare("INSERT INTO sales (total_amount, cashier_name) VALUES (?, ?)");
    $stmt->bind_param("ds", $total_amount, $cashier_name);
    $stmt->execute();
    $sale_id = $conn->insert_id;
    
    // Insert sale details and update inventory
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $line_total = $item['price'] * $item['quantity'];
        
        // Insert sale detail
        $stmt = $conn->prepare("INSERT INTO sale_details (sale_id, product_id, quantity_sold, unit_price, line_total) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiidd", $sale_id, $product_id, $item['quantity'], $item['price'], $line_total);
        $stmt->execute();
        
        // Update inventory
        $conn->query("UPDATE inventory SET quantity_in_stock = quantity_in_stock - {$item['quantity']} WHERE product_id = $product_id");
    }
    
    // Clear cart
    $_SESSION['cart'] = [];
    
    header("Location: receipt.php?sale_id=$sale_id");
    exit();
}

// Fetch products for selection
$products = $conn->query("SELECT p.*, i.quantity_in_stock FROM products p JOIN inventory i ON p.product_id = i.product_id WHERE i.quantity_in_stock > 0 ORDER BY p.name");
?>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Point of Sale</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Select Product</label>
                        <select name="product_id" class="form-select" required>
                            <option value="">Choose a product...</option>
                            <?php while ($product = $products->fetch_assoc()): ?>
                            <option value="<?php echo $product['product_id']; ?>">
                                <?php echo $product['name']; ?> - R<?php echo number_format($product['unit_price'], 2); ?> (Stock: <?php echo $product['quantity_in_stock']; ?>)
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                    </div>
                </form>
                
                <hr>
                
                <h5>Current Sale</h5>
                <?php if (empty($_SESSION['cart'])): ?>
                <p class="text-muted">No items in cart</p>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $cart_total = 0;
                            foreach ($_SESSION['cart'] as $product_id => $item): 
                                $item_total = $item['price'] * $item['quantity'];
                                $cart_total += $item_total;
                            ?>
                            <tr>
                                <td><?php echo $item['name']; ?></td>
                                <td>R <?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>R <?php echo number_format($item_total, 2); ?></td>
                                <td>
                                    <a href="record_sale.php?remove_from_cart=<?php echo $product_id; ?>" class="btn btn-sm btn-outline-danger">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <th colspan="3">Total</th>
                                <th colspan="2">R <?php echo number_format($cart_total, 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <form method="POST">
                    <button type="submit" name="process_sale" class="btn btn-success btn-lg">Process Sale</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Quick Product Lookup</h5>
            </div>
            <div class="card-body">
                <input type="text" id="productSearch" class="form-control mb-3" placeholder="Search products...">
                <div id="productResults" class="list-group"></div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>