<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os novos campos do formulário
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    $userId = $_SESSION['id']; // Substitua 'user_id' pelo nome correto do campo de ID do usuário
    $sqlUpdate = "UPDATE usuarios SET cpf = '$cpf', email = '$email', endereco = '$endereco' WHERE id = $userId";

    // ... Executar a consulta e verificar erros ...

    // Redirecionar de volta para o perfil
    header("Location: perfil.php");
    exit();
}
?>
