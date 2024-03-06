<?php
include("../inc/funcoes.php");

$modoEdicao = false;
$funcionarioParaEditar = array();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["edit"])) {
    $funcionarioId = $_GET["edit"];

    $sql = "SELECT * FROM funcionarios WHERE idfunc = $funcionarioId";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $funcionarioParaEditar = $result->fetch_assoc();
        $modoEdicao = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.css">
 
    <style>
        .loading-message {
            display: none;
            text-align: center;
            margin-top: 10px;
        }

        .loading-message i {
            animation: spin 1s infinite linear;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        header {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    position: relative;
}

header a {
    color: white;
    text-decoration: none;
    margin-right: 20px;
    font-weight: bold;
}

header a:hover {
    color: #ffcc00;
}
    </style>
</head>


<body>
    <header>
        <h1>Administração - Quinta do Ypuã - Cadastro de Funcionário</h1>
        <br>
        <a href="\admin\index.php">Voltar</a>
    </header>


    <div class="container" id="cadastro-container">
        <h2>Cadastrar</h2> <a href="funcionarios.php">Ver lista de funcionários</a>
        <form method="POST" action="\admin\add\add_funcionario.php">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($funcionarioParaEditar['nome']) ? $funcionarioParaEditar['nome'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo isset($funcionarioParaEditar['sobrenome']) ? $funcionarioParaEditar['sobrenome'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($funcionarioParaEditar['email']) ? $funcionarioParaEditar['email'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo:</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo isset($funcionarioParaEditar['cargo']) ? $funcionarioParaEditar['cargo'] : ''; ?>" required>
        </div>

            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" class="form-control" id="cargo" name="cargo" required>
            </div>
            <div class="form-group">
                <label for="cargo">Data de Admissão:</label>
                <input type="date" class="form-control" id="admissao" name="admissao" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>

            <div class="form-group form-group-btns text-center">
                <div class="btn-cadastro">
                    <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
                </div>
            </div>

        </form>
    </div>


    <script src="../assets/Javascript/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>

</html>
