 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Suppliers | SmartStock</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .page-header {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .table th {
            font-weight: 600;
            color: #495057;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f8ff;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .action-btn {
            margin-right: 5px;
            transition: transform 0.2s ease;
        }
        .action-btn:hover {
            transform: scale(1.1);
        }
        .badge-custom {
            font-size: 0.85em;
            padding: 0.5em 0.8em;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header text-center">
            <h2><i class="fas fa-truck me-2"></i> Supplier Management</h2>
            <p class="mb-0">View and manage all product suppliers</p>
        </div>

        <!-- Add New Supplier Button -->
        <div class="d-flex justify-content-end mb-3">
            <a href="add_supplier.php" class="btn btn-success px-4">
                <i class="fas fa-plus-circle me-2"></i> Add New Supplier
            </a>
        </div>

        <!-- Suppliers Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Supplier Name</th>
                                <th>Contact Person</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Products Supplied</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Row 1 -->
                            <tr>
                                <td><strong>#001</strong></td>
                                <td>FreshFarm Produce</td>
                                <td>John Simasiku</td>
                                <td>+260 971 111 111</td>
                                <td>john@freshfarm.com</td>
                                <td><span class="badge bg-primary badge-custom">Milk, Eggs, Vegetables</span></td>
                                <td>
                                    <a href="edit_supplier.php?id=1" class="btn btn-sm btn-outline-primary action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger action-btn" title="Delete" onclick="confirmDelete(1)">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Sample Row 2 -->
                            <tr>
                                <td><strong>#002</strong></td>
                                <td>TechGadgets Ltd</td>
                                <td>Mary Banda</td>
                                <td>+260 972 222 222</td>
                                <td>mary@techgadgets.com</td>
                                <td><span class="badge bg-info badge-custom">Cables, Chargers</span></td>
                                <td>
                                    <a href="edit_supplier.php?id=2" class="btn btn-sm btn-outline-primary action-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger action-btn" onclick="confirmDelete(2)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Add more as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Script -->
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this supplier?")) {
                alert("Supplier deleted successfully!");
                // window.location = 'delete_supplier.php?id=' + id;
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
