<?php
    include_once('../config.php');

    if(isset($_POST['update'])){

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $editora = $_POST['editora'];
        $data_livro = $_POST['data_livro'];
        $autor= $_POST['autor'];
        $estoque= $_POST['estoque'];

        $sqlUpdate = "UPDATE livro SET nome = '$nome', editora = '$editora',  data_livro = '$data_livro', autor = '$autor', estoque = '$estoque' WHERE id = '$id'";

        $result = $conexao -> query($sqlUpdate);
        
    }
    header('Location: ../livro.php');
?>