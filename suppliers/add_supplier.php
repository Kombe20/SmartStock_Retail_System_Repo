 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier | SmartStock</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .form-header {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .form-card {
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            border: none;
        }
        .btn-submit {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        .btn-submit:hover {
            background: #45a049;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Form Header -->
        <div class="form-header text-center">
            <h2><i class="fas fa-truck me-2"></i> Add New Supplier</h2>
            <p class="mb-0">Enter supplier details to begin product sourcing</p>
        </div>

        <!-- Supplier Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card form-card">
                    <div class="card-body p-5">
                        <form action="add_supplier_process.php" method="POST">
                            <div class="row g-4">
                                <!-- Supplier Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Supplier Name *</label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="e.g. FreshFarm Produce" required>
                                </div>

                                <!-- Contact Person -->
                                <div class="col-md-6">
                                    <label for="contact_person" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control form-control-lg" id="contact_person" name="contact_person" placeholder="John Simasiku">
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control form-control-lg" id="phone" name="phone" placeholder="+260 971 111 111" required>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="contact@supplier.com">
                                </div>

                                <!-- Address -->
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Full delivery address"></textarea>
                                </div>

                                <!-- Notes -->
                                <div class="col-12">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Delivery days, special instructions..."></textarea>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="view_suppliers.php" class="btn btn-outline-secondary me-3 px-4">
                                    <i class="fas fa-arrow-left me-2"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-submit px-5">
                                    <i class="fas fa-save me-2"></i> Save Supplier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>