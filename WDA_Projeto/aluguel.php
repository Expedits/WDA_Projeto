<?php
    session_start();

    include_once('config.php');

    if((!isset($_SESSION['nome']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        header('Location: home.php');
    }
    $logado = $_SESSION['nome'];

    if(!empty($_GET['search'])){
        $data = $_GET['search'];
 
        $sql = "SELECT * FROM aluguel WHERE id LIKE '%$data%' OR usuario LIKE '%$data%' or livro LIKE '%$data%' OR data_aluguel LIKE '%$data%'OR prev_devo LIKE '%$data%' OR data_devo LIKE '%$data%'  ORDER BY id ASC";
    }
    else{
        $sql = "SELECT * FROM aluguel ORDER BY id ASC";
    }
    $result = $conexao -> query($sql);

    // Conexão tabela Livros
    $sqllivro_conect = "SELECT * FROM livro ORDER BY id ASC";
    $resultlivro_conect = $conexao -> query($sqllivro_conect);

    // Conexão tabela Usuários
    $sqluser_conect = "SELECT * FROM usuario ORDER BY id ASC";
    $resultuser_conect = $conexao -> query($sqluser_conect);
    
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
                    <a class="nav-link" href="user.php">Usuário</a>
                    <a class="nav-link" href="livro.php">Livro</a>
                    <a class="nav-link" href="editora.php">Editora</a>
                    <a class="nav-link" href="aluguel.php" style="text-decoration: underline;">Aluguel</a>
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
                  <form action="aluguel.php" method="POST">
                    <br>
                    <p class="titulo-modal">Cadastro da Aluguel</p>
                    <div>
                      <label for="usuario"> Nome usuario:</label>
                    <select name="usuario" id="" style="width:180px; border: 0.5px solid black;">
                        <option value="usuario">Usuário que alugou:</option>
                        <?php 
                            while($user_data = mysqli_fetch_assoc($resultuser_conect)){
                                echo "<option>".$user_data['nome']."</option>";
                            }
                        ?>
                      </select>
                    </div>
                    <br>
                    <div>
                    <label for="livro"> Nome do Livro:</label>
                      <select name="nome-livro" id="" value="Livro alugado:" style="width:180px; border: 0.5px solid black;">
                        <option value="Selecionar">Livro Alugado:</option>
                        <?php
                            while($livro_data = mysqli_fetch_assoc($resultlivro_conect)){
                                echo "<option>".$livro_data['nome']."</option>";
                            }
                        ?>
                      </select>
                    </div>
                    <br>
                    <div class="input-modal" id="area-cidade">
                      <input type="date" placeholder=" " name="data_aluguel" required >
                      <label for="senha">Data de aluguel</label>
                    </div>

                    <div class="input-modal" id="area-cidade">
                      <input type="date" placeholder=" " name="prev_devo" required >
                      <label for="senha">Prev devo</label>
                    </div>
                   
                    <input type="hidden" name="data_devo" value="0">
                    <input name="submit" type="reset" value="Limpar" class="cancelar-btn">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="submit" type="submit" value="Registrar" class="entrar-btn">
                  </form>
                </div>
            </div>
        </div>
        <!-- GRID -->
        <div class="grid-header">
            <span class="titulo-pg">Alugueis</span>
            <div class="novo-btn" onclick="abrirModal('vis-modal')">NOVO +</div>
            <form class="searchbox sbx-custom" style="margin-left: 483px;">
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
      <th scope="col">NOME_USUARIO</th>
      <th scope="col">LIVRO</th>
      <th scope="col">DATA_ALUGUEL</th>
      <th scope="col">PREV DEVO</th>
      <th scope="col">DATA_DEVO</th>
      <th scope="col">AÇÕES</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($aluguel_data = mysqli_fetch_assoc($result)){
      echo "<tr>";
      echo "<td>".$aluguel_data['id']."</td>";
      echo "<td>".$aluguel_data['usuario']."</td>";
      echo "<td>".$aluguel_data['livro']."</td>";
      echo "<td>".$aluguel_data['data_aluguel']."</td>";
      echo "<td>".$aluguel_data['prev_devo']."</td>";  
      
      if($aluguel_data['data_devo'] == 0){   
        echo "<td>Não Devolvido</td>";
        echo "<td>
        <a href='edit/edit-aluguel.php?id=$aluguel_data[id]'><img src='img/check.png' alt='Devolver' title='Devolver'></a>
        </td>";
      } else{
        $hoje = date("Y/m/d");
        $previsao = $aluguel_data['prev_devo'];

        if(strtotime($previsao) >= strtotime($hoje)){
            echo "<td>".$aluguel_data['data_devo']."(No prazo)</td>";
            echo "<td><a href='delete/delet-aluguel.php?id=$aluguel_data[id]'><img src='img/bin.png' alt='Bin' title='Deletar'></a></td>";
        }
        else{
            echo "<td>".$aluguel_data['data_devo']."(Atrasado)</td>";
            echo "<td><a href='delete/delet-aluguel.php?id=$aluguel_data[id]'><img src='img/bin.png' alt='Bin' title='Deletar'></a></td>";
        }
    }
     
  }
  ?>
  </tbody>
</table>


       <?php
       //colocar dados na tabela
        if(isset($_POST['submit'])){

            include_once('config.php');
            date_default_timezone_set('America/Sao_Paulo');

            $entrada = new DateTime(date("Y/m/d", strtotime($_POST['data_aluguel'])));
            $saida = new DateTime(date("Y/m/d", strtotime($_POST['prev_devo'])));

            $intervalo = $entrada -> diff($saida);
            $dias = $intervalo -> days;

            $hoje = date("Y/m/d");
            $aluguel = $_POST['data_aluguel'];


            if(strtotime($aluguel) <= strtotime($hoje)){
              if($dias > 30){
                  echo "<script> window.alert('O prazo de aluguel tem um limite de até 30 dias.') </script>";
              }
              else{
                  $prev_devo = $_POST['prev_devo'];
                  $data_aluguel = $_POST['data_aluguel'];

                  if(strtotime($prev_devo) < strtotime($data_aluguel)){
                      echo "<script> alert('Convenhamos que não há sentido em a data de previsão ser anterior a data de aluguel.') </script>";
                  }
                  else{
                      $nomelivro = $_POST['nome-livro'];
                      $usuario = $_POST['usuario'];
                      $data_aluguel = $_POST['data_aluguel'];
                      $prev_devo = $_POST['prev_devo'];
                      $data_devo = $_POST['data_devo'];
                      
                      $sqlSelect = "SELECT * FROM aluguel WHERE livro = '$nomelivro' AND usuario = '$usuario'";
                      $resultSelect = $conexao -> query($sqlSelect);
                      
                      if(mysqli_num_rows($resultSelect) == 1){
                          echo "<script>window.alert('O usuário já possui aluguel desse livro.')</script>";
                      }
                      else{
                          // Conexão tabela Livros
                          $sqllivro_conect = "SELECT * FROM livro WHERE nome = '$nomelivro'";
                          $resultlivro_conect = $conexao -> query($sqllivro_conect);
                          
                          $livro_data = mysqli_fetch_assoc($resultlivro_conect);
                          $nomeLivro_BD = $livro_data['nome'];   
                          $quantidade_BD = $livro_data['estoque'];
                          $quantidade_nova = $quantidade_BD - 1;

                          if($nomelivro === $nomeLivro_BD){
                              $sqlAlterar = "UPDATE livro SET estoque = '$quantidade_nova' WHERE nome = '$nomelivro'";
                              $sqlResultAlterar = $conexao -> query($sqlAlterar);
                          }
                          $result = mysqli_query($conexao, "INSERT INTO aluguel(usuario, livro, data_aluguel, prev_devo, data_devo) VALUES ('$usuario', '$nomelivro', '$data_aluguel', '$prev_devo', '$data_devo')");
                      }
                  }
              }
          }
          else{
              echo "<script> window.alert('A data de aluguel não pode ser posterior ao dia de hoje!') </script>";
             }
   
      } 
        ?>
    </main>
</body>
</html>