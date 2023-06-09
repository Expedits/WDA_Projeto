<?php
    session_start();

    include_once('config.php');

    if((!isset($_SESSION['nome']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        header('Location: home.php');
    }


    if(!empty($_GET['search'])){
       $data = $_GET['search'];

       $sql = "SELECT * FROM usuario WHERE id LIKE '%$data%' OR nome LIKE '%$data%' OR endereco LIKE '%$data%' OR cidade LIKE '%$data%' OR email LIKE '%$data%' OR celular LIKE '%$data%'  ORDER BY id ASC";
    }
    else{
        $sql = "SELECT * FROM usuario ORDER BY id ASC";
    }

    $result = $conexao -> query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f4c3c17e91.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilos/style.css?<?php echo rand(1, 1000); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="javascript/javascript.js"></script>
    <script>
        var search = document.getElementById('pesquisadora')
        search.addEventListener("keydown", function(event){
            if(event.key === "Enter"){
                searchData();
            }
        })
        function searchData(){
            window.location = "user.php?search=" = search.value
        }
    </script>
    <title>WDA Livraria</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container-fluid">
               <img src="images/WDA-removebg-preview.png" style="height: 90px; width: 90px;" alt=""> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="inicio.php">Início</a>
                    <a class="nav-link" href="user.php" style="text-decoration: underline;">Usuário</a>
                    <a class="nav-link" href="livro.php">Livro</a>
                    <a class="nav-link" href="editora.php">Editora</a>
                    <a class="nav-link" href="aluguel.php">Aluguel</a>
                    <a href="sair.php"><button class="btn btn-outline-danger" id="botao-sair" type="submit">SAIR</button></a>
                </div>
                
                </div>
            </div>
        </nav>
    </header>
    <main>
        <!-- Modal -->
        <div id="vis-modal" class="modal">
            <div class="conteudo-modal">
                    <img src="img/cross.png" alt="butão-fechar" class="fechar-modal" onclick="fecharModal('vis-modal')">
                <div class="corpo-modal">
                  <form action="user.php" method="POST">
                    <br>
                    <p class="titulo-modal">Cadastro do Usuário</p>
                    <div class="input-modal" id="area-nome">

                      <input type="text" placeholder=" " name="nome" required >
                      <label for="email">Nome:</label>
                    </div>
                    
                    <div class="input-modal" id="area-endereco">
                        <input type="text" placeholder=" " name="endereco" required >
                        <label for="senha">Endereço:</label>
                    </div>

                    <div class="input-modal" id="area-cidade">
                      <input type="text" placeholder=" " name="cidade" required >
                      <label for="senha">Cidade:</label>
                    </div>

                    <div class="input-modal" id="area-email">
                        <input type="text" placeholder=" " name="email" required >
                        <label for="senha">E-mail:</label>
                    </div>

                    <div class="input-modal" id="area-email">
                        <input type="Number" placeholder="" name="celular" >
                        <label for="senha">Celular <i style="font-size: 12.5px;"></i></label>
                    </div>
                    <input type="reset" value="Limpar" class="cancelar-btn">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="submit" type="submit" value="Registrar" class="entrar-btn">
                  </form>
                </div>
            </div>
        </div>
        <!-- GRID -->
        <div class="grid-header">
            <span class="titulo-pg">Usuários</span>
            <div class="novo-btn" onclick="abrirModal('vis-modal')">NOVO +</div>
            <form class="searchbox sbx-custom">
            <div role="search" class="sbx-custom__wrapper">
                <input type="search" name="search" placeholder="Pesquisar..." autocomplete="off" class="sbx-custom__input" id="pesquisadora">
                <button type="submit" class="sbx-custom__submit" onclick="searchData()">
                    <img src="img/search.png" alt="">
                </button>
            </div>
            </form>
        </div>                          
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOME</th>
      <th scope="col">ENDERECO</th>
      <th scope="col">CIDADE</th>
      <th scope="col">EMAIL</th>
      <th scope="col">TELEFONE</th>
      <th scope="col">AÇÕES</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($user_data = mysqli_fetch_assoc($result)){
      echo "<tr>";
      echo "<td>".$user_data['id']."</td>";
      echo "<td>".$user_data['nome']."</td>";
      echo "<td>".$user_data['endereco']."</td>";
      echo "<td>".$user_data['cidade']."</td>";
      echo "<td>".$user_data['email']."</td>";
      echo "<td>".$user_data['celular']."</td>";
      echo "<td>
      
      <a href='edit/edit-user.php?id=$user_data[id]' class='butao' id='bt1'>
      <img src='images/pencil-fill.svg' alt='pencil' >
      </a>
      <a href='delete/delet-user.php?id=$user_data[id]' class='butao' id='bt2'>
       <img src='img/bin.png' alt='bin' >
      </a>

      </td>";
      echo "</tr>";
    }
  ?>
  </tbody>
</table>



       <?php
        if(isset($_POST['submit'])){
            include_once('config.php');

            $nome= $_POST['nome'];
            $endereco = $_POST['endereco'];
            $cidade = $_POST['cidade'];
            $email = $_POST['email'];
            $celular = $_POST['celular'];

            $result = mysqli_query($conexao, "INSERT INTO usuario(nome, endereco, cidade, email, celular) VALUES ('$nome', '$endereco', '$cidade', '$email', '$celular')");
            
         } 
        ?>
    </main>
</body>
</html>