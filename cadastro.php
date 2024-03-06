<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cadastro</title>
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
    </style>
</head>

<body>

<?php include 'header.php'; ?>

    <div class="container" id="cadastro-container">
        <h2>Cadastrar</h2>
        <form method="POST" action="processar_cadastro.php">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
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

            <div class="form-group-links">
                <a href="login.php">Já tem uma conta? Faça login</a>
            </div>

            <div class="loading-message" id="loadingMessage">Cadastro realizado com sucesso! <i class="fas fa-spinner"></i></div>
        </form>
    </div>

    <?php include 'footer.php'; ?>

    <script src="../assets/Javascript/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>

</html>
