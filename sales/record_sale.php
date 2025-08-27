<?php
$page_title = "Point of Sale";
require_once '../includes/header.php';
require_once '../includes/db_connection.php';
?>

<style>
    body {
        background: #f8f9fa;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
    }

    .pos-container {
        display: flex;
        gap: 20px;
        min-height: calc(100vh - 180px);
    }

    .product-search {
        flex: 1;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 20px;
    }

    .cart-area {
        flex: 1;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 20px;
    }

    .search-input {
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 1.1rem;
        border: 2px solid #e9ecef;
    }

    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.2);
    }

    .product-item {
        padding: 12px;
        border: 1px solid #eee;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .product-item:hover {
        background: #f1f8ff;
        border-color: #667eea;
        transform: translateX(4px);
    }

    .cart-header {
        background: #2193b0;
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
    }

    .cart-item {
        padding: 10px 0;
        border-bottom: 1px dashed #eee;
    }

    .remove-btn {
        color: #dc3545;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.1rem;
    }

    .total-row {
        font-size: 1.2rem;
        font-weight: bold;
        color: #2193b0;
    }

    .action-buttons {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }

    .btn-pos {
        padding: 12px 20px;
        font-weight: 600;
        border-radius: 8px;
        font-size: 1.1rem;
    }

    .btn-finalize {
        background: #4CAF50;
        color: white;
        border: none;
    }

    .btn-finalize:hover {
        background: #45a049;
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
    }

    .btn-cancel:hover {
        background: #5a6268;
    }

    .no-items {
        color: #6c757d;
        font-style: italic;
    }
</style>

<div class="pos-container">
    <!-- Left: Product Search -->
    <div class="product-search">
        <h4><i class="fas fa-search me-2"></i> Search Products</h4>
        <input type="text" id="productSearch" class="form-control search-input" placeholder="Scan barcode or type product name...">

        <div class="mt-3" id="productResults">
            <!-- Sample Products (In real app: populated via AJAX/PHP) -->
            <div class="product-item d-flex justify-content-between align-items-center" onclick="addToCart(1, 'Milk 1L', 15.50)">
                <div>
                    <strong>Milk 1L</strong><br>
                    <small class="text-muted">Dairy</small>
                </div>
                <span class="badge bg-primary">R 15.50</span>
            </div>

            <div class="product-item d-flex justify-content-between align-items-center mt-2" onclick="addToCart(2, 'Rice 5kg', 85.00)">
                <div>
                    <strong>Rice 5kg</strong><br>
                    <small class="text-muted">Grocery</small>
                </div>
                <span class="badge bg-primary">R 85.00</span>
            </div>

            <div class="product-item d-flex justify-content-between align-items-center mt-2" onclick="addToCart(3, 'Bread Loaf', 12.00)">
                <div>
                    <strong>Bread Loaf</strong><br>
                    <small class="text-muted">Bakery</small>
                </div>
                <span class="badge bg-primary">R 12.00</span>
            </div>
        </div>
    </div>

    <!-- Right: Cart -->
    <div class="cart-area">
        <div class="cart-header text-center">
            <i class="fas fa-shopping-cart me-2"></i> Sale Cart
            <span id="itemCount" class="badge bg-light text-dark ms-2">0 Items</span>
        </div>

        <div class="mt-3" id="cartItems">
            <p class="text-center no-items">No items in cart</p>
        </div>

        <div class="mt-4 border-top pt-3 text-end total-row">
            Total: <strong id="cartTotal">R 0.00</strong>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button type="button" class="btn btn-cancel btn-pos w-50" onclick="clearCart()">
                <i class="fas fa-trash me-2"></i> Clear
            </button>
            <button type="button" class="btn btn-finalize btn-pos w-50" onclick="finalizeSale()">
                <i class="fas fa-check-circle me-2"></i> Finalize Sale
            </button>
        </div>
    </div>
</div>

<!-- Finalize Sale Modal -->
<div class="modal fade" id="finalizeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-receipt me-2"></i> Finalize Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Total Amount:</strong> <span id="modalTotal" class="text-success">R 0.00</span></p>
                <div class="mb-3">
                    <label for="paymentMethod" class="form-label">Payment Method</label>
                    <select class="form-select" id="paymentMethod">
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                        <option value="Mobile Money">Mobile Money</option>
                    </select>
                </div>
                <div class="alert alert-info small mb-0">
                    <i class="fas fa-info-circle me-2"></i> Receipt will be generated after saving.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="saveSale()">Save & Print Receipt</button>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>

