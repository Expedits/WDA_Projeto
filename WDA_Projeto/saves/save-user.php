<?php
    include_once('../config.php');

    if(isset($_POST['update'])){
            $id=$_POST['id'];
            $nome= $_POST['nome'];
            $endereco = $_POST['endereco'];
            $cidade = $_POST['cidade'];
            $email = $_POST['email'];
            $celular = $_POST['celular'];

        $sqlUpdate = "UPDATE usuario SET nome = '$nome', endereco = '$endereco' , cidade = '$cidade', email = '$email', celular= '$celular' WHERE id = '$id'";

        $result = $conexao -> query($sqlUpdate);
        
    }
    header('Location: ../user.php');
?>