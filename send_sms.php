<?php
if (isset($_POST['temperature'])) {
    $temperature = $_POST['temperature'];

    if ($temperature > 35) {
        $botToken = '7575092471:AAFYumiXQvOldhWKGkH-gaCB7enJQZ3jEXU';
        $chatId = '6397840193';
        $message = "⚠️ Alert: Temperature is high at {$temperature}°C!";

        $url = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$chatId}&text=" . urlencode($message);

        $response = file_get_contents($url);
        echo "Telegram message sent!";
    } else {
        echo "Temperature below threshold.";
    }
} else {
    echo "Temperature not received.";
}
