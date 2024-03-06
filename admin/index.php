<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

include('inc/conexao.php');
include('inc/funcoes.php');



include('inc/verificar_login.php');

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Administração - Quinta do Ypuã</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f5f5;
        color: #333;
        margin: 0;
    }

header {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 5px;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    max-width: 800px;
    margin: 0 auto;
    margin-bottom: 2%;
}

.card {
    flex: 1;
    max-width: 300px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.05);
}

.card h2 {
    margin-bottom: 10px;
    color: red;
}

.card a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: transform 0.3s ease-in-out;
}

.card a:hover {
    color:red;
    transform: scale(1.05);
}

.card p {
    color: #666;
}



footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
    margin-top: 20px;
}

.reservasAtuais {
    margin-bottom: 5%;
}

.charts-container {
    display: flex;
    justify-content: space-around;
    max-width: 500px;
    margin: 0 auto;
}

.chart {
    flex: 1;
    max-width: 300px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    transition: transform 0.3s ease-in-out;
}

.chart:hover {
    transform: scale(1.05);
}



    </style>
</head>
<body>
    
<header>
    <h1>Administração - Quinta do Ypuã</h1>
    <a href="?logout=1">Sair</a>
</header>



    <main class="card-container">
        <div class="card">
            <h2><a href="\admin\reservas\reservar.php">Fazer Reserva</a></h2>
            <p>Realize uma nova reserva para os hóspedes.</p>
        </div>

        <div class="card">
            <h2><a href="\admin\reservas\reservas.php">Reservas</a></h2>
            <p>Visualize e gerencie as informações das reservas.</p>
        </div>

        <div class="card">
            <h2><a href="\admin\acomodacoes\cadastrar_acomodacao.php">Acomodações</a></h2>
            <p>Gerencie as informações e status das acomodações.</p>
        </div>

        <div class="card">
            <h2><a href="../admin/reservas//historico.php">Histórico</a></h2>
            <p>Veja o histórico de hospedagens e reservas anteriores.</p>
        </div>

        <div class="card">
            <h2><a href="\admin\funcionarios\cadastrar_funcionarios.php">Funcionários</a></h2>
            <p>Cadastro, edição e remoção de funcionários</p>
        </div>
    </main>

    <div class="charts-container">
        <canvas id="chart1" width="300" height="200"></canvas>
        <canvas id="chart2" width="300" height="200"></canvas>
    </div>

    <section class="reservasAtuais">
        <h2>Reservas Atuais</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Reserva</th>
                    <th>Nome do Hóspede</th>
                    <th>Data de Check-in</th>
                    <th>Data de Check-out</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM reservas WHERE checkin = 1";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["idhosp"] . "</td>";
                        echo "<td>" . $row["guestName"] . "</td>";
                        echo "<td>" . $row["checkInDate"] . "</td>";
                        echo "<td>" . $row["checkOutDate"] . "</td>";
                        echo "<td><a href='checkout.php?id=" . $row["idhosp"] . "'>CheckOut</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma reserva atual encontrada.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2023 Quinta do Ypuã</p>
    </footer>

    <script>

document.addEventListener('DOMContentLoaded', function() {
    var data1 = {
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
        datasets: [{
            label: 'Reservas',
            data: [10, 20, 15, 25, 30],
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            fill: false
        }]
    };

    var data2 = {
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
        datasets: [{
            label: 'Avaliações',
            data: [5, 15, 10, 20, 25],
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 2,
            fill: false
        }]
    };

    var ctx1 = document.getElementById('chart1').getContext('2d');
    var chart1 = new Chart(ctx1, {
        type: 'line',
        data: data1,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    var ctx2 = document.getElementById('chart2').getContext('2d');
    var chart2 = new Chart(ctx2, {
        type: 'line',
        data: data2,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script></body>
</html>
