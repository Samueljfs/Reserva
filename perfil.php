<?php
session_start();

// Verificar se o usuário não está logado e redirecionar para o login
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Recuperar os dados do usuário da sessão

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Perfil do Usuário</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-container img{
            border-radius: 2%;
            width: 200px;
        }

        .profile-image-container {
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            width: 12px; /* Ajuste conforme necessário */
            height: 12px; /* Ajuste conforme necessário */
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h1, h2, h3 {
            color: #333;
        }

        .user-info, .user-details, .user-bookings {
            margin-bottom: 20px;
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

        .user-details {
            display: none;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        strong {
            margin-right: 5px;
        }

        .edit-form {
            display: none;
            margin-top: 15px;
        }

        .edit-form input,
        .edit-form button {
            margin-top: 10px;
        }

        /* Adicionei um estilo para ocultar o input de arquivo */
        #fileInput {
            display: none;
        }

        body h1{
            color: black;
            margin-left: 48%;
        }
    </style>
</head>
<body>
<?php

include'header.php';


function isFutureDate($date) {
    return strtotime($date) > strtotime(date('Y-m-d'));
}

$nomeUsuario = "Rafael de Souza";
$telefoneUsuario = "(31) 1234-5678";
$emailUsuario = "fael244@gmail.com";
$imagemPerfil = "imagens/bill.JPG";

$hospedagens = [
    ["data" => "2024-01-20", "quarto" => "101", "numero_reserva" => "123", "tipo_acomodacao" => "Acabana"],
    ["data" => "2024-02-15", "quarto" => "202", "numero_reserva" => "456", "tipo_acomodacao" => "Bus"],
    ["data" => "2023-12-05", "quarto" => "303", "numero_reserva" => "789", "tipo_acomodacao" => "Chalé Família"],
];
?>
    <h1>Perfil</h1>

<div class="profile-container">
    <!-- Adicionei um label para o input de arquivo -->
    <label for="fileInput" class="profile-image-container">
        <img id="profileImage" src="<?php echo $imagemPerfil; ?>" alt="Imagem de Perfil" class="profile-image">
    </label>
    <!-- Adicionei o input de arquivo -->
    <input type="file" id="fileInput" accept="image/*" onchange="updateProfileImage(this)" />


    <div class="user-info">
        <h2>Dados Pessoais</h2>
        <p><strong>Nome:</strong> <?php echo $nomeUsuario; ?></p>
        <p><strong>Telefone:</strong> <?php echo $telefoneUsuario; ?></p>

        <button id="showDetailsBtn">Mostrar Detalhes</button>
    </div>

    <div class="user-details">
        <h2>Detalhes Adicionais</h2>
        <ul>
            <li><strong>CPF:</strong> 123.456.789-00</li>
            <li><strong>Email:</strong> <?php echo $emailUsuario; ?></li>
            <li><strong>Endereço:</strong>Rua São Mateus, 569, Sion, Belo Horizonte</li>
        </ul>

        <button id="editDetailsBtn">Editar Detalhes</button>
        <button id="cancelEditBtn" style="display: none;">Cancelar</button>

        <!-- Formulário de Edição -->
        <form class="edit-form" action="edit.php" method="post">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="123.456.789-00" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $emailUsuario; ?>" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="Rua São Mateus, 569, Sion, Belo Horizonte" required>

            <button type="submit" name="submit">Salvar Alterações</button>
            
        </form>
    </div>

    <div class="user-bookings">
        <button id="showHistoryBtn">Histórico de Reservas Passadas</button>
        <div id="historyContainer" style="display: none;">
            <h3>Reservas Passadas</h3>
            <ul>
                <?php foreach ($hospedagens as $hospedagem): ?>
                    <?php if (!isFutureDate($hospedagem['data'])): ?>
                        <li>
                            <strong>Data de Check-in:</strong> <?php echo $hospedagem['data']; ?>,
                            <strong>Número da Reserva:</strong> <?php echo $hospedagem['numero_reserva']; ?>,
                            <strong>Acomodação:</strong> <?php echo $hospedagem['tipo_acomodacao']; ?>
                            <a href="avaliacao.php" class="fechar">Avalie</a>
                            <hr>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>


<script>

    function updateProfileImage(input) {
        var profileImage = document.getElementById("profileImage");

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                profileImage.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById("showDetailsBtn").addEventListener("click", function() {
        document.querySelector(".user-details").style.display = "block";
        document.getElementById("editDetailsBtn").style.display = "inline-block";
        document.getElementById("cancelEditBtn").style.display = "none";
    });

    document.getElementById("editDetailsBtn").addEventListener("click", function() {
        document.querySelector(".edit-form").style.display = "block";
        document.getElementById("editDetailsBtn").style.display = "none";
        document.getElementById("cancelEditBtn").style.display = "inline-block";
    });

    document.getElementById("cancelEditBtn").addEventListener("click", function() {
        document.querySelector(".edit-form").style.display = "none";
        document.querySelector(".user-details").style.display = "none";
        document.getElementById("editDetailsBtn").style.display = "inline-block";
        document.getElementById("cancelEditBtn").style.display = "none";
    });

    document.getElementById("showHistoryBtn").addEventListener("click", function() {
        var historyContainer = document.getElementById("historyContainer");
        historyContainer.style.display = historyContainer.style.display === "none" ? "block" : "none";
    });

    document.getElementById("cancelEditBtnForm").addEventListener("click", function() {
        document.querySelector(".edit-form").style.display = "none";
        document.querySelector(".user-details").style.display = "none";
        document.getElementById("editDetailsBtn").style.display = "inline-block";
        document.getElementById("cancelEditBtn").style.display = "none";
    });
    document.getElementById("showDetailsBtn").addEventListener("click", function() {
        document.querySelector(".user-details").style.display = "block";
    });

    document.getElementById("editDetailsBtn").addEventListener("click", function() {
        document.querySelector(".edit-form").style.display = "block";
    });
</script>

</body>
</html>
