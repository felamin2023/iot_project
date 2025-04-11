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
        // Save to database
        $user_id = random_num(20);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Safely hash the password

        $query = "INSERT INTO users (user_id, first_name, last_name, email, password) VALUES ('$user_id', '$first_name', '$last_name', '$email', '$hashed_password')";

        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    }
    else
    {
        echo "Please enter valid information and ensure passwords match!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>

    <style type="text/css">
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #0e1b2b;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, #0e1b2b 0%, #162c4a 100%);
            z-index: -20;
        }

        /* Sky Elements */
        .stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background-image: radial-gradient(circle at center, rgba(255, 255, 255, 0.4) 1px, transparent 1px),
                              radial-gradient(circle at center, rgba(255, 255, 255, 0.2) 1px, transparent 1px),
                              radial-gradient(circle at center, rgba(255, 255, 255, 0.3) 1px, transparent 1px);
            background-size: 150px 150px, 200px 200px, 100px 100px;
            background-position: 10px 10px, 30px 40px, 50px 90px;
            z-index: -19;
        }

        .moon {
    position: absolute;
    top: 15%;
    right: 15%;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: 
        radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.9), transparent 50%),
        radial-gradient(circle at 70% 65%, rgba(255, 255, 255, 0.7), transparent 35%),
        radial-gradient(circle at 40% 80%, rgba(255, 255, 255, 0.6), transparent 25%),
        radial-gradient(circle at 50% 50%, rgba(200, 220, 255, 0.8) 30%, rgba(200, 220, 255, 0.4) 60%, rgba(200, 220, 255, 0.2) 80%, transparent 100%);
    box-shadow: 
        0 0 20px 5px rgba(255, 255, 255, 0.4),
        0 0 30px 10px rgba(200, 220, 255, 0.2),
        0 0 40px 15px rgba(150, 180, 255, 0.1);
    z-index: -19;
    transform-origin: center center;
    animation: moonGlow 2s infinite alternate, moonRotate 30s linear infinite;
}

@keyframes moonGlow {
    0% {
        box-shadow: 
            0 0 20px 5px rgba(255, 255, 255, 0.4),
            0 0 30px 10px rgba(200, 220, 255, 0.2),
            0 0 40px 15px rgba(150, 180, 255, 0.1);
    }
    100% {
        box-shadow: 
            0 0 25px 8px rgba(255, 255, 255, 0.5),
            0 0 40px 15px rgba(200, 220, 255, 0.3),
            0 0 60px 20px rgba(150, 180, 255, 0.15);
    }
}

@keyframes moonRotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}


        .clouds {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50%;
            z-index: -18;
        }

        .cloud {
  position: absolute;
  background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.1), rgba(200, 200, 200, 0.1));
  border-radius: 50%;
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
}



.cloud-1 {
  top: 20%;
  left: 10%;
  width: 300px;
  height: 60px;
  opacity: 0.6;
  animation: cloudMove1 50s linear infinite;
}

.cloud-2 {
  top: 15%;
  left: 40%;
  width: 400px;
  height: 80px;
  opacity: 0.5;
  animation: cloudMove2 50s linear infinite;
}

.cloud-3 {
  top: 25%;
  left: 60%;
  width: 350px;
  height: 70px;
  opacity: 0.7;
  animation: cloudMove3 50s linear infinite;
}

@keyframes cloudMove1 {
  0% { transform: translateX(-120%); opacity: 0; }
  10% { opacity: 1; }
  90% { opacity: 1; }
  100% { transform: translateX(120%); opacity: 0; }
}

@keyframes cloudMove2 {
  0% { transform: translateX(-150%); opacity: 0; }
  15% { opacity: 1; }
  85% { opacity: 1; }
  100% { transform: translateX(130%); opacity: 0; }
}

