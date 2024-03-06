<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="imagens/logo.png.jpg" type="image/x-icon">

  <style>
.footer {
  background-color: none;
  color: black;
  padding: 10px 0;
  border-left:10%;

}

.container.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2px;
}

.box {
  padding: 30px;
  border-radius: none;
  color: black;
  background-color: white;
}

.payment-box,
.contact-box{
width: 100%;
}

.payment-box h3,
.contact-box h3 {
  color: black;
}

.payment img {
  margin-right: 5px;
}

ul {
  list-style: none;
  padding: 0;
}

ul li {
  margin-bottom: 10px;
}

ul li a {
  color: black;
  transition-duration: 0.5s;
}

ul li a:hover {
  color: #BDB76B;
}

.copyright {
  text-align: center;
  margin-top: 20px;
}

body{
  overflow-x: hidden;
}

  </style>
</head>

<body>
<footer class="footer">
  <div class="container grid top">
    <div class="box payment-box">
      <h3>Formas de Pagamento</h3>
      <div class="payment grid">
        <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa" />
        <img src="https://img.icons8.com/color/48/000000/mastercard.png" alt="Mastercard" />
        <img src="https://img.icons8.com/color-glass/48/000000/paypal.png" alt="PayPal" />
        <img src="https://img.icons8.com/fluency/48/000000/amex.png" alt="American Express" />
      </div>
    </div>

    <div class="box contact-box">
      <h3>Contato</h3>
      <ul>
        <li>Estrada Ipua, nº 6</li>
        <li><a href="mailto:pousadaquintadoypua@gmail.com">pousadaquintadoypua@gmail.com</a></li>
        <li><i class="far fa-phone-alt"></i>(48) 99940-9732 </li>
        <li>Laguna - SC | 88790-000</li>
      </ul>
    </div>
  </div>
  <div class="copyright">
    <p>&copy; Pousada Quinta do Ypuã. Todos os direitos reservados.</p>
  </div>
</footer>


  </body>
</html>