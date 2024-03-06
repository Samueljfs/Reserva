<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Adicione a biblioteca do Bootstrap para o carrossel -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-menu li {
            margin: 0 15px;
        }

        .nav-link {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #8b0000; /* Cor quando hover */
        }

        form {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px; /* Novo ajuste: Limita a largura do formulário */
            margin: 0 auto; /* Novo ajuste: Centraliza o formulário */
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        small {
            display: block;
            margin-top: 5px;
            color: #888;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        button:disabled {
            background-color: #ddd;
            color: #999;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <?php include 'header.php'?>

    <div class="container mt-4">
        <h2>Detalhes de Pagamento</h2>

        <!-- Parte 1: Informações Pessoais -->
        <form action="/processar_info_pessoais" method="post">
            <!-- Campos para informações pessoais -->
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="email">Endereço de E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Parte 2: Informações de Pagamento -->
            <div class="form-group">
                <label for="tipo_pagamento">Forma de Pagamento:</label>
                <select class="form-control" id="tipo_pagamento" name="tipo_pagamento" onchange="mostrarFormulario()">
                    <option disabled selected>- Selecione -</option>
                    <option value="cartao">Cartão de Crédito</option>
                    <option value="pix">PIX</option>
                    <option value="boleto">Boleto Bancário</option>
                </select>
            </div>

            <!-- Container para exibir dinamicamente o formulário correspondente -->
            <div id="formularioPagamento"></div>

            <!-- Botões de navegação -->
            <button type="button" class="btn btn-success" onclick="mostrarFormulario()">Próximo</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function mostrarFormulario() {
            var tipoPagamento = document.getElementById('tipo_pagamento').value;
            var formularioContainer = document.getElementById('formularioPagamento');
            formularioContainer.innerHTML = ''; // Limpa o conteúdo anterior

            if (tipoPagamento === 'cartao') {
                // Adicione campos específicos para cartão de crédito
                formularioContainer.innerHTML = `
                    <div class="form-group">
                        <label for="numero_cartao">Número do Cartão:</label>
                        <input type="text" class="form-control" id="numero_cartao" name="numero_cartao" pattern="[0-9]{16}" placeholder="16 dígitos" required>

                        <label for="codigo_seguranca">Código de Segurança:</label>
                        <input type="text" class="form-control" id="codigo_seguranca" name="codigo_seguranca" pattern="[0-9]{3,4}" placeholder="3 ou 4 dígitos" required>

                        <label for="nome_titular">Nome do Titular do Cartão:</label>
                        <input type="text" class="form-control" id="nome_titular" name="nome_titular" placeholder="Nome no cartão" required>

                        <label for="data_validade">Data de Validade:</label>
                        <input type="text" class="form-control" id="data_validade" name="data_validade" placeholder="MM/AAAA" pattern="(0[1-9]|1[0-2])\/[0-9]{4}" placeholder="MM/AA" required oninput="formatarDataValidade(this)">

                    </div>`;
            } else if (tipoPagamento === 'pix') {
                // Exemplo de geração de QR Code (necessita de uma biblioteca apropriada)
                var chavePix = "sua_chave_pix"; // Substitua com sua chave PIX
                var qrcodeCanvas = document.createElement('canvas');
                var qrcode = new QRCode(document.getElementById("formularioPagamento"),{
                    text: chavePix,
                    width: 140,
                    height: 140,
                    
                   
                    
                    
                });
            } else if (tipoPagamento === 'boleto') {
                formularioContainer.innerHTML = `
                    <div class="form-group">
                        <!-- Adicione campos específicos para boleto -->
                    </div>`;
                formularioContainer.innerHTML += `<div>Código de Barras: 12345678901234567890123456789012345678901234</div>`;
            }
        }

        function formatarDataValidade(input) {
        // Adiciona barras automaticamente enquanto o usuário digita
        var valorAtual = input.value.replace(/\D/g, '');
        if (valorAtual.length > 2) {
            input.value = valorAtual.substring(0, 2) + '/' + valorAtual.substring(2);
        }
    }
    </script>

</body>

</html>
