<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <title>Pousada</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  

    <style>
      body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

.header {
    background-color: white;
    color: #DEB887;
    padding: 15px 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
}

header a{
  color: black;

}

.logo img {
    width: 100px;
}

.nav-menu {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.nav-link {
    color: black;
    text-decoration: none;
    margin: 0 15px;
    font-weight: bold;
}

.nav-link:hover {
    color: #DEB887;
  }

@media screen and (max-width: 768px) {
    .nav-menu {
        flex-direction: column;
        align-items: flex-start;
    }

    .nav-link {
        margin: 10px 0;
    }
}

    </style>
</head>

<body>
  <header class="header" id="navigation-menu">
    <div class="container">
      <nav>
        <a href="http://localhost:8085/" class="logo"> <img src="imagens/logo2.webp" alt=""> </a>

        <ul class="nav-menu">
          <li> <a href="index.php" class="nav-link">Home</a> </li>
          <li> <a href="sobre.php" class="nav-link">Sobre</a> </li>
          <li> <a href="acomodacoes.php" class="nav-link">Acomodações</a> </li>

          <li> <a href="faleconosco.php" class="nav-link">Fale Conosco</a></li>
          <li> <a href="login.php" class="nav-link">Entrar</a> </li>

        </ul>
      </nav>
    </div>
  </header>


  
</body>

</html>