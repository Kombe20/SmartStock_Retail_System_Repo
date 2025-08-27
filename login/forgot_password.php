<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStock - Account Management</title>
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
            padding: 20px;
        }
        
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        
        .form-header {
            background: var(--primary);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .form-header img {
            height: 60px;
            margin-bottom: 15px;
        }
        
        .form-header h1 {
            font-size: 1.8rem;
            margin: 0;
            font-weight: 600;
        }
        
        .form-header p {
            opacity: 0.8;
            margin: 5px 0 0;
        }
        
        .form-body {
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
        
        .btn-primary {
            background: var(--secondary);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        
        .form-footer {
            text-align: center;
            padding: 15px;
            background: var(--light);
            font-size: 14px;
        }
        
        .form-footer a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
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
        
        .form-tabs {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        
        .form-tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .form-tab.active {
            border-bottom: 3px solid var(--secondary);
            color: var(--secondary);
            font-weight: 600;
        }
        
        .form-content {
            display: none;
        }
        
        .form-content.active {
            display: block;
        }
        
        .password-strength {
            height: 5px;
            margin-top: 5px;
            border-radius: 5px;
            background: #eee;
            margin-bottom: 15px;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 5px;
            transition: width 0.3s;
        }
        
        .terms-text {
            font-size: 0.85rem;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIHJ4PSIxNSIgZmlsbD0iIzM0OThkYiIvPgogIDxwYXRoIGQ9Ik0zMCAzMEg3MFY3MEgzMFYzMHoiIGZpbGw9IndoaXRlIi8+CiAgPHBhdGggZD0iTTQ1IDQ1VjY1TTQ1IDQ1SDU1TTQ1IDQ1TDU1IDM1TTU1IDY1SDM1VjU1SDQ1TTU1IDY1VjU1TTU1IDU1SDY1VjM1SDU1TTU1IDU1VjM1IiBzdHJva2U9IiMzNDk4ZGIiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cjwvc3ZnPgo=" alt="SmartStock Logo">
            <h1>SmartStock Retail</h1>
            <p>Inventory & Sales Management System</p>
        </div>
        
        <div class="form-tabs">
            <div class="form-tab active" id="forgot-tab">Reset Password</div>
            <div class="form-tab" id="register-tab">Request Account</div>
        </div>
        
        <div class="form-body">
            <!-- Forgot Password Form -->
            <div class="form-content active" id="forgot-form">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Enter your email to reset your password
                </div>
                
                <form id="forgotPasswordForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email address" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Send Reset Instructions
                    </button>
                </form>
                
                <div class="mt-3 text-center">
                    <p>Remember your password? <a href="login.php" class="switch-form">Back to Login</a></p>
                </div>
            </div>
            
            <!-- Registration Form -->
            <div class="form-content" id="register-form">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Request a new account (approval required)
                </div>
                
                <form id="registerForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="First name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Last name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="regEmail" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="regEmail" placeholder="Enter your email address" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="username" placeholder="Choose a username" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="regPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="regPassword" placeholder="Create a password" required>
                            <span class="input-group-text password-toggle" onclick="togglePassword('regPassword', 'registerEyeIcon')">
                                <i class="fas fa-eye" id="registerEyeIcon"></i>
                            </span>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="passwordStrengthBar"></div>
                        </div>
                        <div class="form-text">Use 8+ characters with a mix of letters, numbers & symbols</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
                        </div>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Request Account
                    </button>
                </form>
                
                <div class="mt-3 text-center">
                    <p>Already have an account? <a href="login.php" class="switch-form">Sign In</a></p>
                </div>
            </div>
        </div>
        
        <div class="form-footer">
            <p>&copy; 2023 SmartStock Retail System. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.getElementById('forgot-tab').addEventListener('click', function() {
            switchForm('forgot');
        });
        
        document.getElementById('register-tab').addEventListener('click', function() {
            switchForm('register');
        });
        
        function switchForm(formType) {
            // Update tabs
            document.getElementById('forgot-tab').classList.toggle('active', formType === 'forgot');
            document.getElementById('register-tab').classList.toggle('active', formType === 'register');
            
            // Update forms
            document.getElementById('forgot-form').classList.toggle('active', formType === 'forgot');
            document.getElementById('register-form').classList.toggle('active', formType === 'register');
        }
        
        // Password visibility toggle
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
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
        
        // Password strength meter
        document.getElementById('regPassword').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            let strength = 0;
            
            // Check password length
            if (password.length >= 8) strength += 25;
            
            // Check for mixed case
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 25;
            
            // Check for numbers
            if (password.match(/([0-9])/)) strength += 25;
            
            // Check for special characters
            if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/)) strength += 25;
            
            // Update strength bar
            strengthBar.style.width = strength + '%';
            
            // Update color
            if (strength <= 25) {
                strengthBar.style.backgroundColor = '#e74c3c';
            } else if (strength <= 50) {
                strengthBar.style.backgroundColor = '#f39c12';
            } else if (strength <= 75) {
                strengthBar.style.backgroundColor = '#3498db';
            } else {
                strengthBar.style.backgroundColor = '#2ecc71';
            }
        });
        
        // Form validation and submission
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            
            if (!email) {
                alert('Please enter your email address');
                return;
            }
            
            // Simulate API call
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                alert('Password reset instructions would be sent to: ' + email);
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Reset Instructions';
                submitBtn.disabled = false;
                
                // Redirect to login after successful submission
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 1000);
            }, 1500);
        });
        
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('regEmail').value;
            const username = document.getElementById('username').value;
            const password = document.getElementById('regPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            // Basic validation
            if (!firstName || !lastName || !email || !username || !password) {
                alert('Please fill in all required fields');
                return;
            }
            
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }
            
            if (!document.getElementById('terms').checked) {
                alert('You must agree to the Terms of Service');
                return;
            }
            
            // Simulate API call
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                alert('Account request submitted for approval. An administrator will review your request.');
                submitBtn.innerHTML = '<i class="fas fa-user-plus"></i> Request Account';
                submitBtn.disabled = false;
                
                // Redirect to login after successful submission
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 1000);
            }, 1500);
        });
    </script>
</body>
</html>