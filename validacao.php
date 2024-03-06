<?php
session_start();

$email = $_POST['email'];
$senha = $_POST['password'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ypua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "SELECT id, senha, permissao FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $idUsuario = $row['id'];
    $senhaCriptografada = $row['senha'];
    $permissao = $row['permissao'];

    if (password_verify($senha, $senhaCriptografada)) {
        $_SESSION['logado'] = true;
        $_SESSION['idUsuario'] = $idUsuario;

        if ($permissao == 0) {
            header("Location: perfil.php");
            exit();
        } elseif ($permissao == 1) {
            header("Location: /admin/index.php");
            exit();
        } else {
            echo "<script>alert('Permissão inválida.');</script>";
        }
    } else {
        echo "<script>alert('Senha incorreta.');</script>";
        header("Location: login.php");
        exit();
    }
} else {
    echo "<script>alert('E-mail não encontrado.');</script>";
    header("Location: login.php");
    exit();
}

$stmt->close();
$conn->close();
?>
