<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sobre a Pousada</title>

    <style>
      body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
      }

      .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
      }

      header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px 0;
      }

      nav {
        display: flex;
        justify-content: space-around;
        background-color: #444;
        padding: 10px 0;
      }

      nav a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
      }

      .about-section {
        background-color: #f8f8f8;
        padding: 40px 0;

        display: block; 
        margin: 0 auto;
      }

      .about-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
      }

      .about-text {
        flex: 1;
      }

      .about-text h2 {
        color: #8B0000;
      }

      .about-text p {
        color: #666;
        line-height: 1.6;
      }

      .about-image {
        flex: 1;
        text-align: center;
      }

      .about-image img {
        width: 100%;
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .small-image {
        width: 100%;
        width: 590px;
        margin: 0 3.5px;
        height: 350px;
        object-fit: cover;
        margin-bottom: 15px;
        cursor: pointer;
        transition: transform 0.3s;
      }

      .horizontal {
        max-width: 100%;
        margin-bottom: 15px;
        cursor: pointer;
      }

      .large-image {
        width: 590px;
        max-width: 100%;
        margin-bottom: 15px;
        cursor: pointer;
        margin: 0 3.5px;
      }

      .about-images::after {
        content: "";
        flex: auto;
      }

      .img1 {
        max-width: 100%;
        margin-bottom: 15px;
        cursor: pointer;
        text-align: center:
      }

    </style>
</head>
<body>

<?php include 'header.php'; ?>

    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Bem-vindo à Pousada Quinta do Ypuã</h2>
                    <p>A pousada Quinta do Ypuã oferece aos seus clientes um recanto de aconchego e lazer, em ambiente rústico e agradável. Ideal para quem gosta de fugir da rotina e procura um local de paz para descansar e curtir a natureza.</p>
                    <p class="testimonial">
                        "O Ypuã tem tudo a ver com a natureza, dá para sentir a energia do lugar. Eu me preocupo se você vai comer bem, dormir bem e se vai se sentir em casa. Vou te mostrar onde encontrar os melhores frutos do mar, onde curtir a melhor praia e as melhores ondas. Mas se você não quiser fazer nada eu também conheço o melhor lugar."<br>
                        <strong>HEITOR, Anfitrião da pousada</strong>
                    </p>
                </div>
                <div class="about-images">
                    <img src="\imagens\24758ae5-9904-48a9-aa37-4d1daba31ea9.JPG" alt="Pousada Quinta do Ypuã" class="img1" style="display: block; margin: 0 auto;"><br>
                    <img src="\imagens\7cfa659a-f3eb-4c6c-b627-bc6c2fd90b32.JPG" alt="Pousada Quinta do Ypuã" class="small-image">
                    <img src="\imagens\9b6213d2-850b-42a1-bfda-2d7b472450a0.JPG" alt="Pousada Quinta do Ypuã" class="small-image">
                    <img src="\imagens\63e9f0ac-d758-40ad-9a85-6a08b085e055.JPG" alt="Pousada Quinta do Ypuã" class="small-image">
                    <img src="\imagens\4179b372-4345-4d19-bf26-646c7640d685.JPG" alt="Pousada Quinta do Ypuã" class="small-image">
                    <img src="\imagens\c56a2966-53a1-4538-9a25-e64779759ca4.JPG" alt="Pousada Quinta do Ypuã" class="horizontal">
                    <img src="\imagens\2225054f-47dc-4845-870b-dfd8a90dc557.JPG" alt="Pousada Quinta do Ypuã" class="large-image">
                    <img src="\imagens\e17ee8d5-28f9-470b-8353-838bf456ead2.JPG" alt="Pousada Quinta do Ypuã" class="large-image">
                    <img src="\imagens\2c8d1f8a-0987-4ae6-9dd3-a9911c656fb5.JPG" alt="Pousada Quinta do Ypuã" class="small-image">

                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
    
</body>
</html>
