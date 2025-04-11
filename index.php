<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
	$sensor_data = get_sensor_data($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
</head>
<style>
	* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #e8f4f8;
    height: 100vh;
    overflow: hidden;
    position: relative;
	display: flex;
	align-items: center;
	flex-direction: column;
	padding: 40px;
}

.background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, #87ceeb 0%, #e8f4f8 100%);
    z-index: -20;
}

/* Sky Elements */
.stars {
    display: none; /* No stars in morning */
}

.moon {
    position: absolute;
    top: 15%;
    right: 15%;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: 
        radial-gradient(circle at 30% 30%, rgba(255, 255, 200, 0.9), transparent 50%),
        radial-gradient(circle at 70% 65%, rgba(255, 230, 150, 0.7), transparent 35%),
        radial-gradient(circle at 40% 80%, rgba(255, 200, 100, 0.6), transparent 25%),
        radial-gradient(circle at 50% 50%, rgba(255, 210, 100, 0.8) 30%, rgba(255, 180, 80, 0.4) 60%, rgba(255, 160, 60, 0.2) 80%, transparent 100%);
    box-shadow: 
        0 0 30px 10px rgba(255, 200, 100, 0.7),
        0 0 60px 15px rgba(255, 150, 50, 0.4),
        0 0 80px 20px rgba(255, 120, 20, 0.2);
    z-index: -19;
    transform-origin: center center;
    animation: sunGlow 3s infinite alternate, sunRotate 60s linear infinite;
}

@keyframes sunGlow {
    0% {
        box-shadow: 
            0 0 30px 10px rgba(255, 200, 100, 0.7),
            0 0 60px 15px rgba(255, 150, 50, 0.4),
            0 0 80px 20px rgba(255, 120, 20, 0.2);
    }
    100% {
        box-shadow: 
            0 0 40px 15px rgba(255, 200, 100, 0.8),
            0 0 70px 20px rgba(255, 150, 50, 0.5),
            0 0 100px 30px rgba(255, 120, 20, 0.3);
    }
}

@keyframes sunRotate {
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
    height: 20%;
	z-index: -18;
}

.cloud {
    position: absolute;
    background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.9), rgba(240, 240, 240, 0.8));
    border-radius: 50%;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
}

.cloud-1 {
    top: 35%;
    left: 10%;
    width: 300px;
    height: 60px;
    opacity: 0.9;
    animation: cloudMove1 50s linear infinite;
}


.cloud-2 {
    top: 50%;
    left: 40%;
    width: 400px;
    height: 80px;
    opacity: 0.85;
    animation: cloudMove2 50s linear infinite;
}

.cloud-3 {
    top: 45%;
    left: 60%;
    width: 350px;
    height: 70px;
    opacity: 0.9;
    animation: cloudMove3 50s linear infinite;
}


@keyframes cloudMove1 {
    0% { transform: translateX(-120%); opacity: 0; }
    10% { opacity: 0.9; }
    90% { opacity: 0.9; }
    100% { transform: translateX(120%); opacity: 0; }
}

@keyframes cloudMove2 {
    0% { transform: translateX(-150%); opacity: 0; }
    15% { opacity: 0.85; }
    85% { opacity: 0.85; }
    100% { transform: translateX(130%); opacity: 0; }
}

@keyframes cloudMove3 {
    0% { transform: translateX(-100%); opacity: 0; }
    20% { opacity: 0.9; }
    80% { opacity: 0.9; }
    100% { transform: translateX(150%); opacity: 0; }
}

.mist {
    position: absolute;
    bottom: 30%;
    left: 0;
    width: 100%;
    height: 40px;
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
    z-index: -5;
    opacity: 0.7;
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
    border-color: transparent transparent #7a9eb1 transparent;
}

.mountain-2 {
    left: 35%;
    border-width: 0 250px 400px 250px;
    border-color: transparent transparent #6a8fa3 transparent;
}

.mountain-3 {
    right: 20%;
    border-width: 0 220px 380px 220px;
    border-color: transparent transparent #7a9eb1 transparent;
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
    background-color: #8ab5c1;
}