@keyframes cloudMove3 {
  0% { transform: translateX(-100%); opacity: 0; }
  20% { opacity: 1; }
  80% { opacity: 1; }
  100% { transform: translateX(150%); opacity: 0; }
}




        .mist {
            position: absolute;
            bottom: 30%;
            left: 0;
            width: 100%;
            height: 40px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
            z-index: -5;
            opacity: 0.3;
        }

        /* Mountains and Hills */
        .mountains {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60%;
            z-index: -17;
        }

        .mountain {
            position: absolute;
            bottom: 15%;
            width: 0;
            height: 0;
            border-style: solid;
            z-index: -16;
        }

        .mountain-1 {
            left: 10%;
            border-width: 0 200px 350px 200px;
            border-color: transparent transparent #0d1c2e transparent;
        }

        .mountain-2 {
            left: 35%;
            border-width: 0 250px 400px 250px;
            border-color: transparent transparent #0b1826 transparent;
        }

        .mountain-3 {
            right: 20%;
            border-width: 0 220px 380px 220px;
            border-color: transparent transparent #0d1c2e transparent;
        }

        /* Forest waves */
        .forest-waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%; 
            z-index: -15;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0a1624;
        }

        .wave-1 {
            border-radius: 100% 100% 0 0 / 100% 100% 0 0;
            transform: scaleX(2) translateY(50%);
            opacity: 0.5;
        }

        .wave-2 {
            border-radius: 50% 70% 0 0 / 50% 50% 0 0;
            transform: scaleX(2.5) translateX(-10%) translateY(60%);
            opacity: 0.7;
        }

        .wave-3 {
            border-radius: 70% 50% 0 0 / 50% 50% 0 0;
            transform: scaleX(2.5) translateX(10%) translateY(70%);
            opacity: 0.6;
        }

        .wave-4 {
            border-radius: 40% 60% 0 0 / 40% 40% 0 0;
            transform: scaleX(3) translateX(-5%) translateY(75%);
            opacity: 0.5;
            background-color: #091320;
        }

        .wave-5 {
            border-radius: 60% 40% 0 0 / 35% 35% 0 0;
            transform: scaleX(2.8) translateX(5%) translateY(80%);
            opacity: 0.4;
            background-color: #081018;
        }

        .wave-6 {
            border-radius: 45% 55% 0 0 / 30% 30% 0 0;
            transform: scaleX(3.2) translateY(85%);
            opacity: 0.65;
            background-color: #070e14;
        }

        .wave-7 {
            border-radius: 55% 45% 0 0 / 25% 25% 0 0;
            transform: scaleX(3.5) translateX(-8%) translateY(88%);
            opacity: 0.7;
            background-color: #060c10;
        }

        .wave-8 {
            border-radius: 30% 70% 0 0 / 20% 20% 0 0;
            transform: scaleX(4) translateX(5%) translateY(92%);
            opacity: 0.8;
            background-color: #05090c;
        }

        /* Lake */
        .lake {
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 5%;
            background: linear-gradient(to bottom, rgba(10, 30, 60, 0.6), rgba(10, 40, 80, 0.8));
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
            z-index: -12;
            opacity: 0.8;
        }

        .lake-reflection {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 30px 4px;
            opacity: 0.3;
        }

        /* Forest elements */
        .forest {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -14;
        }

        .tree {
            position: absolute;
            bottom: 0;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: bottom;
        }

        /* Foreground Trees */
        .tree-fg-1 {
            left: 2%;
            width: 120px;
            height: 350px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%23071018'%3E%3Cpath d='M50,0 C20,60 5,120 15,200 C25,250 45,280 50,300 C55,280 75,250 85,200 C95,120 80,60 50,0 Z'/%3E%3C/svg%3E");
            z-index: -1;
        }

        .tree-fg-2 {
            left: 8%;
            width: 150px;
            height: 400px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%23071018'%3E%3Cpath d='M50,0 L25,70 L35,70 L20,130 L40,130 L15,190 L45,190 L35,260 L65,260 L55,190 L85,190 L60,130 L80,130 L65,70 L75,70 Z M45,260 L55,260 L50,300 Z'/%3E%3C/svg%3E");
            z-index: -1;
        }

        .tree-fg-3 {
            left: 15%;
            width: 100px;
            height: 300px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%23071018'%3E%3Cpath d='M50,50 C15,50 5,110 25,160 C15,190 15,230 40,260 C45,275 47,300 50,300 C53,300 55,275 60,260 C85,230 85,190 75,160 C95,110 85,50 50,50 Z'/%3E%3C/svg%3E");
            z-index: -1;
        }

        .tree-fg-4 {
            right: 5%;
            width: 150px;
            height: 420px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%23071018'%3E%3Cpath d='M50,0 C20,60 5,120 15,200 C25,250 45,280 50,300 C55,280 75,250 85,200 C95,120 80,60 50,0 Z'/%3E%3C/svg%3E");
            z-index: -1;
        }

        /* Midground Trees */
        .tree-mid-1 {
            left: 7%;
            width: 80px;
            height: 280px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%230a1624'%3E%3Cpath d='M50,0 C30,50 20,120 30,180 C35,220 45,260 50,300 C55,260 65,220 70,180 C80,120 70,50 50,0 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.8;
        }

        .tree-mid-2 {
            left: 12%;
            width: 95px;
            height: 300px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%230a1624'%3E%3Cpath d='M50,0 L25,70 L35,70 L20,130 L40,130 L15,190 L45,190 L35,260 L65,260 L55,190 L85,190 L60,130 L80,130 L65,70 L75,70 Z M45,260 L55,260 L50,300 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.85;
        }

        .tree-mid-3 {
            left: 18%;
            width: 70px;
            height: 250px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%230a1624'%3E%3Cpath d='M50,50 C15,50 5,110 25,160 C15,190 15,230 40,260 C45,275 47,300 50,300 C53,300 55,275 60,260 C85,230 85,190 75,160 C95,110 85,50 50,50 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.8;
        }

        .tree-mid-4 {
            left: 23%;
            width: 85px;
            height: 280px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 300' fill='%230a1624'%3E%3Cpath d='M75,0 C70,40 65,60 60,80 C40,100 20,130 30,170 C40,210 50,230 60,250 L60,300 L90,300 L90,250 C100,230 110,210 120,170 C130,130 110,100 90,80 C85,60 80,40 75,0 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.85;
        }

        .tree-mid-5 {
            left: 28%;
            width: 40px;
            height: 240px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 60 300' fill='%230a1624'%3E%3Cpath d='M20,0 L20,300 L40,300 L40,0 Z M10,100 L50,100 L50,110 L10,110 Z M5,150 L55,150 L55,160 L5,160 Z M10,200 L50,200 L50,210 L10,210 Z M15,250 L45,250 L45,260 L15,260 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.8;
        }

        .tree-mid-6 {
            left: 33%;
            width: 90px;
            height: 300px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%230a1624'%3E%3Cpath d='M50,0 C30,50 10,100 20,180 C25,220 40,250 50,300 C60,250 75,220 80,180 C90,100 70,50 50,0 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.85;
        }

        .tree-mid-7 {
            right: 33%;
            width: 85px;
            height: 280px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%230a1624'%3E%3Cpath d='M50,0 L25,70 L35,70 L20,130 L40,130 L15,190 L45,190 L35,260 L65,260 L55,190 L85,190 L60,130 L80,130 L65,70 L75,70 Z M45,260 L55,260 L50,300 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.85;
        }

        .tree-mid-8 {
            right: 28%;
            width: 75px;
            height: 260px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%230a1624'%3E%3Cpath d='M50,50 C15,50 5,110 25,160 C15,190 15,230 40,260 C45,275 47,300 50,300 C53,300 55,275 60,260 C85,230 85,190 75,160 C95,110 85,50 50,50 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.8;
        }

        .tree-mid-9 {
            right: 23%;
            width: 80px;
            height: 270px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%230a1624'%3E%3Cpath d='M50,0 C30,50 20,120 30,180 C35,220 45,260 50,300 C55,260 65,220 70,180 C80,120 70,50 50,0 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.8;
        }

        .tree-mid-10 {
            right: 18%;
            width: 50px;
            height: 240px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 60 300' fill='%230a1624'%3E%3Cpath d='M20,0 L20,300 L40,300 L40,0 Z M10,100 L50,100 L50,110 L10,110 Z M5,150 L55,150 L55,160 L5,160 Z M10,200 L50,200 L50,210 L10,210 Z M15,250 L45,250 L45,260 L15,260 Z'/%3E%3C/svg%3E");
            z-index: -2;
            opacity: 0.8;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            color: white;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .login-btn {
            padding: 8px 25px;
            border: 2px solid white;
            border-radius: 30px;
            background: transparent;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .signup-modal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: rgba(228, 232, 237, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
            padding: 30px;
            border: 0.1px solid rgba(255, 255, 255, 0.5);
        }

        .modal-header {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: rgb(213, 212, 212);
            font-weight: 600;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #333;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 3px;
            color:rgb(213, 212, 212);
            font-size: 16px;
        }

        .input-group input {
            width: 100%;
            padding: 3px 40px 12px 0;
            border: none;
            border-bottom: 1px solid #999;
            background: transparent;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            color: rgb(213, 212, 212);
        }

        .input-group input:focus {
            border-bottom: 2px solid #162c4a;
        }

        .input-group i {
            position: absolute;
            right: 10px;
            bottom: 15px;
            color: #333;
        }

        .extras {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .forgot-password {
            color: #162c4a;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #0e1b2b;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .submit-btn:hover {
            background: #162c4a;
        }

        .register-link {
            text-align: center;
            color: rgb(213, 212, 212);
        }

        .register-link a {
            color: #162c4a;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
            color: rgb(213, 212, 212);
        }
    </style>

</head>
<body>


<div class="background"></div>
    <div class="stars"></div>
    <div class="moon"></div>
    
    <div class="clouds">
        <div class="cloud cloud-1"></div>
        <div class="cloud cloud-2"></div>
        <div class="cloud cloud-3"></div>
    </div>
    
    <div class="mountains">
        <div class="mountain mountain-1"></div>
        <div class="mountain mountain-2"></div>
        <div class="mountain mountain-3"></div>
    </div>
    
    <div class="mist"></div>
    
    <div class="forest-waves">
        <div class="wave wave-1"></div>
        <div class="wave wave-2"></div>
        <div class="wave wave-3"></div>
        <div class="wave wave-4"></div>
        <div class="wave wave-5"></div>
        <div class="wave wave-6"></div>
        <div class="wave wave-7"></div>
        <div class="wave wave-8"></div>
    </div>
    
    <div class="lake">
        <div class="lake-reflection"></div>
    </div>
    
    <div class="forest">
        <!-- Foreground Trees -->
        <div class="tree tree-fg-1"></div>
        <div class="tree tree-fg-2"></div>
        <div class="tree tree-fg-3"></div>
        <div class="tree tree-fg-4"></div>
        
        <!-- Midground Trees -->
        <div class="tree tree-mid-1"></div>
        <div class="tree tree-mid-2"></div>
        <div class="tree tree-mid-3"></div>
        <div class="tree tree-mid-4"></div>
        <div class="tree tree-mid-5"></div>
        <div class="tree tree-mid-6"></div>
        <div class="tree tree-mid-7"></div>
        <div class="tree tree-mid-8"></div>
        <div class="tree tree-mid-9"></div>
        <div class="tree tree-mid-10"></div>
    </div>

    <div class="signup-modal">
        <h2 class="modal-header">Sign up</h2>
        <form method="post">

            <div class="input-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
                <i class="fas fa-user"></i>
            </div>

            <div class="input-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
                <i class="fas fa-user"></i>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <i class="fas fa-envelope"></i>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <i class="fas fa-lock"></i>
            </div>

            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <i class="fas fa-lock"></i>
            </div>

            <button type="submit" class="submit-btn">Signup</button>

            <div class="register-link">
                Already have an account? <a href="login.php">Sign in</a>
            </div>
        </form>
    </div>
</body>
</html>
