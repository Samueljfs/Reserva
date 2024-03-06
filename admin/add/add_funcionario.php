<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "ypua";


$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$cargo = $_POST['cargo'];
$admissao = $_POST['admissao'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO funcionarios (nome, sobrenome, email, cargo, admissao, senha) VALUES ('$nome', '$sobrenome', '$email', '$cargo', '$admissao', '$senha')";

if ($conexao->query($sql) === TRUE) {
    echo '<div class="loading-message"> Cadastro realizado com sucesso! Aguarde... <i class="fas fa-spinner"></i></div>';

    header("refresh:2; url=funcionarios.php");
} else {
    echo "Erro ao cadastrar funcionário: " . $conexao->error;
}

$conexao->close();
?>
