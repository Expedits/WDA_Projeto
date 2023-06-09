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
 
        $sql = "SELECT * FROM livro WHERE id LIKE '%$data%'or nome LIKE '%$data%' or editora LIKE '%$data%' or data_livro LIKE '%$data%' or autor LIKE '%$data%' or estoque LIKE '%$data%' ORDER BY id ASC";
     }
     else{
        $sql = "SELECT * FROM livro ORDER BY  id ASC";
     }
 
    $result = $conexao -> query($sql); 

    // Conexão tabela editoras
    $sqlEditoras_conect = "SELECT * FROM editora ORDER BY id ASC";
    $resultEditora_conect = $conexao -> query($sqlEditoras_conect);
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
    <link rel="shortcut icon" href="/img/logo.svg" type="image/x-icon">
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
                    <a class="nav-link" href="user.php">Usuário</a>
                    <a class="nav-link" href="livro.php" style="text-decoration: underline;">Livro</a>
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
                    <img src="img/cross.png" alt="button-fechar" class="fechar-modal" onclick="fecharModal('vis-modal')">
                <div class="corpo-modal">
                  <form action="livro.php" method="POST">
                    <br>
                    <p class="titulo-modal">Cadastro do Livro</p>
                    <div class="input-modal" id="area-nome">
                      <input type="text" placeholder=" " name="nome" required >
                      <label for="nome">Nome:</label>
                    </div>
                    <label for="editora">Editora:</label>
                    <div class="input-modal" id="area-editora">
                    
                        <select name="editora" id="">
                            <option value="sei la">Selecione</option>
                            <?php
                            while($editora_data = mysqli_fetch_assoc($resultEditora_conect)){
                                echo "<option>".$editora_data['nome']."</option>";
                            }
                            ?>
                        </select>
                        
                    </div>

                    <div class="input-modal" id="area-lancamento">
                        <input type="date" placeholder=" " name="data_livro" required>
                        <label for="lancamento">Lançamento:</label>
                    </div>

                    <div class="input-modal" id="area-autor">
                      <input type="text" placeholder=" " name="autor" required>
                      <label for="autor">Autor:</label>
                    </div>
                   
                    <div class="input-modal" id="area-quantidade">
                        <input type="number" placeholder=" " name="estoque" required>
                        <label for="quantidade">Quantidade:</label>
                    </div>
                    <input name="submit" type="reset" value="Limpar" class="cancelar-btn">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="submit" type="submit" value="Registrar" class="entrar-btn">
                  </form>
                </div>
            </div>
        </div>
        <!-- GRID -->
        <div class="grid-header">
            <span class="titulo-pg">Livros</span>
            <div class="novo-btn" onclick="abrirModal('vis-modal')">NOVO +</div>
            <form class="searchbox sbx-custom" style="margin-left: 520px;">
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
      <th scope="col">LIVRO</th>
      <th scope="col">EDITORA</th>
      <th scope="col">LANÇAMENTO</th>
      <th scope="col">AUTOR</th>
      <th scope="col">ESTOQUE</th>
      <th scope="col">AÇÕES</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($user_data = mysqli_fetch_assoc($result)){
      $data=date("d/m/Y",strtotime($user_data['data_livro'])); 
      echo "<tr>";
      echo "<td>".$user_data['id']."</td>";
      echo "<td>".$user_data['nome']."</td>";
      echo "<td>".$user_data['editora']."</td>";
      echo "<td>".$data."</td>";
      echo "<td>".$user_data['autor']."</td>";
      echo "<td>".$user_data['estoque']."</td>";
      echo "<td>
      
      <a href='edit/edit-livro.php?id=$user_data[id]' class='butao' id='bt1'>
      <img src='images/pencil-fill.svg' alt='pencil' >
      </a>
      <a href='delete/delet-livro.php?id=$user_data[id]' class='butao' id='bt2'>
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
            $editora = $_POST['editora'];
            $data_livro = $_POST['data_livro'];
            $autor = $_POST['autor'];
            $estoque= $_POST['estoque'];

            $result = mysqli_query($conexao, "INSERT INTO livro(nome, editora, data_livro, autor, estoque) VALUES ('$nome', '$editora', '$data_livro', '$autor', '$estoque')");
            
         } 
        ?>
    </main>

</body>
</html>