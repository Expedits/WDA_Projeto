<?php
    include_once('config.php');
    session_start();
    //print_r($_SESSION);

    if((!isset($_SESSION['nome']) == true) and (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        header('Location: home.php');
    }
    $logado = $_SESSION['nome'];
    // Função para total de livros não devolvidos 

    $sql_devo="SELECT count(data_devo) as fora_prazo FROM aluguel where data_devo=0";
    $result_devo = $conexao->query($sql_devo);
    $total_devo=$result_devo->fetch_assoc();
    if(isset($total_devo['fora_prazo'])){
    $total_devo= $total_devo['fora_prazo'];
    }

  //Função para total de livros devolvidos no prazo
  $sql_ndevo="SELECT count(data_devo) as dentro_prazo FROM aluguel where data_devo!=0";
  $result_ndevo = $conexao->query($sql_ndevo);
  $total_ndevo=$result_ndevo->fetch_assoc();
  if(isset($total_ndevo['dentro_prazo'])){
  $total_ndevo= $total_ndevo['dentro_prazo'];
  }
 
  //Função para o ultimo livro alugado
  $sql_ultimo_alug = "SELECT * FROM aluguel ORDER BY id DESC LIMIT 1";
  $result_ultimo_alug = $conexao->query($sql_ultimo_alug);
  $ultimo_alug=$result_ultimo_alug->fetch_assoc();
  if(isset($ultimo_alug['livro'])){
    $ultimo_alug=  $ultimo_alug['livro'];
  }

  //Função total de livros
  $sql_total_livros="SELECT sum(estoque) AS total_livro FROM livro";
  $result_livros = $conexao->query($sql_total_livros);
  $total_livros=$result_livros->fetch_assoc();
  if(isset($total_livros['total_livro'])){
  $total_livros= $total_livros['total_livro'];
  }

  //Função total de algueis
   $sql_total_alugu = "SELECT COUNT(*) AS total_alugueis FROM aluguel";
   $result_total_alugueis = $conexao->query($sql_total_alugu);
   $total_alugueis = $result_total_alugueis ->fetch_assoc();
  if (isset($total_alugueis['total_alugueis'])) {
    $quantidade_alugueis = $total_alugueis['total_alugueis'];
  }

  //grafico
  $sql_grafico="SELECT livro , count(livro) AS quantidade FROM aluguel WHERE livro=livro GROUP BY livro ORDER BY COUNT(livro) DESC LIMIT 5";
  $result_grafico= $conexao->query($sql_grafico);
  //loop para formação de dados 
  while($bar=$result_grafico->fetch_assoc()){
    $nomes[]=$bar['livro'];
    $dados[]=$bar['quantidade'];
   
  }

  
 
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <title>Livraria WDA</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="inicio.php">
                 <img src="images/WDA-removebg-preview.png" style="height: 90px; width: 90px;" alt=""> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="inicio.php" style="text-decoration: none;" id="primeiro">Início</a>
                    <a class="nav-link" href="user.php">Usuário</a>
                    <a class="nav-link" href="livro.php">Livro</a>
                    <a class="nav-link" href="editora.php">Editora</a>
                    <a class="nav-link" href="aluguel.php">Aluguel</a>
                    
                </div>
                <a href="sair.php"><button class="btn btn-outline-danger" id="botao-sair" type="submit">SAIR</button></a>
                </div>
            </div>
        </nav>
    </header>
    
    <main>                          
        <div class="" id="container-ultimoalugado">
            <h2>Último livro alugado :</h2>
            <br>
            <?php echo "<h3>".$ultimo_alug."<h3>" ?>
            <p></p>

        </div>
        <div class="" id="container-maisalugados">
            <h2>Livros</h2>
            <br>
            <h3>Total de livros:</h3>
            <?php  echo  $total_livros; ?>
            <br><br>
            <h3>Total de livros  alugados:</h3>
            <?php  echo  $quantidade_alugueis; ?>

        </div>
        <div class="" id="container-livros">
            <h2>Alugueis</h2>
            <br>
            <h3>Total de livros devolvidos:</h3>
            <?php  echo  $total_ndevo; ?>
            <h3>Total de livros  não devolvidos:</h3>
            <?php  echo  $total_devo; ?>
         
          
        </div>
        <div style="padding-top:50px;"
        class="" id="container-grafico">
            <h1>Gráfico:</h1>

            <canvas id="myChart"></canvas>
    </main>

    <script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["<?php echo $nomes[0]; ?>","<?php echo $nomes[1]; ?>","<?php echo $nomes[2]; ?>","<?php echo $nomes[3]; ?>","<?php echo $nomes[4]; ?>"],
      datasets: [{
        label: 'TOP 5 mais',
        data: ["<?php echo $dados[0]; ?>","<?php echo $dados[1]; ?>","<?php echo $dados[2]; ?>","<?php echo $dados[3]; ?>","<?php echo $dados[4]; ?>"],
        backgroundColor: ['rgb(235, 64, 52)','rgb(28, 138, 217)','rgb(109, 49, 222)','rgb(87, 232, 79)','rgb(227, 114, 34)'],
        borderColor: ['rgba(235, 64, 52)','rgb(28, 138, 217)','rgb(109, 49, 222)','rgb(87, 232, 79)','rgb(227, 114, 34)'],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>