<script>
    let cart = [];
    const taxRate = 0; // No tax in this system

    // Add product to cart
    function addToCart(id, name, price) {
        const existing = cart.find(item => item.id === id);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ id, name, price, qty: 1 });
        }
        updateCart();
        document.getElementById('productSearch').value = '';
        document.getElementById('productResults').innerHTML = '';
    }

    // Update cart display and total
    function updateCart() {
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');
        const itemCount = document.getElementById('itemCount');

        if (cart.length === 0) {
            cartItems.innerHTML = '<p class="text-center no-items">No items in cart</p>';
            cartTotal.textContent = 'R 0.00';
            itemCount.textContent = '0 Items';
            return;
        }

        let html = '';
        let total = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.qty;
            total += itemTotal;
            html += `
            <div class="cart-item">
                <div class="row">
                    <div class="col-7">
                        <strong>${item.name}</strong><br>
                        <small>R ${item.price.toFixed(2)} × ${item.qty}</small>
                    </div>
                    <div class="col-3 text-end">
                        <strong>R ${itemTotal.toFixed(2)}</strong>
                    </div>
                    <div class="col-2 text-end">
                        <button class="remove-btn" onclick="removeItem(${item.id})">×</button>
                    </div>
                </div>
            </div>`;
        });

        cartItems.innerHTML = html;
        cartTotal.textContent = 'R ' + total.toFixed(2);
        itemCount.textContent = `${cart.length} Items`;
    }

    // Remove item from cart
    function removeItem(id) {
        cart = cart.filter(item => item.id !== id);
        updateCart();
    }

    // Clear entire cart
    function clearCart() {
        if (confirm("Are you sure you want to clear the cart?")) {
            cart = [];
            updateCart();
        }
    }

    // Show finalize modal
    function finalizeSale() {
        if (cart.length === 0) {
            alert("Your cart is empty!");
            return;
        }
        document.getElementById('modalTotal').textContent = document.getElementById('cartTotal').textContent;
        const modal = new bootstrap.Modal(document.getElementById('finalizeModal'));
        modal.show();
    }

    // Save sale and redirect to receipt
    function saveSale() {
        const paymentMethod = document.getElementById('paymentMethod').value;
        const total = document.getElementById('cartTotal').textContent.replace('R ', '');

        // In real app: Send to PHP via AJAX to save in DB
        // For now: Simulate redirect to receipt
        alert("Sale saved successfully!");
        const modal = bootstrap.Modal.getInstance(document.getElementById('finalizeModal'));
        modal.hide();

        // Simulate saving and redirect to receipt
        setTimeout(() => {
            window.location.href = 'receipt.php?temp_sale=1&amount=' + total + '&payment=' + encodeURIComponent(paymentMethod);
        }, 500);
    }

    // Live search simulation
    document.getElementById('productSearch').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        if (query === '') {
            document.getElementById('productResults').innerHTML = '';
            return;
        }

        const products = [
            { id: 1, name: 'Milk 1L', category: 'Dairy', price: 15.50 },
            { id: 2, name: 'Rice 5kg', category: 'Grocery', price: 85.00 },
            { id: 3, name: 'Bread Loaf', category: 'Bakery', price: 12.00 },
            { id: 4, name: 'Soft Drinks', category: 'Beverage', price: 45.00 }
        ];

        const results = products.filter(p => p.name.toLowerCase().includes(query));
        let html = '';
        results.forEach(p => {
            html += `
            <div class="product-item d-flex justify-content-between align-items-center mt-2" onclick="addToCart(${p.id}, '${p.name}', ${p.price})">
                <div>
                    <strong>${p.name}</strong><br>
                    <small class="text-muted">${p.category}</small>
                </div>
                <span class="badge bg-primary">R ${p.price.toFixed(2)}</span>
            </div>`;
        });

        document.getElementById('productResults').innerHTML = html || '<p class="text-muted text-center mt-2">No products found</p>';
    });
</script>