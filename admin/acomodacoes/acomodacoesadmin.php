<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Administração - Acomodações</title>

    <style>
        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        header a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        header a:hover {
            color: #ffcc00;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .card {
            width: 300px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: transform 0.3s;
            overflow: hidden;
            position: relative;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-body {
            padding: 0;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-inner {
            height: 200px;
        }

        .carousel-item {
            text-align: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            padding: 10px;
        }

        .card-text {
            margin-bottom: 10px;
            padding: 10px;
        }

        label {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            outline: none;
            transition: border-color 0.3s;
        }

        select:hover,
        select:focus {
            border-color: #2684ff;
        }

        option {
            font-size: 16px;
        }


        .status-label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 5px;
            z-index: 1;
        }

        .status-label[data-status="1"] {
            margin-top: 12px;
            margin-left: 5px;
            color: white;
            background-color: green;
            padding: 5px;
            border-radius: 20px;
        }

        .status-label[data-status="0"] {
            margin-top: 12px;
            margin-left: 5px;
            color: white;
            background-color: red;
            padding: 5px;
            border-radius: 20px;
        }

        .bot{
            font-size: 20px;
            margin-left:10%;
        }

        .edit{
            margin-left: 10px;
        }

        .btn-excluir {
            color: red;
            text-align: end;
        }
    </style>
</head>
<body>

    <header>
        <h1>Administração - Quinta do Ypuã - Acomodações</h1>
        <br>
        <a href="../index.php">Voltar</a>
    </header>

    <a class="bot" href="cadastrar_acomodacao.php">Cadastrar Acomodação</a>


    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ypua";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM acomodacoes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagens = explode(",", $row["img"]);

                echo '<div class="card">
                        <div id="carousel-' . $row["idAcm"] . '" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">';
                $first = true;
                foreach ($imagens as $key => $imagem) {
                    echo '<div class="carousel-item ' . ($first ? 'active' : '') . '">
                            <img src="../add/img_acomodacoes/' . $imagem . '" class="d-block w-100" alt="Imagem ' . $key . '">
                          </div>';
                    $first = false;
                }
                echo '</div>
                        <a class="carousel-control-prev" href="#carousel-' . $row["idAcm"] . '" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-' . $row["idAcm"] . '" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                      </div>
                      <div class="card-body">
                    <span class="status-label" id="status-label-' . $row["idAcm"] . '" data-status="' . $row["status"] . '">' . ($row["status"] == 1 ? 'Ativado' : 'Desativado') . '</span>
                          <h5 class="card-title">' . $row["nome"] . '</h5>
                          <p class="card-text" id="descricao-' . $row["idAcm"] . '">Descrição: ' . substr($row["descricao"], 0, 100) . '... <a href="#" onclick="verMais(' . $row["idAcm"] . ')">Ver Mais</a></p>
                          <p class="card-text">Status: <select class="status-selector" id="status-' . $row["idAcm"] . '" data-acm-id="' . $row["idAcm"] . '" name="status">
                                <option disabled selected>- Selecione -</option>
                                <option value="0" ' . '>Desativar</option>
                                <option value="1" ' . '>Ativar</option>
                            </select></p>
                            
                            
                          <a class="edit" href="#" onclick="editAcomodacao(' . $row["idAcm"] . ')">Editar </a>';
                            echo '<a class="btn-excluir" href="#" onclick="excluirAcomodacao(' . $row["idAcm"] . ')">Excluir</a>';

                          echo '</div></div>';            }
        } else {
            echo '<p>Nenhuma acomodação encontrada.  <a href="cadastrar_acomodacao.php">Cadastrar Acomodação</a>  </p>';
        }

        $conn->close();
        ?>
    </div>

    <script>

    function excluirAcomodacao(idAcm) {
            if (confirm('Tem certeza que deseja excluir esta acomodação?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'excluir_acomodacao.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        location.reload();
                    } else {
                        console.error('Erro na requisição: ' + xhr.status);
                    }
                };
                xhr.send('idAcm=' + idAcm);
            }
        }

        
    document.addEventListener("DOMContentLoaded", function() {
        var selectors = document.querySelectorAll('.status-selector');

        selectors.forEach(function(selector) {
            selector.addEventListener('change', function() {
                var acmId = this.getAttribute('data-acm-id');
                var newStatus = this.value;

                updateStatusText(acmId, newStatus);

                updateStatus(acmId, newStatus);
            });
        });

    function updateStatusText(acmId, newStatus) {
        var statusLabel = document.getElementById('status-label-' + acmId);
        statusLabel.textContent = (newStatus == 1) ? 'Ativado' : 'Desativado';
    }

    function updateStatus(acmId, newStatus) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'atualizar_status.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
            } else {
                console.error('Erro na requisição: ' + xhr.status);
            }
        };
        xhr.send('acmId=' + acmId + '&newStatus=' + newStatus);
    }
});

    function editAcomodacao(idAcm) {
    location.href = 'cadastrar_acomodacao.php?idAcm=' + idAcm;
}
</script>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>