.wave-1 {
    border-radius: 100% 100% 0 0 / 100% 100% 0 0;
    transform: scaleX(2) translateY(50%);
    opacity: 0.5;
    animation: waveMove1 8s ease-in-out infinite alternate;
}

.wave-2 {
    border-radius: 50% 70% 0 0 / 50% 50% 0 0;
    transform: scaleX(2.5) translateX(-10%) translateY(60%);
    opacity: 0.7;
    background-color: #7eacbc;
    animation: waveMove2 12s ease-in-out infinite alternate;
}

.wave-3 {
    border-radius: 70% 50% 0 0 / 50% 50% 0 0;
    transform: scaleX(2.5) translateX(10%) translateY(70%);
    opacity: 0.6;
    background-color: #73a3b5;
    animation: waveMove3 10s ease-in-out infinite alternate;
}

.wave-4 {
    border-radius: 40% 60% 0 0 / 40% 40% 0 0;
    transform: scaleX(3) translateX(-5%) translateY(75%);
    opacity: 0.5;
    background-color: #689aad;
    animation: waveMove4 14s ease-in-out infinite alternate;
}

.wave-5 {
    border-radius: 60% 40% 0 0 / 35% 35% 0 0;
    transform: scaleX(2.8) translateX(5%) translateY(80%);
    opacity: 0.4;
    background-color: #5e91a5;
    animation: waveMove5 9s ease-in-out infinite alternate;
}

.wave-6 {
    border-radius: 45% 55% 0 0 / 30% 30% 0 0;
    transform: scaleX(3.2) translateY(85%);
    opacity: 0.65;
    background-color: #54889d;
    animation: waveMove6 13s ease-in-out infinite alternate;
}

.wave-7 {
    border-radius: 55% 45% 0 0 / 25% 25% 0 0;
    transform: scaleX(3.5) translateX(-8%) translateY(88%);
    opacity: 0.7;
    background-color: #497e95;
    animation: waveMove7 11s ease-in-out infinite alternate;
}

.wave-8 {
    border-radius: 30% 70% 0 0 / 20% 20% 0 0;
    transform: scaleX(4) translateX(5%) translateY(92%);
    opacity: 0.8;
    background-color: #3f758c;
    animation: waveMove8 15s ease-in-out infinite alternate;
}

/* Wave animations */
@keyframes waveMove1 {
    0% {
        transform: scaleX(2) translateY(50%) translateX(-2%);
    }
    100% {
        transform: scaleX(2) translateY(49%) translateX(2%);
    }
}

@keyframes waveMove2 {
    0% {
        transform: scaleX(2.5) translateX(-12%) translateY(60%);
    }
    100% {
        transform: scaleX(2.5) translateX(-8%) translateY(49%);
    }
}

@keyframes waveMove3 {
    0% {
        transform: scaleX(2.5) translateX(8%) translateY(70%);
    }
    100% {
        transform: scaleX(2.5) translateX(12%) translateY(59%);
    }
}

@keyframes waveMove4 {
    0% {
        transform: scaleX(3) translateX(-7%) translateY(75%);
    }
    100% {
        transform: scaleX(3) translateX(-3%) translateY(64%);
    }
}

@keyframes waveMove5 {
    0% {
        transform: scaleX(2.8) translateX(3%) translateY(80%);
    }
    100% {
        transform: scaleX(2.8) translateX(7%) translateY(69%);
    }
}

@keyframes waveMove6 {
    0% {
        transform: scaleX(3.2) translateX(-2%) translateY(85%);
    }
    100% {
        transform: scaleX(3.2) translateX(2%) translateY(74%);
    }
}

@keyframes waveMove7 {
    0% {
        transform: scaleX(3.5) translateX(-10%) translateY(88%);
    }
    100% {
        transform: scaleX(3.5) translateX(-6%) translateY(77%);
    }
}

@keyframes waveMove8 {
    0% {
        transform: scaleX(4) translateX(3%) translateY(92%);
    }
    100% {
        transform: scaleX(4) translateX(7%) translateY(81%);
    }
}

