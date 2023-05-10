<?php
    include_once('../config.php');

    if(isset($_POST['update'])){

        $id = $_POST['id'];
        $nome= $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];


        $sqlUpdate = "UPDATE editora SET nome = '$nome', telefone = '$telefone', email = '$email' WHERE id= '$id'";

        $result = $conexao -> query($sqlUpdate);
        
    }
    header('Location: ../editora.php');
?>