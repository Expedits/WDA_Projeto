<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="javascript/javascript.js"></script>
    <title>WDA Livraria</title>
</head>
<body>
    <!-- Modal -->
    <div id="vis-modal" class="modal" style="display: block;">
        <?php
            if(!empty($_GET['id'])){
                include_once('../config.php');

                $id= $_GET['id'];

                $sqlSelect = "SELECT * FROM livro WHERE id = $id";

                $result = $conexao -> query($sqlSelect);

                if($result -> num_rows > 0){
                    while($livro_data = mysqli_fetch_assoc($result)){
                        $nome= $livro_data['nome'];
                        $editora = $livro_data['editora'];
                        $data_livro = $livro_data['data_livro'];
                        $autor = $livro_data['autor'];
                        $estoque= $livro_data['estoque'];
                    }
                }
                else{
                    header('Location: ../livro.php');
                }  
            }
            else{
                header('Location: ../livro.php');
            }
        ?>
        <div class="conteudo-modal">
                <a href="../livro.php"><img src="../img/cross.png" alt="butão-fechar" class="fechar-modal" onclick="fecharModal('vis-modal')"></a>
            <div class="corpo-modal">
                <form action="../saves/save-livro.php" method="POST">
                <br>
                <p class="titulo-modal"> Editar cadastro do Livro</p>
                <div class="input-modal" id="area-nome">
                    <input type="text" placeholder=" " name="nome" required autocomplete="off" value="<?php echo $nome; ?>">
                    <label for="nome">Nome:</label>
                </div>
                <div class="input-modal" id="area-autor">
                    <input type="text" placeholder=" " name="editora" required autocomplete="off" value="<?php echo $editora; ?>">
                    <label for="autor">Editora:</label>
                </div>
                <div class="input-modal" id="area-editora">
                    <input type="date" placeholder=" " name="data_livro" required autocomplete="off" value="<?php echo $data_livro; ?>">
                    <label for="editora">Data de Lançamento:</label>
                </div>
                <div class="input-modal" id="area-lancamento">
                    <input type="text" placeholder=" " name="autor" required autocomplete="off" value="<?php echo $autor; ?>">
                    <label for="lancamento">Autor:</label>
                </div>
                <div class="input-modal" id="area-quantidade">
                    <input type="number" placeholder=" " name="estoque" required autocomplete="off" value="<?php echo $estoque; ?>">
                    <label for="quantidade">Quantidade:</label>
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input name="submit" type="reset" value="Limpar" class="cancelar-btn">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="update" id="update" type="submit" value="Registrar" class="entrar-btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>