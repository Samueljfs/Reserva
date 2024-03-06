<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ypua";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES ('$nome', '$sobrenome', '$email', '$senha')";

if ($conn->query($sql) === TRUE) {
    echo '<div class="loading-message">Cadastro realizado com sucesso! <i class="fas fa-spinner"></i></div>';

    header("refresh:2; url=login.php");
} else {
    echo "Erro ao cadastrar usuário: " . $conn->error;
}

$conn->close();
?>
