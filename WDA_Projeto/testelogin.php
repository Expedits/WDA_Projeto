<?php
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['nome']) && !empty($_POST['senha'])){

        include_once('config.php');
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM adm WHERE nome= '$nome' and senha = '$senha'";

        $result = $conexao -> query($sql);


        if(mysqli_num_rows($result) < 1){
            unset($_SESSION['nome']);
            unset($_SESSION['senha']);
            header('Location: home.php');
        }
        else{
            $_SESSION['nome'] = $nome;
            $_SESSION['senha'] = $senha;
            header('Location: inicio.php');
        }
    }
    else{
        header('Location: home.php');
    }
?>