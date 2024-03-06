<?php
include('../inc/conexao.php');
include('../inc/funcoes.php');

$sql = "SELECT * FROM historico_reservas";
$result = $conn->query($sql);

function getAccommodationName($accommodationID, $conn)
{
    $query = "SELECT nome FROM acomodacoes WHERE idAcm = $accommodationID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["nome"];
    }

    return "Acomodação não encontrada";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\admin\admin.css">
    <title>Administração - Quinta do Ypuã - Histórico de Hospedagens</title>
</head>
<body>
    <header>
        <h1>Administração - Quinta do Ypuã - Histórico de Hospedagens</h1>
        <br>
        <a href="\admin\index.php">Voltar</a>
    </header>

    <section>
    <h2>Histórico de Reservas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome do Hóspede</th>
            <th>Tipo de Acomodação</th>
            <th>Período da Reserva</th>
            <th>Status</th>
        </tr>

        <?php
        $sql = "SELECT * FROM historico_reservas";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["idhosp"] . "</td>";
                echo "<td>" . $row["guestName"] . "</td>";
                echo "<td>" . $row["acmID"] . "</td>";
                echo "<td>" . $row["checkInDate"] . " - " . $row["checkOutDate"] . "</td>";
                echo "<td>" . statusReserva($row["status"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Nenhuma reserva no histórico.";
        }
        ?>

    </table>
</section>

    <footer>
        <p>&copy; 2023 Quinta do Ypuã</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
