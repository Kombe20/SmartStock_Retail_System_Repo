<?php
session_start();
require_once '../includes/db_connection.php';

// Function to log login attempts
function logLoginAttempt($conn, $username, $success, $ip_address) {
    $stmt = $conn->prepare("INSERT INTO login_attempts (username, success, ip_address) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $username, $success, $ip_address);
    $stmt->execute();
}

// Initialize variables
$error = '';
$success = '';

// Check if user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: ../dashboard.php");
    exit();
}

// Check for remember me cookie
if (isset($_COOKIE['remember_token']) && !isset($_SESSION['logged_in'])) {
    $token = $_COOKIE['remember_token'];
    
    $stmt = $conn->prepare("SELECT user_id, username, full_name, role FROM users WHERE remember_token = ? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Save user data in session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;
        $_SESSION['login_time'] = time();
        
        header("Location: ../dashboard.php");
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;
    
    // Get user IP address
    $ip_address = $_SERVER['REMOTE_ADDR'];
    
    $stmt = $conn->prepare("SELECT user_id, username, password_hash, full_name, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify password with password_hash()
        if (password_verify($password, $user['password_hash'])) {
            // Log successful attempt
            logLoginAttempt($conn, $username, 1, $ip_address);
            
            // Save user data in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            $_SESSION['login_time'] = time();
            
            // Handle remember me functionality
            if ($remember) {
                // Generate a random token
                $token = bin2hex(random_bytes(32));
                $expiry = time() + (30 * 24 * 60 * 60); // 30 days
                
                // Store token in database
                $stmt = $conn->prepare("UPDATE users SET remember_token = ?, token_expiry = ? WHERE user_id = ?");
                $stmt->bind_param("ssi", $token, date('Y-m-d H:i:s', $expiry), $user['user_id']);
                $stmt->execute();
                
                // Set cookie
                setcookie('remember_token', $token, $expiry, '/');
            }
            
            // Redirect to dashboard
            header("Location: ../dashboard.php");
            exit();
        } else {
            // Log failed attempt
            logLoginAttempt($conn, $username, 0, $ip_address);
            $error = "Invalid username or password.";
        }
    } else {
        // Log failed attempt (user doesn't exist)
        logLoginAttempt($conn, $username, 0, $ip_address);
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartStock Retail System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            background: var(--primary);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .login-header img {
            height: 60px;
            margin-bottom: 15px;
        }
        
        .login-header h1 {
            font-size: 1.8rem;
            margin: 0;
            font-weight: 600;
        }
        
        .login-header p {
            opacity: 0.8;
            margin: 5px 0 0;
        }
        
        .login-body {
            padding: 25px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 2px solid #e1e5eb;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .input-group-text {
            background: white;
            border: 2px solid #e1e5eb;
            border-right: none;
            border-radius: 8px 0 0 8px;
        }
        
        .btn-login {
            background: var(--secondary);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        
        .social-login {
            margin: 20px 0;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .social-btn i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .btn-google {
            background: #fff;
            color: #757575;
            border: 1px solid #ddd;
        }
        
        .btn-google:hover {
            background: #f5f5f5;
            color: #757575;
        }
        
        .btn-facebook {
            background: #3b5998;
            color: white;
        }
        
        .btn-facebook:hover {
            background: #344e86;
            color: white;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        
        .divider span {
            padding: 0 10px;
            color: #777;
            font-size: 14px;
        }
        
        .login-footer {
            text-align: center;
            padding: 15px;
            background: var(--light);
            font-size: 14px;
        }
        
        .login-footer a {
            color: var(--secondary);
            text-decoration: none;
        }
        
        .password-toggle {
            cursor: pointer;
            background: white;
            border: 2px solid #e1e5eb;
            border-left: none;
            border-radius: 0 8px 8px 0;
        }
        
        .alert {
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 15px;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .form-check-input:checked {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIxNSIgZmlsbD0iIzM0OThkYiIvPgogIDxwYXRoIGQ9Ik0zMCAzMEg3MFY3MEgzMFYzMHoiIGZpbGw9IndoaXRlIi8+CiAgPHBhdGggZD0iTTQ1IDQ1VjY1TTQ1IDQ1SDU1TTQ1IDQ1TDU1IDM1TTU1IDY1SDM1VjU1SDQ1TTU1IDY1VjU1TTU1IDU1SDY1VjM1SDU1TTU1IDU1VjM1IiBzdHJva2U9IiMzNDk4ZGIiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cjwvc3ZnPgo=" alt="SmartStock Logo">
            <h1>SmartStock Retail</h1>
            <p>Inventory & Sales Management System</p>
        </div>
        
        <div class="login-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Please sign in to access your account
            </div>
            
            <form id="loginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="username" placeholder="Enter your username" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                        <span class="input-group-text password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                
                <div class="remember-forgot">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="forgot_password.php" class="text-decoration-none">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>
            
            <div class="divider">
                <span>Or continue with</span>
            </div>
            
            <div class="social-login">
                <a href="#" class="social-btn btn-google">
                    <i class="fab fa-google"></i> Sign in with Google
                </a>
                <a href="#" class="social-btn btn-facebook">
                    <i class="fab fa-facebook-f"></i> Sign in with Facebook
                </a>
            </div>
        </div>
        
        <div class="login-footer">
            <p>Don't have an account? <a href="#">Contact administrator</a></p>
            <p class="text-muted">&copy; 2023 SmartStock Retail System</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.querySelector('.password-toggle i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
        
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Simple validation
            if (!username || !password) {
                alert('Please fill in all fields');
                return;
            }
            
            // Simulate login process
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                alert('Login functionality would connect to your backend system');
                submitBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Sign In';
                submitBtn.disabled = false;
            }, 1500);
        });
    </script>
</body>
</html>