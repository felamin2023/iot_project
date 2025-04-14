<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // Something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if(!empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        // Read from database
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if($result)
        {
            if(mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);

                // Verify hashed password
                if(password_verify($password, $user_data['password']))
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }

        $error_message = "Wrong email or password!";
    }
    else
    {
        $error_message = "Please enter valid email and password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Environment Monitor</title>
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
        }

        .login-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .login-header {
            background-color: var(--primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 1.5rem;
            position: relative;
        }

        .login-header::after {
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

        .login-body {
            padding: 2rem;
        }

        .input-group {
            position: relative;
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
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: var(--secondary);
        }

        .register-link a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-link a:hover {
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

        /* Responsive adjustments for mobile */
        @media (max-width: 640px) {
            .login-card {
                max-width: 90%;
                margin: 0 1rem;
            }

            .login-header {
                padding: 1rem;
                font-size: 1.25rem;
            }

            .login-body {
                padding: 1.5rem;
            }
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
            top: 30%;
            animation-delay: 1s;
            animation-duration: 12s;
        }

        .bubble:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 70%;
            top: 10%;
            animation-delay: 2s;
        }

        .bubble:nth-child(4) {
            width: 120px;
            height: 120px;
            left: 80%;
            top: 60%;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .bubble:nth-child(5) {
            width: 50px;
            height: 50px;
            left: 50%;
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

    <div class="login-card">
        <div class="login-header">
            Smart Environment Monitor
        </div>
        <div class="login-body">
            <div class="brand-logo">
                <div class="logo-circle">
                    <i class="fas fa-temperature-high"></i>
                </div>
            </div>

            <?php if(isset($error_message)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle mr-2"></i> <?php echo $error_message; ?>
            </div>
            <?php endif; ?>

            <form method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required autofocus>
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-lock"></i>
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
                <div class="register-link">
                    Don't have an account? <a href="signup.php">Sign up</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Optional JS for enhanced user experience
        document.addEventListener('DOMContentLoaded', function() {
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
