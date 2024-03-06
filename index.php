<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "ypua");

if ($mysqli->connect_error) {
    die("Erro de conexão com o banco de dados: " . $mysqli->connect_error);
}

$sql = "SELECT * FROM acomodacoes WHERE status = 1 LIMIT 3";
$result = $mysqli->query($sql);

// Verificar se o usuário está logado
$isUserLoggedIn = isset($_SESSION['logado']);

// Se estiver logado, pegar o ID do usuário
$userId = $isUserLoggedIn ? $_SESSION['idUsuario'] : null;

if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <title>Pousada</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="home.css">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
  
    <link rel="shortcut icon" href="imagens/logo.png.jpg" type="image/x-icon">

    <style>

    .nav-menu .login-link {
      display: <?php echo $isUserLoggedIn ? 'none' : 'inline-block'; ?>;
    }

    .nav-menu .logout-link {
      display: <?php echo $isUserLoggedIn ? 'inline-block' : 'none'; ?>;
    }

    .nav-menu .profile-link {
      display: <?php echo $isUserLoggedIn ? 'inline-block' : 'none'; ?>;
    }

  .box {
      position: relative;
      overflow: hidden;
    }

    .btn-detalhes {
      position: absolute;
      top: 10px;
      right: 10px;
      display: inline-block;
      padding: 8px 16px;
      background-color: #222222;
      color: #DEB887;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .btn-detalhes:hover {
      background-color: #FFF;
      color: #222222;
    }

    .btn-reservar {
      position: absolute;
      top: 10px;
      right: 10px;
      display: inline-block;
      padding: 8px 16px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .btn-reservar:hover {
      background-color: #2E8B57;
    }

    .cookie-banner {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f1f1f1;
        padding: 10px;
        text-align: center;
        display: none;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .cookie-banner p {
        display: inline-block;
        margin: 0;
    }

    .cookie-banner button {
        margin-left: 10px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 3px;
    }
</style>

</head>

<body>
  <header class="header" id="navigation-menu">
    <div class="container">
      <nav>
        <a href="#" class="logo"> <img src="/imagens/logo2.webp" alt=""> </a>

        <ul class="nav-menu">
          <li> <a href="#home" class="nav-link">Home</a> </li>
          <li> <a href="sobre.php" class="nav-link">Sobre</a> </li>
          <li> <a href="acomodacoes.php" class="nav-link">Acomodações</a> </li>

          <li> <a href="faleconosco.php" class="nav-link">Fale Conosco</a></li>
          <li class="login-link"> <a href="login.php" class="nav-link">Entrar</a> </li>
          <li class="logout-link"> <a href="?logout=1" class="nav-link">Sair</a> </li>
          <li class="profile-link"> <a href="perfil.php" class="nav-link">Perfil</a> </li>


        </ul>
      </nav>
    </div>
  </header>
  

  <section class="home" id="home">
    <div class="head_container">
      <div class="image">
        <img src="\img_suite\958e0028-555e-41ad-858b-1d1e961dc009.JPG" class="slide">
      </div>
    </div>
  </section>
  <script>
    function img(anything) {
      document.querySelector('.slide').src = anything;
    }

    function change(change) {
      const line = document.querySelector('.image');
      line.style.background = change;
    }
  </script>

<div id="cookie-banner" class="cookie-banner">
    <p>Este site utiliza cookies. Ao continuar a navegar, você concorda com o uso de cookies.</p>
    <button onclick="aceitarCookies()">Aceitar</button>
    <button onclick="recusarCookies()">Recusar</button>
    <a href="politica.php">Ver Políticas</a>
</div>
   <section class="book">
    <div class="container flex">
      <div class="input grid">
        <div class="box">
          <label>Check-in:</label>
          <input id="checkin" type="date" placeholder="Check-in-Date">
        </div>
        <div class="box">
          <label>Check-out:</label>
          <input id="checkout" type="date" placeholder="Check-out-Date">
        </div>
        <div class="box">
          <label>Adultos:</label> <br>
          <input type="number" placeholder="0">
        </div>
        <div class="box">
          <label>Crianças:</label> <br>
          <input type="number" placeholder="0">
        </div>
      </div>
      <div class="search">
        <input type="submit" value="Buscar">
      </div>
    </div>
  </section>

  <section class="about top" id="vzz">
    <div class="container flex">
      <div class="left">
        <div class="img1">
          <img src="\imagens\31ce9c61-fdb3-4a82-9243-0e63c74b5b3d.JPG" alt="" class="image1">
        </div>
      </div>
      <div class="right">
        <div class="heading">
          <h4 class="descr"><i>O lugar perfeito para suas férias.</i></h4>
          <br>
          <br>
          <br>
          <div class="texto1">
          <h3>Bem-vindo a pousada Quinta do Ypuã</h3>
          <br>
           <p>Nossa pousada oferece uma experiência única para nossos hóspedes, com quartos confortáveis e diversas opções de lazer para todas as idades. </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="room top" id="room">
    <div class="container">
        <div class="heading_top flex1">
            <div class="heading">
                <h5>ELEVANDO O CONFORTO AO NÍVEL MAIS ALTO.</h5>
                <h2>Nossas Acomodações</h2>
            </div>
            <div class="button">
                <a href="acomodacoes.php" class="btn1">VER TUDO</a>
            </div>
        </div>

        <div class="content grid">
            <?php
            while ($row = $result->fetch_assoc()) {
                $facilidades = explode(',', $row['facilidades']);
                $camas_casal = $row['camas_casal'];
                $camas_solteiro = $row['camas_solteiro'];

                $facilidades_map = [
                  1 => 'Ar Condicionado',
                  2 => 'Wifi',
                  3 => 'TV',
                  4 => 'Cozinha',
                  5 => 'Toalhas',
                  6 => 'Frigobar',
                  7 => 'Banheira',
                  8 => 'Ducha',
              ];

                ?>
                <div class="box">
                    <div class="img">
                        <?php
                        $imgNames = explode(',', $row['img']);
                        $imageUrl = '../admin/add/img_acomodacoes/' . $imgNames[0];
                        ?>
                        <div>
                            <img src="<?php echo $imageUrl; ?>" alt="<?php echo $row['nome']; ?>">
                        </div>
                    </div>
                    <div class="text">
                        <h3><?php echo $row['nome']; ?></h3>
                        <p>
                            <span>A partir de : </span>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?><span> Por Noite.
                                <?php
                                  foreach ($facilidades as $facilidade_numero) {
                                      echo '<br>• ' . $facilidades_map[$facilidade_numero];
                                  }
                                  ?>
                                <br>
                            <strong>Camas de Casal:</strong> <?php echo $camas_casal; ?>
                            <br>
                            <strong>Camas de Solteiro:</strong> <?php echo $camas_solteiro; ?>

                        </p>
                    </div>
                </div>
            <?php
            }
            $mysqli->close();
            ?>
        </div>
    </div>
</section>            
 
  <script>
    var accItem = document.getElementsByClassName('accordionItem');
    var accHD = document.getElementsByClassName('accordionIHeading');

    for (i = 0; i < accHD.length; i++) {
      accHD[i].addEventListener('click', toggleItem, false);
    }

    function toggleItem() {
      var itemClass = this.parentNode.className;
      for (var i = 0; i < accItem.length; i++) {
        accItem[i].className = 'accordionItem close';
      }
      if (itemClass == 'accordionItem close') {
        this.parentNode.className = 'accordionItem open';
      }
    }
  </script>



  <section class="gallary mtop " id="gallary">
    <div class="container">
      <div class="heading_top flex1">
        <div class="heading">
          <h5>Quinta Ypuã</h5>
          <h2>Nossa Pousada </h2>
        </div>
      </div>

      <div class="owl-carousel owl-theme">
        <div class="item">
          <img src="imagens/slide2.jpg" alt="">
        </div>
        <div class="item">
          <img src="/imagens/slide3.png" alt="">
        </div>
        <div class="item">
          <img src="imagens/slide4.png" alt="">
        </div>
        <div class="item">
          <img src="imagens/porta2.jpg" alt="">
        </div>
        <div class="item">
          <img src="imagens/interior.jpg" alt="">
        </div>
        <div class="item">
          <img src="imagens/porta.jpg" alt="">
        </div>
        <div class="item">
          <img src="imagens/mesa.jpg" alt="">
        </div>
        <div class="item">
          <img src="\imagens\e88c714f-a3a6-4f26-ac52-0d2d9ea32812.JPG" alt="">
        </div>
        <div class="item">
          <img src="imagens/piscina.jpg" alt="">
        </div>
      </div>

    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="contato.html">
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      dots: false,
      navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2
        },
        1000: {
          items: 4
        }
      }
    })
  </script>

<section class="map top">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3536.988743759389!2d-48.7806435!3d-28.5399126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9521544af4438443%3A0x2a25491fc6f1ec07!2sPousada%20Quinta%20do%20Ypu%C3%A3!5e0!3m2!1sen!2sbr!4v1635247110915!5m2!1sen!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');

    checkinInput.addEventListener("change", function () {
      const checkinDate = new Date(checkinInput.value);
      checkinDate.setDate(checkinDate.getDate() + 1);

      checkoutInput.disabled = false;
      checkoutInput.min = checkinDate.toISOString().split('T')[0];
    });
  });

  function aceitarCookies() {
        document.getElementById('cookie-banner').style.display = 'none';
        // Configurar um cookie para indicar que o usuário aceitou os cookies
        document.cookie = 'cookies_aceitos=1; expires=' + new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';
    }

    function recusarCookies() {
        document.getElementById('cookie-banner').style.display = 'none';
    }

    // Verificar se o usuário já aceitou os cookies ao carregar a página
    document.addEventListener('DOMContentLoaded', function () {
        if (document.cookie.indexOf('cookies_aceitos=1') === -1) {
            document.getElementById('cookie-banner').style.display = 'block';
        }
    });
</script>

<?php include 'footer.php'; ?>
</body>

</html>