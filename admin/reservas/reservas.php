<?php
include("../inc/funcoes.php");

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
    <link rel="stylesheet" href="../admin.css">
    <title>Administração - Quinta do Ypuã - Reservas</title>
    <style>
        .menu-icon {
            font-size: 24px;
            cursor: pointer;
        }

        .side-menu {
            display: none;
            flex-direction: column;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 200px;
            background-color: #333;
            color: white;
            padding-top: 20px;
            transition: width 0.3s ease;
        }

        .menu-item {
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .menu-item:hover {
            background-color: #555;
        }

        @media screen and (max-width: 768px) {
            .side-menu {
                width: 0;
            }

            .menu-item {
                display: none;
            }

            .side-menu.show {
                width: 200px;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        .actions-dropdown button {
            width: 100%;
            padding: 10px;
            text-align: left;
            border: none;
            background-color: inherit;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .actions-dropdown button:hover {
            background-color: #DCDCDC;
        }

        #successMessage {
            display: none;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 10px;
        }

        body {
            margin-bottom: 5%;
        }

        .success-message {
            display: none;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        

    </style>
</head>

<body>
    <header>
        <h1>Administração - Quinta do Ypuã - Reservas</h1>
        <br>
        <a href="../index.php">Voltar</a>
    </header>

    <div class="side-menu">
        <div class="menu-item" onclick="toggleActionsMenu()">Ações</div>
        <div class="menu-item" onclick="viewHistory()">Histórico de Reservas</div>
    </div>

    <section>
        <h2>Próximas Reservas</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome do Hóspede</th>
                <th>Tipo de Acomodação</th>
                <th>Período da Reserva</th>
                <th>Status</th>
                <th>Pagar</th>
                <th>Ações</th> 
            </tr>
            
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "ypua";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM reservas ORDER BY checkInDate ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idhosp"] . "</td>";
                    echo "<td>" . $row["guestName"] . "</td>";
                    echo "<td>" . getAccommodationName($row["acmID"], $conn) . "</td>";
                    echo "<td>" . $row["checkInDate"] . " - " . $row["checkOutDate"] . "</td>";
                    echo "<td>" . statusReserva($row["status"]) . "</td>";
                    echo "<td><a href='/admin/add/add_reservation.php?id=" . $row["idhosp"] . "&acao=pagar'>Pagar</a></td>";
                    echo "<td>";
                    echo "<div class='actions-dropdown' id='actionsDropdown_" . $row["idhosp"] . "'>";
                    echo "<button onclick='deleteReservation(" . $row["idhosp"] . ")'>• Cancelar</button>";
                    echo "<button onclick='editReservation(" . $row["idhosp"] . ")'>• Editar</button>";
                    echo "<button onclick='viewDetails(" . $row["idhosp"] . "," . $row["status"] . ")'>• CheckIn</button>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "Nenhuma reserva cadastrada.";
            }
            ?>
        </table>
        <div id="upcomingReservationsTable"></div>
        <div id="successMessage">Reserva excluída com sucesso!</div>
    </section>

    <footer>
        <p>&copy; 2023 Quinta do Ypuã</p>
    </footer>

    <script>

        function viewDetails(id, status) {
            toggleActionsMenu(id);

            if (status === 1) {
                var confirmation = confirm("Tem certeza que deseja marcar como check-in?");
                if (confirmation) {
                    window.location.href = '/admin/checkin.php?id=' + id;
                }
            } else {
                alert("A reserva precisa ser paga antes de fazer o check-in.");
            }
        }
        function toggleSideMenu() {
            var sideMenu = document.querySelector('.side-menu');
            sideMenu.classList.toggle('show');
        }

        function toggleActionsMenu(id) {
            var actionsDropdown = document.querySelector('#actionsDropdown_' + id);
            var allDropdowns = document.querySelectorAll('.actions-dropdown');

            allDropdowns.forEach(function(dropdown) {
                dropdown.style.display = 'none';
            });

            actionsDropdown.style.display = actionsDropdown.style.display === 'none' ? 'block' : 'none';
        }

        function deleteReservation(reservationId) {
    var confirmation = confirm("Tem certeza que deseja cancelar esta reserva?");
    if (confirmation) {
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'excluir_reserva.php';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'deleteReservation';
        input.value = reservationId;

        form.appendChild(input);
        document.body.appendChild(form);

        form.addEventListener('submit', function() {
            showSuccessMessageAndReload();
        });

        form.submit();
    }
}


function showSuccessMessageAndReload() {
    var successMessage = document.getElementById('successMessage');
    successMessage.style.display = 'block';

    setTimeout(function () {
        successMessage.style.display = 'none';
        window.location.href = "reservas.php";
    }, 2000); 
}


        function editReservation(id) {
            location.href = 'reservar.php?id=' + id;
        }

        function markAsPaid(idPagamento) {
            alert(idPagamento);
            location.href = '/add/add_reservation.php?id=' + id + '&acao=pagar';
        }
        
    </script>
</body>

</html>
