<?php 

    $entrada = new DateTime("2022-07-1");
    $saida = new DateTime("2022-07-31");

    $intervalo = $entrada -> diff($saida);
    var_dump($intervalo);
    echo $intervalo -> d."Dias <br>";


    $alug_dat = date("d/m/Y", strtotime($aluguel_data['data_aluguel']));
                    $dev_dat = date("d/m/Y", strtotime($aluguel_data['prev_devolucao']));
?>