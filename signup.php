<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // Something was posted
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Input validation
    if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && $password === $confirm_password && filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        // Check if email already exists
        $check_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $check_result = mysqli_query($con, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            $error_message = "Email address already in use!";
        } else {
            // Save to database
            $user_id = random_num(20);
            $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Safely hash the password

            $query = "INSERT INTO users (user_id, first_name, last_name, email, password) VALUES ('$user_id', '$first_name', '$last_name', '$email', '$hashed_password')";

            if(mysqli_query($con, $query)) {
                // Set success message in session and redirect
                $_SESSION['signup_success'] = true;
                header("Location: login.php");
                die;
            } else {
                $error_message = "Registration failed. Please try again!";
            }
        }
    }
    else
    {
        if($password !== $confirm_password) {
            $error_message = "Passwords do not match!";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Please enter a valid email address!";
        } else {
            $error_message = "Please fill in all fields correctly!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Smart Environment Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --accent: #22c55e;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #1e293b;
            --card-bg: rgba(255, 255, 255, 0.85);
        }

        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 0;
        }

        .signup-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease;
        }

        .signup-card:hover {
            transform: translateY(-5px);
        }

        .signup-header {
            background-color: var(--primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 1.5rem;
            position: relative;
        }

        .signup-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 5px;
            background-color: white;
            border-radius: 5px;
        }

        .signup-body {
            padding: 2rem;
        }

        .input-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 640px) {
            .input-row {
                flex-direction: column;
                gap: 1.5rem;
            }
        }

        .input-group {
            position: relative;
            flex: 1;
        }

        .single-input {
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
            outline: none;
        }

        .input-group i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
        }

        .input-group input:focus + i {
            color: var(--primary);
        }

        .input-group label {
            position: absolute;
            top: -0.5rem;
            left: 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--secondary);
            background-color: white;
            padding: 0 0.25rem;
            z-index: 1;
        }

        .submit-btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: var(--secondary);
        }

        .login-link a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .error-message {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--danger);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .brand-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background-color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .logo-circle i {
            font-size: 30px;
            color: white;
        }

        /* Password strength indicator */
        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 0.5rem;
            transition: all 0.3s;
            background-color: #e2e8f0;
        }

        .password-strength-text {
            font-size: 0.75rem;
            margin-top: 0.25rem;
            color: var(--secondary);
        }

        /* Animated background */
        .bg-bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 8s infinite ease-in-out;
        }

        .bubble:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: 0s;
        }

        .bubble:nth-child(2) {
            width: 40px;
            height: 40px;
            left: 20%;
            top: 40%;
            animation-delay: 1s;
            animation-duration: 12s;
        }

        .bubble:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 70%;
            top: 30%;
            animation-delay: 2s;
        }

        .bubble:nth-child(4) {
            width: 120px;
            height: 120px;
            left: 80%;
            top: 70%;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .bubble:nth-child(5) {
            width: 50px;
            height: 50px;
            left: 30%;
            top: 80%;
            animation-delay: 3s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.5;
            }
            50% {
                transform: translateY(-100px) rotate(180deg);
                opacity: 0.8;
            }
            100% {
                transform: translateY(0) rotate(360deg);
                opacity: 0.5;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .signup-card {
                max-width: 90%;
                margin: 0 1rem;
            }

            .signup-header {
                padding: 1rem;
                font-size: 1.25rem;
            }

            .signup-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="signup-card">
        <div class="signup-header">
            Create Account
        </div>
        <div class="signup-body">
            <div class="brand-logo">
                <div class="logo-circle">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>

            <?php if(isset($error_message)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo $error_message; ?></span>
            </div>
            <?php endif; ?>

            <form method="post" id="signupForm">
                <div class="input-row">
                    <div class="input-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>">
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="input-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>">
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="input-group single-input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    <i class="fas fa-envelope"></i>
                </div>

                <div class="input-group single-input">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-lock"></i>
                    <div class="password-strength" id="passwordStrength"></div>
                    <div class="password-strength-text" id="passwordStrengthText">Password strength</div>
                </div>

                <div class="input-group single-input">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <i class="fas fa-lock"></i>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>

                <div class="login-link">
                    Already have an account? <a href="login.php">Sign in</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password strength indicator
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');
            const confirmPassword = document.getElementById('confirm_password');

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;

                // Update strength based on criteria
                if (password.length >= 8) strength += 25;
                if (password.match(/[A-Z]/)) strength += 25;
                if (password.match(/[0-9]/)) strength += 25;
                if (password.match(/[^A-Za-z0-9]/)) strength += 25;

                // Update UI
                strengthBar.style.width = strength + '%';

                if (strength < 25) {
                    strengthBar.style.backgroundColor = '#ef4444';
                    strengthText.textContent = 'Weak password';
                    strengthText.style.color = '#ef4444';
                } else if (strength < 50) {
                    strengthBar.style.backgroundColor = '#f59e0b';
                    strengthText.textContent = 'Fair password';
                    strengthText.style.color = '#f59e0b';
                } else if (strength < 75) {
                    strengthBar.style.backgroundColor = '#10b981';
                    strengthText.textContent = 'Good password';
                    strengthText.style.color = '#10b981';
                } else {
                    strengthBar.style.backgroundColor = '#22c55e';
                    strengthText.textContent = 'Strong password';
                    strengthText.style.color = '#22c55e';
                }
            });

            // Check if passwords match
            confirmPassword.addEventListener('input', function() {
                if (this.value !== passwordInput.value) {
                    this.setCustomValidity('Passwords do not match');
                } else {
                    this.setCustomValidity('');
                }
            });

            // Add focus animation
            const inputs = document.querySelectorAll('input');

            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });

                // Check if input has value on page load
                if (input.value) {
                    input.parentElement.classList.add('has-value');
                }

                input.addEventListener('input', function() {
                    if (this.value) {
                        this.parentElement.classList.add('has-value');
                    } else {
                        this.parentElement.classList.remove('has-value');
                    }
                });
            });

            // Auto hide error message after 5 seconds
            const errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.opacity = '0';
                    setTimeout(() => {
                        errorMessage.style.display = 'none';
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>
</html>
