<?php 
    if(!empty($_GET['id'])){
        include_once('../config.php');
        
        date_default_timezone_set('America/Sao_Paulo');

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM aluguel WHERE id = $id";
        $resultSelect = $conexao -> query($sqlSelect);

        $aluguel_data = mysqli_fetch_assoc($resultSelect);
        $livro = $aluguel_data['livro'];

        $hoje = new DateTime();
        $hoje2 = $hoje -> format('d/m/Y');

           // Conexão tabela Livros
           $sqllivro_conect = "SELECT * FROM livro WHERE nome = '$livro'";
           $resultlivro_conect = $conexao -> query($sqllivro_conect);
   
           $livro_data = mysqli_fetch_assoc($resultlivro_conect);
           $nomeLivro_BD = $livro_data['nome'];   
           $quantidade_BD = $livro_data['estoque'];
           $quantidade_nova = $quantidade_BD + 1;
           
           $sqlAlterar = "UPDATE livro SET estoque = '$quantidade_nova' WHERE nome = '$nomeLivro_BD'";
           $sqlResultAlterar = $conexao -> query($sqlAlterar);
   
           if($resultSelect -> num_rows > 0){
               $sqlUpdate = "UPDATE aluguel SET data_devo = '$hoje2' WHERE id = $id";
               $resultUpdate = $conexao -> query($sqlUpdate);
           }
           else{
               header('Location: ../aluguel.php');
           }
           header('Location: ../aluguel.php');

        
        
    }

        
?>