<?php
include('../inc/conexao.php');
include('../inc/funcoes.php');

$acao = null;

if(isset($_GET['acao']) && $_GET['acao'] == 'pagar'){
    $existingReservationQuery = "UPDATE reservas SET status='1' WHERE idHosp = ".$_GET['id'];
    $existingReservationResult = $conn->query($existingReservationQuery);

    header('Location: /admin/reservas/reservas.php');
    exit();
}

$reservationNumber = 0;
$guestName = $guestPhone = $cpf = $guestEmail = $checkInDate = $checkOutDate = $adults = $children = $acmID = $paymentMethod = $status = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guestName = $_POST["guestName"];
    $guestPhone = $_POST["guestPhone"];
    $cpf = $_POST["cpf"]; 
    $guestEmail = $_POST["guestEmail"];
    $checkInDate = $_POST["checkInDate"];
    $checkOutDate = $_POST["checkOutDate"];
    $adults = $_POST["adults"];
    $children = $_POST["children"];
    $acmID = isset($_POST["accommodationId"]) ? $_POST["accommodationId"] : "";
    $paymentMethod = $_POST["pagamento"];
    $status = "0";

    $existingReservationQuery = "SELECT idhosp, acmID FROM reservas WHERE cpf = '$cpf'";
    $existingReservationResult = $conn->query($existingReservationQuery);

    if ($existingReservationResult->num_rows > 0) {
        $row = $existingReservationResult->fetch_assoc();
        $existingReservationId = $row["idhosp"];

        $sql = "UPDATE reservas SET guestName='$guestName', guestPhone='$guestPhone', guestEmail='$guestEmail', checkInDate='$checkInDate', checkOutDate='$checkOutDate', adults='$adults', children='$children', acmID='$acmID', paymentMethod='$paymentMethod', status='$status' WHERE idhosp='$existingReservationId'";
        $message = "Reserva alterada com sucesso!";
        $acao = 'update';
    } else {
        $sql = "INSERT INTO reservas (guestName, guestPhone, cpf, guestEmail, checkInDate, checkOutDate, adults, children, acmID, paymentMethod, status) 
            VALUES ('$guestName', '$guestPhone', '$cpf', '$guestEmail', '$checkInDate', '$checkOutDate', '$adults', '$children', '$acmID', '$paymentMethod', '$status')";
        $message = "Reserva realizada com sucesso!";
        $acao = 'insert';
    }

    if ($conn->query($sql) === TRUE) {
        $reservationNumber = ($_POST["id"]) ? $_POST['id'] : $conn->insert_id;
        
    } else {
        echo "Erro ao adicionar/editar reserva: " . $conn->error;
    }
}

$duration = date_diff(date_create($checkInDate), date_create($checkOutDate))->format("%a");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Reserva</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            text-align: center;
            margin: 20px;
        }

        h2 {
            color: #28a745;
        }

        .success-icon {
            color: #28a745;
            font-size: 48px;
        }

        .details-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        p {
            margin: 10px 0;
        }

        button {
            padding: 12px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            margin: 10px;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php
    if ($acao=='update') {
    ?>
        <div class="details-container">
            <h2><?php print $message ?></h2>
            <button onclick="location.href='/admin/reservas/reservar.php'">Fazer Nova Reserva</button>
            <button onclick="location.href='/admin/index.php'">Home</button>
        </div>

    <?php
    }
    else{
    ?>
        <div class="details-container">
    <i class="fas fa-check-circle success-icon"></i>
    <h2>Reserva realizada com sucesso!</h2>
    
    <?php if (isset($reservationNumber)): ?>
        <p>Número da Reserva: <?php echo $reservationNumber; ?></p>
    <?php endif; ?>
    
    <?php if (isset($guestName)): ?>
        <p>Nome do Hóspede: <?php echo $guestName; ?></p>
    <?php endif; ?>
    
    <?php if (isset($duration)): ?>
        <p>Duração da Estadia: <?php echo $duration; ?> dias</p>
    <?php endif; ?>
    
    <?php if (isset($accommodationType)): ?>
        <p>Acomodação: <?php echo $accommodationType; ?></p>
    <?php endif; ?>
    
    <?php if (isset($paymentMethod)): ?>
        <p>Forma de Pagamento: <?php echo $paymentMethod; ?></p>
    <?php endif; ?>
    
    <button onclick="location.href='/reservas/reservar.php'">Fazer Nova Reserva</button>
    <button onclick="location.href='/admin/index.php'">Home</button>
</div>

    <?php
    }
    ?>
</body>
</html>
