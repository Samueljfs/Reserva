<?php
include("../inc/funcoes.php");

if (isset($_POST['deleteReservation'])) {
    $reservationId = $_POST['deleteReservation'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ypua";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $reservationDetails = getReservationDetails($reservationId);

    if ($reservationDetails) {
        $sqlMoveToHistory = "INSERT INTO historico_reservas (idhosp, guestName, guestPhone, cpf, guestEmail, adults, children, paymentMethod, acmID, checkInDate, checkOutDate, status) 
                             VALUES ('{$reservationDetails['idhosp']}', '{$reservationDetails['guestName']}', '{$reservationDetails['guestPhone']}', '{$reservationDetails['cpf']}', '{$reservationDetails['guestEmail']}', '{$reservationDetails['adults']}', '{$reservationDetails['children']}', '{$reservationDetails['acmID']}', '{$reservationDetails['paymentMethod']}', 
                                     '{$reservationDetails['checkInDate']}', '{$reservationDetails['checkOutDate']}', '{$reservationDetails['status']}')";

        if ($conn->query($sqlMoveToHistory) === TRUE) {
            $sqlDeleteReservation = "DELETE FROM reservas WHERE idhosp = $reservationId";

            if ($conn->query($sqlDeleteReservation) === TRUE) {
                echo "Reserva cancelada com sucesso!";
                echo '<div class="loading-message">Redirecionando para a página inicial... <i class="fas fa-spinner"></i></div>';
                echo '<script>setTimeout(function(){ window.location.href = "/admin/index.php"; }, 5000);</script>';
        
            } else {
                echo "Erro ao excluir reserva: " . $conn->error;
                echo '<script>setTimeout(function(){ window.location.href = "reservas.php"; }, 5000);</script>';

            }
        } else {
            echo "Erro ao cancelar a reserva! " . $conn->error;
            echo '<script>setTimeout(function(){ window.location.href = "reservas.php"; }, 5000);</script>';

        }
    } else {
        echo "Reserva não encontrada.";
        echo '<script>setTimeout(function(){ window.location.href = "reservas.php"; }, 5000);</script>';

    }

    $conn->close();
}
?>
