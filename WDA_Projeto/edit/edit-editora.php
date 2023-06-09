<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f4c3c17e91.js" crossorigin="anonymous"></script>
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

                $id = $_GET['id'];

                $sqlSelect = "SELECT * FROM editora WHERE id = $id";

                $result = $conexao -> query($sqlSelect);

                if($result -> num_rows > 0){
                    while($editora_data = mysqli_fetch_assoc($result)){
                        $nome = $editora_data['nome'];  
                        $telefone = $editora_data['telefone'];
                        $email = $editora_data['email'];
                       
                    }
                }
                else{
                    header('Location: ../editora.php');
                }  
            }
            else{
                header('Location: ../editora.php');
            }
        ?>
        <div class="conteudo-modal" style="display: block;">
                <a href="../editora.php"><img src="../img/cross.png" alt="butão-fechar" class="fechar-modal" onclick="fecharModal('vis-modal')"></a>
            <div class="corpo-modal">
                <form action="../saves/save-editora.php" method="POST">
                <br>
                <p class="titulo-modal">Cadastro da Editora</p>
                <div class="input-modal" id="area-nome">
                    <input type="text" placeholder=" " name="nome" required autocomplete="off" value ="<?php echo $nome;?>">
                    <label for="email">Nome:</label>
                </div>
                <div class="input-modal" id="area-cidade">
                    <input type="Number" placeholder=" " name="telefone" required autocomplete="off" value ="<?php echo $telefone; ?>">
                    <label for="senha">E-mail:</label>
                </div>
                <div class="input-modal" id="area-cidade">
                    <input type="text" placeholder=" " name="email" required autocomplete="off" value ="<?php echo $email; ?>">
                    <label for="senha">Telefone:</label>
                </div>
                
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input name="submit" type="reset" value="Limpar" class="cancelar-btn">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="update" type="submit" value="Registrar" class="entrar-btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>