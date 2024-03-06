<?php
include('..\inc\conexao.php');

if (isset($_GET['idAcm'])) {
    $idAcm = $_GET['idAcm'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $capacidade = $_POST['capacidade'];
        $camas_solteiro = $_POST['camas_solteiro'];
        $camas_casal = $_POST['camas_casal'];
        $facilidades = $_POST['facilidades'];
        $condicoes = $_POST['condicoes'];

        $facilidades = implode(",", $_POST['facilidades']);

        $sql = "UPDATE acomodacoes SET
                nome = '$nome',
                descricao = '$descricao',
                preco = $preco,
                capacidade = $capacidade,
                camas_solteiro = $camas_solteiro,
                facilidades = '$facilidades'
                WHERE idAcm = $idAcm";

        if ($conn->query($sql) === TRUE) {
            echo "Acomodação atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar acomodação: " . $conn->error;
        }
    }

    $existingAcomodacaoQuery = "SELECT * FROM acomodacoes WHERE idAcm = $idAcm";
    $result = $conn->query($existingAcomodacaoQuery);

    if ($result->num_rows > 0) {
        $resultado = $result->fetch_assoc();
    } else {
        echo "Acomodação não encontrada!";
    }
} else {
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.css">
    <title>Cadastro de Acomodações</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body h2{
            margin-top: 5px;
            color: #333;
            margin-left: 20px;
            font-family: 'Arial', sans-serif;
        }

        body a{
            margin-left:20px;
        }

header {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
}

header h1 {
    margin: 0;
    font-size: 24px;
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

.form {
    background-color: #F5F5F5;
    width: 50%;
    margin: 20px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

.form .facilidade-container {
    margin-bottom: 10px;
}

.form input, .form textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.form input[type="checkbox"] + label {
    font-weight: normal;
    display: inline-block;
    margin-bottom: 5px; 
    margin-left: 0;
}

.form label.facilidade-label {
    display: inline-block;
    margin-bottom: 5px;
}

.form input[type="submit"] {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

        
    </style>
</head>
<body>

    <header>
        <h1>Administração - Quinta do Ypuã - Cadastro de Acomodação</h1>
        <br>
        <a href="../index.php">Voltar</a>
    </header>

    <h2>Cadastro de Acomodação</h2> <a href="acomodacoesadmin.php">Ver acomodações</a>
    <form class="form" action="../add/add_acomodacao.php" method="post" enctype="multipart/form-data">

        <label for="nome">Nome da Acomodação:</label>
        <input type="text" value='<?php echo @$resultado['nome'] ?>' id="nome" name="nome" required placeholder="Nome">

        <label for="descricao">Descrição:</label>
        <input type="text" value='<?php echo @$resultado['descricao'] ?>' id="descricao" name="descricao" required placeholder="descricao">

        <label for="preco">Preço:</label>
        <input type="number" value='<?php echo @$resultado['preco'] ?>' id="preco" name="preco" required placeholder="insira somente números">

        <label for="capacidade">Capacidade:</label>
        <input type="number" value='<?php echo @$resultado['capacidade'] ?>' id="capacidade" name="capacidade" required placeholder="">

        <label for="camas_solteiro">Camas de Solteiro:</label>
        <input type="number" value='<?php echo @$resultado['camas_solteiro'] ?>' id="camas_solteiro" name="camas_solteiro" required placeholder="">

        <label for="camas_casal">Camas de Casal:</label>
        <input type="number" value='<?php echo @$resultado['camas_casal'] ?>' id="camas_casal" name="camas_casal" required placeholder="">

        <label for="facilidades">Facilidades:</label><br>
        <?php
        $selectedFacilidades = explode(',', @$resultado['facilidades']);
        $facilidadesOptions = [
            1 => 'Ar Condicionado',
            2 => 'Wifi',
            3 => 'TV',
            4 => 'Cozinha',
            5 => 'Toalhas',
            6 => 'Frigobar',
            7 => 'Banheira',
            8 => 'Ducha'
        ];

        foreach ($facilidadesOptions as $value => $label) {
            $checked = in_array($value, $selectedFacilidades) ? 'checked' : '';
            echo "<div class='facilidade-container'>
                      <input type='checkbox' id='facilidade$value' name='facilidades[]' value='$value' $checked>
                      <label class='facilidade-label' for='facilidade$value'>$label</label>
                  </div>";
        }
        ?>

        <label for="condicoes">Condições:</label>
        <input type="number" value='<?php echo @$resultado['condicoes'] ?>' id="condicoes" name="condicoes" required placeholder="mínimo de diárias">

        <label for="imagens">Imagens da Acomodação:</label>
        <input type="file" value='<?php echo @$resultado['img'] ?> 'name="imagens[]" accept="image/*" multiple>

        <input type="hidden" name="idAcm" value="<?php echo @$resultado['idAcm'] ?>">
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
