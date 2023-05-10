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
    <div id="vis-modal" class="modal" style="display:block;">
        <?php
            if(!empty($_GET['id'])){
                include_once('../config.php');

                $id = $_GET['id'];

                $sqlSelect = "SELECT * FROM usuario WHERE id = $id";

                $result = $conexao -> query($sqlSelect);

                if($result -> num_rows > 0){
                    while($user_data = mysqli_fetch_assoc($result)){
                        
                        $nome= $user_data['nome'];
                        $endereco = $user_data['endereco'];
                        $cidade = $user_data['cidade'];
                        $email = $user_data['email'];
                        $celular = $user_data['celular'];
                    }
                }
                else{
                    header('Location: ../user.php');
                }  
            }
            else{
                header('Location: ../user.php');
            }
        ?>
        <div class="conteudo-modal">
            <a href="../user.php"><img src="../img/cross.png" alt="butão-fechar" class="fechar-modal"></a>
            <div class="corpo-modal">
                <form action="../saves/save-user.php" method="POST">
                <br>
                <p class="titulo-modal">Editar Cadastro - Usuário</p>
                <div class="input-modal" id="area-nome">
                    <input type="text" placeholder=" " name="nome" value="<?php echo $nome ?>" required autocomplete="off">
                    <label for="email">Nome:</label>
                </div>
                <div class="input-modal" id="area-cidade">
                    <input type="text" placeholder=" " name="endereco" value="<?php echo $endereco ?>" required autocomplete="off">
                    <label for="senha">Endereço:</label>
                </div>
                <div class="input-modal" id="area-endereco">
                    <input type="text" placeholder=" " name="cidade" value="<?php echo $cidade?>" required autocomplete="off">
                    <label for="senha">Cidade:</label>
                </div>
                <div class="input-modal" id="area-email">
                    <input type="text" placeholder=" " name="email" value="<?php echo $email ?>" required autocomplete="off">
                    <label for="senha">E-mail:</label>
                </div>

                <div class="input-modal" id="area-email">
                    <input type="Number" placeholder=" " name="celular" value="<?php echo $celular ?>" required autocomplete="off">
                    <label for="senha">Celular:</label>
                </div>
    
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input name="cancela" type="reset" value="Limpar" class="cancelar-btn">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="update" id="update" type="submit" value="Registrar" class="entrar-btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>