<?php

function statusReserva($status){
    switch ($status) {
        case 0:
            return "Aguardando confirmação";
            break;
        case 1:
            return "Reserva Paga";
            break;
        case 2:
            return "Reserva Concluída";
            break;
        case 3:
            return "Reserva Cancelada";
            break;
        default:
            return "Erro";
            break;
    } 
}


function realizarCheckIn($reservationId) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ypua";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sqlUpdateCheckin = "UPDATE reservas SET checkin = 1 WHERE idhosp = $reservationId";

    if ($conn->query($sqlUpdateCheckin) === TRUE) {
        echo '<div class="loading-message"> Checkin realizado com sucesso! <i class="fas fa-spinner"></i></div>';

        header("refresh:2; url=/admin/reservas/reservas.php");
    } else {
        return "Erro ao realizar o check-in: " . $conn->error;
    }

    $conn->close();
}

function getReservationDetails($reservationId) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ypua";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM reservas WHERE idhosp = $reservationId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }

    $conn->close();
}

function getFuncionariosDetails($funcionarioId) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ypua";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM funcionarios WHERE idfunc = $funcionarioId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }

    $conn->close();
}
