<?php
if(isset($_SESSION['logado'])){
  
    if($_SESSION['logado']!=true){
        echo'Nao logado';
        exit();
        header("Location: /login.php");
    }
}else{
    header("Location: /login.php");
}
?>