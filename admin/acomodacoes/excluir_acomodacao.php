<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAcm = isset($_POST['idAcm']) ? $_POST['idAcm'] : null;

    if ($idAcm === null) {
        echo 'Parâmetro inválido.';
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ypua";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sql = "DELETE FROM acomodacoes WHERE idAcm = $idAcm";

    if ($conn->query($sql) === TRUE) {
        echo 'Acomodação excluída com sucesso.';
    } else {
        echo 'Erro ao excluir acomodação: ' . $conn->error;
    }

    $conn->close();
} else {
    echo 'Método de requisição inválido.';
}
?>
