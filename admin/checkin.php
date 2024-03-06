<?php
include("inc/funcoes.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .loading-message {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .fa-spinner {
            animation: spin 1s infinite linear;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<?php
if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    $message = realizarCheckIn($reservationId);

    if (strpos($message, 'sucesso') !== false) {
        echo "<div id='successMessage' class='success-message'>";
        echo "<p>{$message}</p>";
        echo "</div>";
        echo "<script>setTimeout(function() { window.location.href = '../admin/reservas/reservas.php'; }, 2000);</script>";
    } else {
        echo $message;
    }
}
?>
