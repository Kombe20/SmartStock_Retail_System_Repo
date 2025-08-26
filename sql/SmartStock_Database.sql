 
-- Create database
CREATE DATABASE IF NOT EXISTS smartstock_db;
USE smartstock_db;

-- Suppliers table
CREATE TABLE suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    contact_name VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(100),
    unit_price DECIMAL(10,2) NOT NULL,
    cost_price DECIMAL(10,2),
    reorder_level INT DEFAULT 0,
    supplier_id INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(supplier_id) ON DELETE SET NULL
);

-- Inventory table
CREATE TABLE inventory (
    inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity_in_stock INT NOT NULL DEFAULT 0,
    last_restocked DATE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Sales table
CREATE TABLE sales (
    sale_id INT AUTO_INCREMENT PRIMARY KEY,
    sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2) NOT NULL,
    cashier_name VARCHAR(100)
);

-- Sales details table
CREATE TABLE sale_details (
    sale_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    sale_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity_sold INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    line_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (sale_id) REFERENCES sales(sale_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Users table (for authentication)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    role ENUM('admin', 'cashier', 'manager') DEFAULT 'cashier',
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO suppliers (company_name, contact_name, phone, email) VALUES
('Fresh Foods Ltd', 'John Smith', '0123456789', 'john@freshfoods.com'),
('Beverage Distributors', 'Sarah Johnson', '0987654321', 'sarah@bevdist.com'),
('Dairy Producers Co.', 'Mike Wilson', '0112233445', 'mike@dairypro.co.za');

INSERT INTO products (name, description, category, unit_price, cost_price, reorder_level, supplier_id) VALUES
('Milk 1L', 'Fresh full cream milk', 'Dairy', 15.99, 10.50, 20, 3),
('Bread White', 'Sliced white bread', 'Bakery', 12.50, 7.80, 15, 1),
('Coke 500ml', 'Carbonated soft drink', 'Beverages', 14.99, 9.20, 30, 2),
('Apples 1kg', 'Fresh red apples', 'Fruits', 25.99, 18.00, 10, 1),
('Rice 2kg', 'Long grain rice', 'Grains', 45.50, 32.00, 12, 1);

INSERT INTO inventory (product_id, quantity_in_stock, last_restocked) VALUES
(1, 50, '2023-10-15'),
(2, 35, '2023-10-16'),
(3, 75, '2023-10-14'),
(4, 22, '2023-10-13'),
(5, 18, '2023-10-12');

INSERT INTO users (username, password_hash, full_name, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 'admin'),
('cashier1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jane Doe', 'cashier'),
('manager1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bob Wilson', 'manager');