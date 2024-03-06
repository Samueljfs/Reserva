<?php

$mysqli = new mysqli("localhost", "root", "", "ypua");

if ($mysqli->connect_error) {
    die("Erro de conexão com o banco de dados: " . $mysqli->connect_error);
}

$sql = "SELECT * FROM acomodacoes WHERE status = 1";
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acomodações - Pousada Quinta do Ypuã</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 10px;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 10px auto;
            padding: 20px 0;
            text-align: center;
            background-color: #f5f5f5;
        }

        .accommodations {
            background-color: #f5f5f5;
            padding: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px; /* Aumentando o espaçamento inferior para 30px */
            background-color: #8b0000; /* Alterando a cor de fundo */
            padding: 15px; /* Adicionando padding */
            border-radius: 8px; /* Adicionando bordas arredondadas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4); /* Adicionando sombra */
        }

        .filter-container label,
        .filter-container select,
        .filter-container input {
            color: #000; /* Alterando a cor do texto para branco */
            margin: 5px;
            padding: 8px;
            border: none; /* Adicionando borda branca */
            border-radius: 4px; /* Adicionando bordas arredondadas */
        }

        .filter-container button {
            padding: 8px 15px;
            background-color: #fff;
            color: #333; /* Alterando a cor do texto para preto */
            border: none;
            cursor: pointer;
            border-radius: 4px; /* Adicionando bordas arredondadas */
            background-color: #fff;
        }

        .filter-container button:hover {
            background-color: #555;
        }

        .accommodation-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .accommodation {
            width: calc(75% - 30px);
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 2px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
            text-decoration: none;
            color: #000;
            display: flex;
            flex-direction: row;
        }

        .accommodation:hover {
            transform: scale(1.05);
        }

        .accommodation img {
            width: 50%;
            height: 200px;
            object-fit: cover;
        }

        .accommodation-content {
            padding: 10px;
            box-sizing: border-box;
            background-color: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 50%;
        }

        .accommodation h3 {
            text-align: center;
            margin: 5px 0;
            color: #000;
            background-color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 24px;
            font-weight: bold;
        }

        .icons-container {
            display: flex;
            justify-content: center;
            text-decoration: none;
            color: #000;
        }

        .accommodation i {
            margin: 5px;
            font-size: 23px;
        }

        .accommodation p {
            text-align: center;
            color: #000;
            text-decoration: none;
        }

        .btn-detalhes {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-detalhes:hover {
            background-color: #555;
        }

        footer {
            padding: 100%;
        }

        .title-container {
            font-family: 'Arial', sans-serif;
            background-color: #fff;
            display: inline-block;
            padding: 10px;
            border-radius: 2px;
            margin-bottom: 20px;
            color: #000;
            margin-top: 20px;
            color: #000;
            font-size: 24px;
            font-weight: bold;
        }

        .accommodations label{
            color: white;
        }

        .tooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background: #333;;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -60px;
        opacity: 0;
        transition: opacity 0.3s;
        font-size: 14px;
        font-family: 'Arial', sans-serif;
        font-weight: bold;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
        color: white;
    }

    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="accommodations">
        <div class="container">
            <div class="filter-container">
                <label for="numAdults">Adultos:</label>
                <input type="number" id="numAdults" name="numAdults" min="1" max="5">

                <label for="numChildren">Crianças:</label>
                <input type="number" id="numChildren" name="numChildren" min="0" max="3">

                <label for="checkInDate">Check-in:</label>
                <input type="date" id="checkInDate" name="checkInDate">

                <label for="checkOutDate">Check-out:</label>
                <input type="date" id="checkOutDate" name="checkOutDate">

                <button onclick="filterAccommodations()">Filtrar</button>
            </div>

            <div class="title-container">Nossas Acomodações</div>

            <div class="accommodation-list">
            <?php
                $facilitiesIcons = [
                    1 => '<i class="fas fa-snowflake"></i>', // ar-condicionado
                    2 => '<i class="fas fa-wifi"></i>',       // wifi
                    3 => '<i class="fas fa-tv"></i>',          // tv
                    4 => '<i class="fas fa-utensils"></i>',    // cozinha
                    5 => '<i class="fas fa-hand-paper"></i>',  // toalhas
                    6 => '<i class="fas fa-flask"></i>',        // frigobar
                    7 => '<i class="fas fa-bath"></i>',         // banheira
                    8 => '<i class="fas fa-shower"></i>'        // ducha
                ];

                while ($row = $result->fetch_assoc()) {
                ?>

        <a href="detalhes_acomodacao.php?idAcm=<?php echo $row['idAcm']; ?>" class="accommodation">
                        
                        
                    <?php
                    
                        $images = explode(',', $row['img']);

                        if (!empty($images)) {
                        ?>
                            <img src="/admin/add/img_acomodacoes/<?php echo $images[0]; ?>" alt="<?php echo $row['nome']; ?>">
                        <?php } 
                        ?>                        
                        <div class="accommodation-content">
                            <h3><?php echo $row['nome']; ?></h3>
                            <p>
                                <?php
                                $facilities = explode(',', $row['facilidades']);
                                
                                foreach ($facilities as $facility) {
                                    $facilityNumber = intval($facility);
                                    if (isset($facilitiesIcons[$facilityNumber])) {
                                        echo $facilitiesIcons[$facilityNumber];
                                    }
                                }
                                ?>
                            </p>
                            <p>Preço: R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?> por noite</p>
                        </div>
                        
                    </a>
                <?php
                }
                $mysqli->close();
                ?>

            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
        function filterAccommodations() {
        }

        
    </script>
</body>

</html>