/* Lake */
.lake {
    position: absolute;
    bottom: 0;
    left: 25%;
    width: 50%;
    height: 5%;
    background: linear-gradient(to bottom, rgba(120, 200, 240, 0.7), rgba(100, 180, 220, 0.9));
    border-radius: 50% 50% 0 0 / 100% 100% 0 0;
    z-index: 2;
    opacity: 0.8;
    animation: lakeMove 10s ease-in-out infinite alternate;
}

@keyframes lakeMove {
    0% {
        transform: scaleX(1) translateX(-1%);
    }
    100% {
        transform: scaleX(2.03) translateX(1%);
    }
}

.lake-reflection {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.5) 1px, transparent 1px);
    background-size: 30px 4px;
    opacity: 0.7;
    animation: reflectionMove 6s ease-in-out infinite;
}

@keyframes reflectionMove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 30px 0;
    }
}

/* Forest elements */
.forest {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
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
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%23518060'%3E%3Cpath d='M50,0 C20,60 5,120 15,200 C25,250 45,280 50,300 C55,280 75,250 85,200 C95,120 80,60 50,0 Z'/%3E%3C/svg%3E");
    
}

.tree-fg-2 {
    left: 8%;
    width: 150px;
    height: 400px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%23457055'%3E%3Cpath d='M50,0 L25,70 L35,70 L20,130 L40,130 L15,190 L45,190 L35,260 L65,260 L55,190 L85,190 L60,130 L80,130 L65,70 L75,70 Z M45,260 L55,260 L50,300 Z'/%3E%3C/svg%3E260 50,300 C55,260 65,220 70,180 C80,120 70,50 50,0 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-2 {
    left: 12%;
    width: 95px;
    height: 300px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%235e9470'%3E%3Cpath d='M50,0 L25,70 L35,70 L20,130 L40,130 L15,190 L45,190 L35,260 L65,260 L55,190 L85,190 L60,130 L80,130 L65,70 L75,70 Z M45,260 L55,260 L50,300 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-3 {
    left: 18%;
    width: 70px;
    height: 250px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%2366a078'%3E%3Cpath d='M50,50 C15,50 5,110 25,160 C15,190 15,230 40,260 C45,275 47,300 50,300 C53,300 55,275 60,260 C85,230 85,190 75,160 C95,110 85,50 50,50 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-4 {
    left: 23%;
    width: 85px;
    height: 280px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 300' fill='%235e9470'%3E%3Cpath d='M75,0 C70,40 65,60 60,80 C40,100 20,130 30,170 C40,210 50,230 60,250 L60,300 L90,300 L90,250 C100,230 110,210 120,170 C130,130 110,100 90,80 C85,60 80,40 75,0 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-5 {
    left: 28%;
    width: 40px;
    height: 240px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 60 300' fill='%2366a078'%3E%3Cpath d='M20,0 L20,300 L40,300 L40,0 Z M10,100 L50,100 L50,110 L10,110 Z M5,150 L55,150 L55,160 L5,160 Z M10,200 L50,200 L50,210 L10,210 Z M15,250 L45,250 L45,260 L15,260 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-6 {
    left: 33%;
    width: 90px;
    height: 300px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%235e9470'%3E%3Cpath d='M50,0 C30,50 10,100 20,180 C25,220 40,250 50,300 C60,250 75,220 80,180 C90,100 70,50 50,0 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-7 {
    right: 33%;
    width: 85px;
    height: 280px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%235e9470'%3E%3Cpath d='M50,0 L25,70 L35,70 L20,130 L40,130 L15,190 L45,190 L35,260 L65,260 L55,190 L85,190 L60,130 L80,130 L65,70 L75,70 Z M45,260 L55,260 L50,300 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-8 {
    right: 28%;
    width: 75px;
    height: 260px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%2366a078'%3E%3Cpath d='M50,50 C15,50 5,110 25,160 C15,190 15,230 40,260 C45,275 47,300 50,300 C53,300 55,275 60,260 C85,230 85,190 75,160 C95,110 85,50 50,50 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-9 {
    right: 23%;
    width: 80px;
    height: 270px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 300' fill='%235e9470'%3E%3Cpath d='M50,0 C30,50 20,120 30,180 C35,220 45,260 50,300 C55,260 65,220 70,180 C80,120 70,50 50,0 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}

.tree-mid-10 {
    right: 18%;
    width: 50px;
    height: 240px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 60 300' fill='%2366a078'%3E%3Cpath d='M20,0 L20,300 L40,300 L40,0 Z M10,100 L50,100 L50,110 L10,110 Z M5,150 L55,150 L55,160 L5,160 Z M10,200 L50,200 L50,210 L10,210 Z M15,250 L45,250 L45,260 L15,260 Z'/%3E%3C/svg%3E");
    z-index: -2;
    opacity: 0.9;
}
.logout-container{
	display: flex;
	justify-content: end;
	align-items: center;
	height: fit-content;
	gap: 20px;
	width: 100%;
	margin-bottom: 50px;
}
.logout-container a{
	padding: 8px 25px;
            border: 1px solid white;
            border-radius: 30px;
            background: #3f758c;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
			text-decoration: none;
}
.logout-container a:hover{
	background: rgba(255, 255, 255, 0.8);
	color: #3f758c;
	border: 1px solid #3f758c;
}
.main_container{
	display: flex;
	justify-content: space-between;
	align-items: center;
	width: 60%;
	height: 60%;
	gap: 20px;
	border: 1px solid black;
}
.data_container{
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 20px;
	width: 50%;
	height: 80%;
	background: rgba(255, 255, 255, 0.8);
	border-radius: 20px;
	padding: 20px;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
	z-index: 1;
}
.data_container ul{
	list-style: none;
	padding: 0;
	margin: 0;
	width: 100%;
	overflow-y: auto;
}
.data_container ul::-webkit-scrollbar {
	display: none;
}
.data_container ul li{
	list-style: none;
	font-size: 20px;
	padding: 10px 0;
	border-bottom: 1px solid #ccc;
}


.data_container ul li:nth-child(even) {
    background-color: rgba(255, 255, 255, 0.8); /* White */
}
.lake:hover{
	cursor: pointer;
}
.ledbtn{
	padding: 15px 0px;
	width: 150px;
            border: 1px solid white;
            border-radius: 10px;
            background:rgb(65, 6, 6);
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
			text-decoration: none;
			text-align: center;
			font-size: 30px;
			font-weigth: bold;
}
.ledbtn:hover{
	background: rgba(255, 255, 255, 0.8);
	color: #3f758c;
	border: 1px solid #3f758c;
}
</style>
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
	<div class="logout-container">
		<h3>Hello, <?php echo $user_data['first_name']; ?></h3>
		<a href="logout.php">Logout</a>
	</div>
	<div class="main_container">
		<div class="data_container">
			<h1>Temperature</h1>
			<ul>
				<?php if($sensor_data): ?>
					<?php foreach($sensor_data as $data): ?>
						<li>Temperature: <?php echo $data['temperature']; ?>°C 
							<span class="timestamp">(<?php echo date('M d, H:i', strtotime($data['timestamp'])); ?>)</span>
						</li>
					<?php endforeach; ?>
				<?php else: ?>
					<li>No temperature data available</li>
				<?php endif; ?>
			</ul>
		</div>
		<div class="data_container">
			<h1>Humidity</h1>
			<ul>
				<?php if($sensor_data): ?>
					<?php foreach($sensor_data as $data): ?>
						<li>Humidity: <?php echo $data['humidity']; ?>% 
							<span class="timestamp">(<?php echo date('M d, H:i', strtotime($data['timestamp'])); ?>)</span>
						</li>
					<?php endforeach; ?>
				<?php else: ?>
					<li>No humidity data available</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
<a class="ledbtn" href="">OFF</a>

	<script>
document.addEventListener('DOMContentLoaded', function() {
    const lake = document.querySelector('.lake');
    let isOriginalColor = true;
    
    lake.addEventListener('click', function() {
        if (isOriginalColor) {
            // Change to dirty lake green color
            lake.style.background = 'linear-gradient(to bottom, rgba(70, 100, 50, 0.8), rgba(50, 80, 40, 0.9))';
            isOriginalColor = false;
        } else {
            // Change back to original color
            lake.style.background = 'linear-gradient(to bottom, rgba(120, 200, 240, 0.7), rgba(100, 180, 220, 0.9))';
            isOriginalColor = true;
        }
    });
});
</script>

	
</body>
</html>