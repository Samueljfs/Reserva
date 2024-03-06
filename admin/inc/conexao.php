<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ypua";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

?>