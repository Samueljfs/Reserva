<?php
include("inc/funcoes.php");

$servername = "localhost";
$username = "root";
$password = "";
$database = "ypua";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $funcionarioId = $_GET["id"];

    $sql = "SELECT * FROM funcionarios WHERE idfunc = $funcionarioId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $funcionario = $result->fetch_assoc();
    } else {
        header("Location: funcionarios.php");
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editarFuncionario"])) {
    $funcionarioId = $_POST["id"];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $cargo = $_POST['cargo'];
    $admissao = $_POST['admissao'];

    $sql = "UPDATE funcionarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', cargo = '$cargo', admissao = '$admissao' WHERE idfunc = $funcionarioId";

    if ($conn->query($sql) === TRUE) {
        header("Location: funcionarios.php?edit=success");
        exit();
    } else {
        echo "Erro ao editar funcionário: " . $conn->error;
    }
}

$conn->close();
?>
