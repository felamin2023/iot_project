<?php
session_start();
include("connection.php");
include("functions.php");
$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Environment Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/gaugeJS/dist/gauge.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body::-webkit-scrollbar{
            display: none;
        }

        .dashboard-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease-in-out;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .toggle-switch {
            width: 64px;
            height: 32px;
            background-color: var(--danger);
            border-radius: 32px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .toggle-knob {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 28px;
            height: 28px;
            background-color: white;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .toggle-on {
            background-color: var(--accent);
        }

        .toggle-on .toggle-knob {
            transform: translateX(32px);
        }

        .gauge-container {
            width: 200px;
            height: 200px;
        }

        @media (max-width: 768px) {
            .gauge-container {
                width: 150px;
                height: 150px;
            }

            .dashboard-card {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 640px) {
            .gauge-container {
                width: 120px;
                height: 120px;
            }
        }

        .user-badge {
            background-color: var(--primary);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 9999px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-badge svg {
            width: 18px;
            height: 18px;
        }

        .logout-btn {
            background-color: var(--secondary);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 9999px;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: var(--dark);
            transform: scale(1.05);
        }

        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
    </style>
</head>

<body class="p-4">
    <div class="container mx-auto max-w-6xl">
        <!-- Header -->
        <header class="flex flex-wrap justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Smart Environment Monitor</h1>

            <div class="flex items-center gap-4">
                <div class="user-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span><?php echo $user_data['first_name']; ?></span>
                </div>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </header>

        <!-- Controls Section -->
        <div class="mb-8">
            <div class="dashboard-card p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">LED Control</h2>
                        <p class="text-gray-600 text-sm">Toggle the LED on/off</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-700" id="status-text">OFF</span>
                        <div id="toggleSwitch" class="toggle-switch">
                            <div id="toggleKnob" class="toggle-knob"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gauges Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Temperature Gauge -->
            <div class="dashboard-card p-4">
                <div class="flex flex-col items-center">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">Temperature</h2>
                    <canvas class="gauge-container mx-auto" id="gauge1"></canvas>
                    <div class="mt-4 text-center">
                        <span class="text-3xl font-bold text-gray-800"><span id="tempValue">0</span>°C</span>
                        <p class="text-sm text-gray-600 mt-1">Current temperature reading</p>
                    </div>
                </div>
            </div>

            <!-- Humidity Gauge -->
            <div class="dashboard-card p-4">
                <div class="flex flex-col items-center">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">Humidity</h2>
                    <canvas class="gauge-container mx-auto" id="gauge2"></canvas>
                    <div class="mt-4 text-center">
                        <span class="text-3xl font-bold text-gray-800"><span id="humidityValue">0</span>%</span>
                        <p class="text-sm text-gray-600 mt-1">Current humidity level</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="dashboard-card p-4 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Historical Data</h2>
            <div class="chart-container">
                <canvas id="tempHumidityChart"></canvas>
            </div>
        </div>

        <!-- Stats and Updates Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="dashboard-card p-4">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Last Update</h3>
                <p class="text-2xl font-bold text-gray-800" id="lastUpdate">--:--</p>
                <p class="text-sm text-gray-600 mt-1">Time of last data update</p>
            </div>

            <div class="dashboard-card p-4">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Temp Status</h3>
                <p class="text-2xl font-bold text-green-500" id="tempStatus">Normal</p>
                <p class="text-sm text-gray-600 mt-1">Current temperature status</p>
            </div>

            <div class="dashboard-card p-4">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Humidity Status</h3>
                <p class="text-2xl font-bold text-green-500" id="humidityStatus">Normal</p>
                <p class="text-sm text-gray-600 mt-1">Current humidity status</p>
            </div>
        </div>
    </div>

    <script>
        // Gauge configuration
        const gaugeOptions = {
            angle: 0.10,
            lineWidth: 0.10,
            radiusScale: 1,
            pointer: {
                length: 0.6,
                strokeWidth: 0.035,
                color: '#000000'
            },
            limitMax: false,
            limitMin: false,
            colorStart: '#6FADCF',
            colorStop: '#8FC0DA',
            strokeColor: '#E0E0E0',
            generateGradient: true,
            highDpiSupport: true,
        };

        // Temperature gauge config
        const tempGaugeOptions = {
            ...gaugeOptions,
            staticZones: [
                { strokeStyle: "#3b82f6", min: 0, max: 15 },   // Cold - blue
                { strokeStyle: "#10b981", min: 15, max: 25 },  // Normal - green
                { strokeStyle: "#f59e0b", min: 25, max: 35 },  // Warm - orange
                { strokeStyle: "#ef4444", min: 35, max: 50 }   // Hot - red
            ]
        };

        // Humidity gauge config
        const humidityGaugeOptions = {
            ...gaugeOptions,
            staticZones: [
                { strokeStyle: "#ef4444", min: 0, max: 30 },   // Dry - red
                { strokeStyle: "#f59e0b", min: 30, max: 40 },  // Low - orange
                { strokeStyle: "#10b981", min: 40, max: 70 },  // Normal - green
                { strokeStyle: "#3b82f6", min: 70, max: 100 }  // Humid - blue
            ]
        };

        // Initialize gauges
        const tempGauge = new Donut(document.getElementById('gauge1')).setOptions(tempGaugeOptions);
        tempGauge.maxValue = 50;
        tempGauge.setMinValue(0);
        tempGauge.set(0);

        const humidityGauge = new Donut(document.getElementById('gauge2')).setOptions(humidityGaugeOptions);
        humidityGauge.maxValue = 100;
        humidityGauge.setMinValue(0);
        humidityGauge.set(0);

        // Toggle switch functionality
        const toggle = document.getElementById("toggleSwitch");
        const knob = document.getElementById("toggleKnob");
        const statusText = document.getElementById("status-text");
        let isOn = false;

        toggle.addEventListener("click", () => {
            isOn = !isOn;
            toggle.classList.toggle("toggle-on", isOn);
            statusText.textContent = isOn ? "ON" : "OFF";
            statusText.classList.toggle("text-green-600", isOn);
            statusText.classList.toggle("text-gray-700", !isOn);

            // Send toggle state to ESP8266
            fetch(`http://192.168.109.97/toggle_led?state=${isOn ? 1 : 0}`)
                .then(res => res.text())
                .then(msg => console.log("ESP says:", msg))
                .catch(err => console.error("Error:", err));
        });

        // Update sensor readings
        async function updateSensorData() {
            try {
                const response = await fetch('get_data.php');
                const data = await response.json();

                const temp = parseFloat(data.temperature);
                const hum = parseFloat(data.humidity);

                if (!isNaN(temp)) {
                    tempGauge.set(temp);
                    document.getElementById('tempValue').innerText = temp.toFixed(1);

                    // Update temperature status
                    const tempStatus = document.getElementById('tempStatus');
                    if (temp < 15) {
                        tempStatus.textContent = "Cold";
                        tempStatus.className = "text-2xl font-bold text-blue-500";
                    } else if (temp < 25) {
                        tempStatus.textContent = "Normal";
                        tempStatus.className = "text-2xl font-bold text-green-500";
                    } else if (temp < 35) {
                        tempStatus.textContent = "Warm";
                        tempStatus.className = "text-2xl font-bold text-yellow-500";
                    } else {
                        tempStatus.textContent = "Hot";
                        tempStatus.className = "text-2xl font-bold text-red-500";
                    }
                }

                if (!isNaN(hum)) {
                    humidityGauge.set(hum);
                    document.getElementById('humidityValue').innerText = hum.toFixed(1);

                    // Update humidity status
                    const humidityStatus = document.getElementById('humidityStatus');
                    if (hum < 30) {
                        humidityStatus.textContent = "Dry";
                        humidityStatus.className = "text-2xl font-bold text-red-500";
                    } else if (hum < 40) {
                        humidityStatus.textContent = "Low";
                        humidityStatus.className = "text-2xl font-bold text-yellow-500";
                    } else if (hum < 70) {
                        humidityStatus.textContent = "Normal";
                        humidityStatus.className = "text-2xl font-bold text-green-500";
                    } else {
                        humidityStatus.textContent = "Humid";
                        humidityStatus.className = "text-2xl font-bold text-blue-500";
                    }
                }

                // Update last update time
                const now = new Date();
                document.getElementById('lastUpdate').textContent =
                    `${now.getHours()}:${String(now.getMinutes()).padStart(2, '0')}`;

            } catch (err) {
                console.error("Error fetching sensor data:", err);
            }
        }

        // Update chart data
        let chart;
        function loadChartData() {
            fetch('data.php')
                .then(res => res.json())
                .then(data => {
                    const labels = data.map(item => {
                        const d = new Date(item.timestamp);
                        return `${d.getHours()}:${String(d.getMinutes()).padStart(2, '0')}`;
                    }).reverse();

                    const temps = data.map(item => parseFloat(item.temperature)).reverse();
                    const hums = data.map(item => parseFloat(item.humidity)).reverse();

                    const ctx = document.getElementById('tempHumidityChart').getContext('2d');

                    if (chart) chart.destroy();

                    chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Temperature (°C)',
                                    data: temps,
                                    borderColor: 'rgba(239, 68, 68, 1)',
                                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                    borderWidth: 2,
                                    tension: 0.4,
                                    pointRadius: 3,
                                    pointBackgroundColor: 'rgba(239, 68, 68, 1)'
                                },
                                {
                                    label: 'Humidity (%)',
                                    data: hums,
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                    borderWidth: 2,
                                    tension: 0.4,
                                    pointRadius: 3,
                                    pointBackgroundColor: 'rgba(59, 130, 246, 1)'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        boxWidth: 12,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                    padding: 10,
                                    cornerRadius: 4,
                                    titleFont: {
                                        size: 14
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        drawBorder: false,
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            interaction: {
                                mode: 'nearest',
                                axis: 'x',
                                intersect: false
                            }
                        }
                    });
                })
                .catch(err => console.error("Fetch error: ", err));
        }

        // Initial calls
        updateSensorData();
        loadChartData();

        // Set update intervals
        setInterval(updateSensorData, 5000);  // Update sensor data every 5 seconds
        setInterval(loadChartData, 60000);    // Update chart every minute
    </script>
</body>

</html>
