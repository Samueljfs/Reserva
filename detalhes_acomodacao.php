<?php
$mysqli = new mysqli("localhost", "root", "", "ypua");

if ($mysqli->connect_error) {
    die("Erro de conexão com o banco de dados: " . $mysqli->connect_error);
}

$idAcm = isset($_GET['idAcm']) ? $_GET['idAcm'] : null;

if ($idAcm === null) {
    header("Location: acomodacoes.php");
    exit();
}

$sql_acomodacao = "SELECT * FROM acomodacoes WHERE idAcm = $idAcm";
$result = $mysqli->query($sql_acomodacao);

if (!$result || $result->num_rows === 0) {
    header("Location: acomodacoes.php");
    exit();
}

$row_acomodacao = $result->fetch_assoc();

$facilidades_map = [
    1 => 'Ar Condicionado',
    2 => 'Wifi',
    3 => 'TV',
    4 => 'Cozinha',
    5 => 'Toalhas',
    6 => 'Frigobar',
    7 => 'Banheira',
    8 => 'Ducha'
];

$facilidades_numero = explode(',', $row_acomodacao['facilidades']);
$facilidades_nomes = array_map(function ($numero) use ($facilidades_map) {
    return $facilidades_map[$numero];
}, $facilidades_numero);

$img_names = explode(',', $row_acomodacao['img']);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <title>Detalhes da Acomodação - Pousada Quinta do Ypuã</title>
</head>
<style>
     body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            color: #343a40;
        }

        main {
            margin: 20px;
        }

        .accommodation-details {
            background-color: white;
            padding: 100px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .carousel-inner {
            text-align: center;
        }

        .detalhes {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 25px;
        }

        h2 {
            color: black;
            margin-bottom: 10px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        p {
            line-height: 1.6;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 18px;
            color: black;
            font-weight: bold;
        }

        .date-input {
            display: flex;
            flex-direction: column;
        }

        .date-input label {
            margin-bottom: 5px;

        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
        }

        .date-group-inline {
            display: flex;
            justify-content: space-between;
        }

        .price-heading {
            color: black;
            margin-top: 20px;
            font-size: 24px;
        }

        .price-info {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .book-now-btn {
            background-color:  #8B4513;
            color: #ffffff;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .book-now-btn:hover {
            background-color: #218838;
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .date-group-inline {
            display: flex;
            justify-content: space-between;
        }

        .book-now {
            background-color: #28a745;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .book-now:hover {
            background-color: #218838;
        }

        .miniaturas-carousel {
            display: flex;
            justify-content: center;
            gap: 10px;
            height: 200px;
        }

        .miniaturas-carousel img {
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 4px;
            transition: border-color 0.3s ease;
            width: 100px;

        }

        .miniaturas-carousel img:hover {
            border-color: #007bff;
        }

        .detalhes h5 {
            color: black;
            font-family: Arial, sans-serif;
            text-align: left;
            margin-top: 10px;

        }

        input[type="date"] {
            width: 150px;
            margin: 0 auto; 
            display: block;
        }

        #carouselImagens .carousel-inner img.img-carousel {
    width: 100%; /* Tamanho fixo desejado */
    height: 400px; /* Tamanho fixo desejado */
    object-fit: cover;
}

/* Estilo para as miniaturas também */
.miniaturas-carousel img.miniatura {
    width: 65px; /* Tamanho fixo desejado */
    height: 65px; /* Tamanho fixo desejado */
    object-fit: cover;
}

.desc{
    text-align: justify;
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin-top: 10px;

    .comodidades {
    font-family: Arial, sans-serif;
    /* Adicione outras propriedades de estilo conforme necessário */
}


}
</style>

<body>
    <?php include 'header.php'; ?>

    <main class="container">
        <section class="accommodation-details">
            <h2><?php echo $row_acomodacao['nome']; ?></h2>

            <div id="carouselImagens" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($img_names as $index => $img_name): ?>
                        <div class="carousel-item <?= ($index === 0) ? 'active' : '' ?>">
                            <img src="/admin/add/img_acomodacoes/<?= $img_name ?>" class="d-block w-100 img-carousel" alt="Imagem <?= $index + 1 ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controles do carousel -->
            </div>

            <div class="miniaturas-carousel">
                <?php foreach ($img_names as $index => $img_name): ?>
                    <div data-target="#carouselImagens" data-slide-to="<?= $index ?>" class="<?= ($index === 0) ? 'active' : '' ?>">
                        <img src="/admin/add/img_acomodacoes/<?= $img_name ?>" class="miniatura img-carousel" alt="Imagem <?= $index + 1 ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="detalhes">
                <div class="desc">
                    <h5>Descrição</h5>
                    <a><?= $row_acomodacao['descricao'] ?></a>
                </div>
                <hr>

                <div class="comodidades">
                    <h5>Comodidades</h5>
                    <?php foreach (array_slice($facilidades_nomes, 0, 3) as $facilidade_nome): ?>
                        ▪ <?= $facilidade_nome ?> 
                    <?php endforeach; ?>
                </div>
                <hr>

                <div class="condicoes">
                    <h5>Condições</h5>
                    <?= "Mínimo de noites: " . $row_acomodacao['condicoes'] ?>
                </div>
                <hr>

                <ul>
                    <!-- Formulário de datas -->
                </ul>

                <h2 class="price-heading">Preço</h2>
                <p class="price-info">R$ <?= number_format($row_acomodacao['preco'], 2, ',', '.') ?> por noite</p>

                <a href="check-out.php" class="book-now-btn">Reservar Agora</a>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <script>
       function goBack() {
        window.history.back();
    }
    function setMinCheckOutDate() {
        var checkInDateInput = document.getElementById("checkInDate");
        var checkOutDateInput = document.getElementById("checkOutDate");

        checkOutDateInput.min = checkInDateInput.value;
    </script>
</body>

</html>
