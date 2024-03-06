<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/admin/admin.css">
    <title>Administração - Quinta do Ypuã - Funcionários</title>
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
        <h1>Administração - Quinta do Ypuã - Funcionários</h1>
        <br>
        <a href="\admin\index.php">Voltar</a>
    </header>

    <div class="side-menu">
        <div class="menu-item" onclick="toggleActionsMenu()">Ações</div>
        <div class="menu-item" onclick="viewHistory()">Histórico de Reservas</div>
    </div>

    <section>
        <h2>Funcionários</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Funcionário</th>
                <th>Cargo</th>
                <th>Email</th>
                <th>Data de Admissão</th>
                <th>Horário de trabalho</th>
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

            $sql = "SELECT * FROM funcionarios ORDER BY admissao ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idfunc"] . "</td>";
                    echo "<td>" . $row["nome"] . " " . $row["sobrenome"] . "</td>";
                    echo "<td>" . $row["cargo"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["admissao"] . "</td>";
                    echo "<td>" . $row["turno"] . "</td>";
                    echo "<td>";
                    echo "<div class='actions-dropdown' id='actionsDropdown_" . $row["idfunc"] . "'>";
                    echo "<button onclick='deleteFuncionario(" . $row["idfunc"] . ")'>• Cancelar</button>";
                    echo "<button onclick='editReservation(" . $row["idfunc"] . ")'>• Editar</button>";
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
        <div id="successMessage">Funcionário excluído com sucesso!</div>
    </section>

    <footer>
        <p>&copy; 2023 Quinta do Ypuã</p>
    </footer>

    <script>

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

        function deleteFuncionario(idfunc) {
    var confirmation = confirm("Tem certeza que deseja excluir este funcionário?");
    
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                showSuccessMessageAndReload();
            }
        };
        
        xhttp.open("GET", "excluir_funcionario.php?idfunc=" + idfunc, true);
        xhttp.send();
    }
}

function showSuccessMessageAndReload() {
    var successMessage = document.getElementById('successMessage');
    successMessage.style.display = 'block';

    setTimeout(function () {
        successMessage.style.display = 'none';
        window.location.href = "funcionarios.php";
    }, 2000);
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
    location.href = 'cadastrar_funcionarios.php?edit=' + id;
}


        
        
    </script>
</body>

</html>
