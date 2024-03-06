<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário de Contato</title>
  <link rel="stylesheet" href="contato.css">
</head>
<body>
    
    <header class="header">
        <h1 class="logo"></h1>
      </header>
      <section class="home" id="home">
        <div class="head_container">
          <div class="image">
            <img src="imagens/pusada.png.jpg" class="slide">
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
  <div class="container">
    <form action="#" method="post">
      <h2>Entre em Contato </h2>
      <div class="input-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
      </div>
      <div class="input-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>
      </div>
      <div class="input-group">
        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="5" required></textarea>
      </div>
      
      <button type ="submit">Enviar</button>
      <script>
        function goBack() {
    window.history.back();
}
    </script>
      <button class="butao" onclick="goBack()">Voltar</button>
      
    </form>
  </div>

</body>
</html>