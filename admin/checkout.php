<?php
include('inc/conexao.php');
include('inc/funcoes.php');
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

    $sqlMoveToHistory = "INSERT INTO historico_reservas SELECT * FROM reservas WHERE idhosp = $reservationId";
    $resultMoveToHistory = $conn->query($sqlMoveToHistory);

    $sqlDeleteFromReservas = "DELETE FROM reservas WHERE idhosp = $reservationId";
    $resultDeleteFromReservas = $conn->query($sqlDeleteFromReservas);

    if ($resultMoveToHistory && $resultDeleteFromReservas) {
        echo '<div class="loading-message"> Salvando no histórico e redirecionando para a página inicial... <i class="fas fa-spinner"></i></div>';
        echo '<script>setTimeout(function(){ window.location.href = "index.php"; }, 5000);</script>';
    } else {
        echo '<div class="error-message">Erro ao realizar o checkout.</div>';
    }
}
?>

</body>
</html>
