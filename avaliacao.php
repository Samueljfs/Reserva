<?php
session_start();

// ... Seu código existente ...

// Verifica se o formulário de avaliação foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["finalizarBtn"])) {
    // Adiciona 100 pontos ao usuário (simulação)
    if (!isset($_SESSION["pontos"])) {
        $_SESSION["pontos"] = 100;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Itens</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }
        #recompensaContainer {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Fundo escuro */
            z-index: 1000;
        }
        #recompensaBox {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        #recompensaContent {
            margin-top: 20px;
        }

        #recompensaContent h3 {
            color: green;
        }

        #content {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        h2 {
            color: #555;
        }
        .item {
            margin-bottom: 30px;
        }

        .item a{
            color: black;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 12px;
        }
        .rating {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        label {
            font-size: 28px;
            margin-right: 10px;
            cursor: pointer;
            color: #888;
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"] + label {
            cursor: pointer;
        }
        input[type="radio"]:checked + label {
            color: #FFD700;
        }
        #finalizarBtn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        #finalizarBtn:hover {
            background-color: #45a049;
        }
        #recompensaBtn {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        #recompensaBtn:hover {
            background-color: #2980b9;
        }
        #cupomCodigo {
            font-size: 24px;
            color: #E74C3C;
        }

        .fechar {
            color: white;
            background-color: #1E90FF; 
            padding: 9px;
            border-radius: 20px;
            text-decoration: none;
        }

        .fechar:hover {
            color: white;
            background-color: #4169E1; 
            padding: 9px;
            border-radius: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>


    <div id="recompensaContainer">
        <div id="recompensaBox">
            <div id="recompensaContent">
                <h3>Agradecemos pela sua avaliação!</h3>
                <p>Você ganhou um cupom de desconto!</p>
                <p>Seu código de cupom: <strong id="cupomCodigo"></strong></p>
                <a class="fechar" href="perfil.php">Fechar</a>
            </div>
        </div>
    </div>

    <div id="content">

        <h1>Avalie nossa Pousada</h1>

        <div class="item">
            <h2>Recepção</h2> 
            <a>(Atendimento na chegada, Cordialidade dos funcionários)</a>
            <div class="rating">
                <input type="radio" id="item1Star5" name="item1Rating" value="5">
                <label for="item1Star5">&#9733;</label>
                <input type="radio" id="item1Star4" name="item1Rating" value="4">
                <label for="item1Star4">&#9733;</label>
                <input type="radio" id="item1Star3" name="item1Rating" value="3" checked>
                <label for="item1Star3">&#9733;</label>
                <input type="radio" id="item1Star2" name="item1Rating" value="2">
                <label for="item1Star2">&#9733;</label>
                <input type="radio" id="item1Star1" name="item1Rating" value="1">
                <label for="item1Star1">&#9733;</label>
            </div>
        </div>
<hr>
        <div class="item">
            <h2>Acomodação</h2>
            <a>(Limpeza do quarto,
                Conforto da cama,
                Estado geral do quarto)</a>
            <div class="rating">
                <input type="radio" id="item2Star5" name="item2Rating" value="5">
                <label for="item2Star5">&#9733;</label>
                <input type="radio" id="item2Star4" name="item2Rating" value="4">
                <label for="item2Star4">&#9733;</label>
                <input type="radio" id="item2Star3" name="item2Rating" value="3" checked>
                <label for="item2Star3">&#9733;</label>
                <input type="radio" id="item2Star2" name="item2Rating" value="2">
                <label for="item2Star2">&#9733;</label>
                <input type="radio" id="item2Star1" name="item2Rating" value="1">
                <label for="item2Star1">&#9733;</label>
            </div>
        </div>
<hr>
        <div class="item">
            <h2>Geral</h2>
            <a>(Qual a sua satisfação geral com a estadia)</a>
            <div class="rating">
                <input type="radio" id="item3Star5" name="item3Rating" value="5">
                <label for="item3Star5">&#9733;</label>
                <input type="radio" id="item3Star4" name="item3Rating" value="4">
                <label for="item3Star4">&#9733;</label>
                <input type="radio" id="item3Star3" name="item3Rating" value="3" checked>
                <label for="item3Star3">&#9733;</label>
                <input type="radio" id="item3Star2" name="item3Rating" value="2">
                <label for="item3Star2">&#9733;</label>
                <input type="radio" id="item3Star1" name="item3Rating" value="1">
                <label for="item3Star1">&#9733;</label>
            </div>
        </div>
        <hr>


        <button id="finalizarBtn" onclick="exibirRecompensa()">Finalizar</button>

    </div>

    <script>

        function exibirRecompensa() {
            document.getElementById('recompensaContainer').style.display = 'flex';
            gerarCupom();
        }

        function gerarCupom() {
            var cupomCodigo = Math.random().toString(36).substring(7).toUpperCase();
            document.getElementById('cupomCodigo').innerText = cupomCodigo;
        }

        function fecharRecompensa() {
            document.getElementById('recompensaContainer').style.display = 'none';
        }
    </script>

</body>
</html>
