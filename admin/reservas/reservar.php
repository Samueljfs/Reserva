<?php
include('../inc/conexao.php');

if(isset($_GET['id'])){
    $existingReservationQuery = "SELECT * FROM reservas WHERE idHosp = ".$_GET['id'];
    $result = $conn->query($existingReservationQuery);   
    $resultado = $result->fetch_assoc();
}

// Buscar acomodações disponíveis
$acomodacoesQuery = "SELECT * FROM acomodacoes WHERE status = 1";
$acomodacoesResult = $conn->query($acomodacoesQuery);

// Array para armazenar as acomodações disponíveis
$acomodacoesDisponiveis = [];

if ($acomodacoesResult->num_rows > 0) {
    while ($row = $acomodacoesResult->fetch_assoc()) {
        $acomodacoesDisponiveis[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Quinta do Ypuã - Reservas</title>
    <style>
body, h1, h2, h3, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    color: #333;
}

header {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    position: relative;
}

header a {
    color: white;
    text-decoration: none;
    margin-right: 20px;
    font-weight: bold;
    transition: color 0.3s ease-in-out;
}

header a:hover {
    color: #ffcc00;
}

.reservation-section {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    margin-bottom: 5%;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #555;
    font-weight: bold;
}

.form-group input,
.form-group select {
    box-sizing: border-box;
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.form-group input:focus,
.form-group select:focus {
    border-color: black;
    outline: none;
}

.date-group {
    display: flex;
    gap: 10px;
}

.date-group-inline {
    display: flex;
    gap: 10px;
}

.date-group label, .date-group-inline label {
    margin-bottom: 0;
}

.button-group {
    text-align: center;
}

button {
    padding: 12px 20px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

button:hover {
    background-color: #555;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
    margin-top: 20px;
}

.quantity-group-inline {
        display: flex;
        gap: 10px;
    }

    .form-group.phone-cpf-group {
        display: flex;
        gap: 10px;
    }

    .form-group.phone-cpf-group label {
        flex: 1;
    }

    .form-group.phone-cpf-group input {
        flex: 2;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    </style>
</head>
<body>
    <header>
        <h1>Administração - Quinta do Ypuã - Reservas</h1>
        <br>
        <a href="/admin/index.php">Voltar</a>
    </header>

    <section class="reservation-section">
        <h2>Adicionar Nova Reserva</h2>
        <br>
        <form action="/admin/add/add_reservation.php" method="post" id="reservationForm">
            <div class="form-group">
                <input type="text" value='<?php echo @$resultado['guestName'] ?>' id="guestName" name="guestName" required placeholder="Nome">
            </div>

            <div class="form-group phone-cpf-group">
                <input type="text" value='<?php echo @$resultado['guestPhone'] ?>' id="guestPhone" name="guestPhone" required placeholder="Telefone">
                <input type="text" value='<?php echo @$resultado['cpf'] ?>' id="cpf" name="cpf" required placeholder="CPF">
            </div>

            <div class="form-group">
                <input type="email" value='<?php echo @$resultado['guestEmail'] ?>' id="guestEmail" name="guestEmail" required placeholder="Email">
            </div>

            <div class="form-group">
                <label for="checkInDate">Check-in:</label>
                <div class="date-group-inline">
                    <input type="date" value='<?php echo @$resultado['checkInDate'] ?>' id="checkInDate" name="checkInDate" required placeholder="Data de Check-in" oninput="setMinCheckOutDate()">
                    <label for="checkOutDate">Check-out:</label>
                    <input type="date" value='<?php echo @$resultado['checkOutDate'] ?>' id="checkOutDate" name="checkOutDate" required placeholder="Data de Check-out">
                </div>
            </div>

            <div class="form-group">
                <label for="quantity" class="quantity-group-inline">Quantidade de Hóspedes:</label>
                <div class="quantity-group-inline">
                    <input type="number" value='<?php echo @$resultado['adults'] ?>' id="adults" name="adults" required placeholder="Adultos" min="1" required>
                    <input type="number" value='<?php echo @$resultado['children'] ?>' id="children" name="children" placeholder="Crianças" min="" >
                </div>
            </div>

            <div class="form-group">
                <label for="accommodationId">Selecione a Acomodação:</label>
                <select id="accommodationId" name="accommodationId" required>
                    <option value="" disabled selected>Selecione</option>
                    <?php foreach ($acomodacoesDisponiveis as $acomodacao) : ?>
                        <option value="<?php echo $acomodacao['idAcm']; ?>" <?php echo ($acomodacao['idAcm'] == @$resultado['idAcomodacao']) ? 'selected' : ''; ?>>
                            <?php echo $acomodacao['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="totalAmount">Forma de Pagamento</label>
                <select value='<?php echo @$resultado['pagamento'] ?>' id="pagamento" name="pagamento" required>
                    <option value="pix">PIX</option>
                    <option value="debito">Débito</option>
                    <option value="credito">Crédito</option>
                    <option value="boleto">Boleto</option>
                    <option value="dinheiro">Dinheiro</option>
                </select>
            </div>

            <div class="form-group">
                <input type='hidden' name='id' value='<?php echo @$_GET['id'] ?>'>
                <input type='hidden' name='acao' value='editar'>
                <button type="submit">Salvar Reserva</button>
            </div>
        </form>
    </section>

    <footer>
        <p>&copy; 2023 Quinta do Ypuã</p>
    </footer>

    <script src="script.js"></script>
    <script>
    function setMinCheckOutDate() {
        var checkInDateInput = document.getElementById("checkInDate");
        var checkOutDateInput = document.getElementById("checkOutDate");

        checkOutDateInput.min = checkInDateInput.value;
    }

    function updateMaxGuests() {
        var accommodationTypeSelect = document.getElementById("accommodationType");
        var adultsInput = document.getElementById("adults");
        var childrenInput = document.getElementById("children");

        adultsInput.max = 10;
        childrenInput.max = 10;

        switch (accommodationTypeSelect.value) {
            case "suite":
                adultsInput.max = 3;
                childrenInput.max = 2;
                break;
            case "chale":
                adultsInput.max = 5;
                childrenInput.max = 3;
                break;
            case "cabana":
                adultsInput.max = 3;
                childrenInput.max = 1;
                break;
            case "bus":
                adultsInput.max = 2;
                childrenInput.max = 0;
                break;
            case "parking":
                break;
            default:
                break;
        }
    }

    function validateGuests() {
    var adultsInput = document.getElementById("adults");
    var childrenInput = document.getElementById("children");
    var totalGuests = parseInt(adultsInput.value) + parseInt(childrenInput.value);

    var accommodationTypeSelect = document.getElementById("accommodationType");
    var maxGuests = 10;

    switch (accommodationTypeSelect.value) {
        case "suite":
            maxGuests = 3 + 2;  // 3 adultos + 2 crianças
            break;
        case "chale":
            maxGuests = 5;  // 5 adultos (sem crianças)
            break;
        case "cabana":
            maxGuests = 3 + 1;  // 3 adultos + 1 criança
            break;
        case "bus":
            maxGuests = 2;  // 2 adultos (sem crianças)
            break;
        case "parking":
            break;
        default:
            break;
    }

    if (totalGuests > maxGuests) {
        echo ("Acomodação selecionada não permite tantos hóspedes. Por favor, ajuste a quantidade.");
        return false;
    }

    var guestPhone = document.getElementById("guestPhone").value;
    var cpf = document.getElementById("cpf").value;

    return true;
}

    document.getElementById("accommodationType").addEventListener("change", updateMaxGuests);
        document.getElementById("reservationForm").addEventListener("submit", function(event) {
        if (!validateGuests()) {
            event.preventDefault();
        }
    });

    var guestPhone = document.getElementById("guestPhone").value;
    var cpf = document.getElementById("cpf").value;


    updateMaxGuests();
</script>
</body>
</html>