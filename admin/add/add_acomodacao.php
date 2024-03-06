<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ypua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$capacidade = $_POST['capacidade'];
$camas_solteiro = $_POST['camas_solteiro'];
$camas_casal = $_POST['camas_casal'];
$facilidades = implode(",", isset($_POST['facilidades']) ? $_POST['facilidades'] : []);
$condicoes = $_POST['condicoes'];

$status = "0";

if($_POST['idAcm']){
    $id_acomodacao = $_POST['idAcm'];
    $sql = "UPDATE acomodacoes SET nome = '$nome', descricao = '$descricao', preco = '$preco', capacidade = '$capacidade', camas_solteiro = '$camas_solteiro', camas_casal = '$camas_casal', facilidades = '$facilidades', condicoes = '$condicoes' WHERE idAcm = $id_acomodacao";
 
}else{
    $sql = "INSERT INTO acomodacoes (nome, descricao, preco, capacidade, camas_solteiro, camas_casal, facilidades, condicoes, status) VALUES ('$nome', '$descricao', $preco, $capacidade, $camas_solteiro, $camas_casal, '$facilidades', '$condicoes', '$status')";

}

if ($conn->query($sql) === TRUE) {

    echo "Acomodação salva com sucesso!";
    echo "Aguarde...";

    $id_acomodacao = $conn->insert_id;

    $imagens_str = "";
    $current_directory = __DIR__;
    $upload_path = $current_directory . "\\img_acomodacoes\\";

    if (!empty($_FILES['imagens']['name'][0])) {
        $file_count = count($_FILES['imagens']['name']);
        
        for ($i = 0; $i < $file_count; $i++) {
            $temp_name = $_FILES['imagens']['tmp_name'][$i];
            $original_name = $_FILES['imagens']['name'][$i];

            $new_name = time() . '_' . $original_name;
            $destination = $upload_path . $new_name;

            if (move_uploaded_file($temp_name, $destination)) {
                $imagens[] = $new_name;
            } else {
                echo "Falha ao mover a imagem: " . $_FILES['imagens']['error'][$i];
            }
        }

        $imagens_str = implode(",", $imagens);
        $sql_imagens = "UPDATE acomodacoes SET img = '$imagens_str' WHERE idAcm = $id_acomodacao";
        $conn->query($sql_imagens);
    }

    header("refresh:2; url=../acomodacoes/acomodacoesadmin.php");
} else {
    echo "Erro ao cadastrar acomodação: " . $conn->error;
}

$conn->close();
?>
