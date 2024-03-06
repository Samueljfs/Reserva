<?php
$acmId = $_POST['acmId'];
$newStatus = $_POST['newStatus'];

$conn = new mysqli("localhost", "root", "", "ypua");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "UPDATE acomodacoes SET status = '$newStatus' WHERE idAcm = '$acmId'";
if ($conn->query($sql) === TRUE) {
    echo "Status atualizado com sucesso!";
} else {
    echo "Erro ao atualizar o status: " . $conn->error;
}

$conn->close();
?>
