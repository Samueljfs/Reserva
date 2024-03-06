<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="icon" href="imagem/logo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="faleconosco.css">
    <link rel="shortcut icon" href="imagens/logo.png.jpg" type="image/x-icon">


    <title>Fale Conosco</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('imagens/Captura.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            color: white;
        }

        h1 {
            margin-top: 0;
            color: white;
        }

        .content-box {
            color: white;
            padding: 40px;
        }

        h2,
        h3,
        h4 {
            color: #FFA500;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        .contact-form {
            color: #333;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 8px;
            border-radius: 8px;
        }

        .contact-form p {
            color: #555;
        }

        .contact-form a,
        .contact-form span {
            font-size: 1.2em;
            color: #007BFF;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .contact-form a:hover {
            text-decoration: underline;
        }

        .social-icons {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .social-icons img {
            width: 50px;
            height: 80px;
            margin-right: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .social-icons img:hover {
            transform: scale(1.2);
        }

        main {
            margin-top: 10%;
        }

        main p{
            color: black;
        }

        .nav-menu a {
            margin-top: -90px;
        }

        .logo {
            margin-top: 10px;
        }

        .social-icons img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .contato {
            max-width: 100px;
            max-height: 80px;
            width: auto;
            height: auto;
        }

        .content-box h2{
            color: #8B0000;
        }
    </style>
</head>


<body>
<?php include 'header.php'; ?>

<main>
        <div class="container content-box">
            <h2>Fale Conosco</h2>
            <p>Queremos ouvir de você! Se você tiver alguma dúvida ou sugestão, estamos aqui para ajudar!</p>

            <div class="contact-form">
                <p>Entre em contato conosco através do e-mail:</p>
                <a href="mailto:pousadaquintadoypua@gmail.com">pousadaquintadoypua@gmail.com</a>
                <p>Ou ligue para nós:</p>
                <span>(48) 99940-9732</span>
            </div>

            <ul>
                <div class="social-icons">
                    <a href="https://www.facebook.com/pousadaquintadoypua" target="_blank">
                        <img src="imagens/facebook.png" alt="Facebook">
                    </a>
                    <a href="http://instagram.com/pousadaquintadoypua" target="_blank">
                        <img src="imagens/instagram.png" alt="Instagram">
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=5548999409732&amp;text=Ol%C3%A1%2C%20vim%20atrav%C3%A9s%20do%20site%20da%20pousada%20e%20tenho%20interesse%20em%20saber%20mais%20informa%C3%A7%C3%B5es." target="_blank">
                        <img src="imagens/whatsapp.png" alt="WhatsApp">
                    </a>
                </div>
            </ul>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
