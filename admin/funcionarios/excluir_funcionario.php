<?php
include("inc/conexao.php")

$id = $_GET['idfunc'];

$sql = "DELETE FROM funcionarios WHERE idfunc = $idfunc";

if ($conexao->query($sql) === TRUE) {
    echo "Funcionário excluído com sucesso!";
} else {
    echo "Erro ao excluir funcionário: " . $conexao->error;
}

$conexao->close();
?>
