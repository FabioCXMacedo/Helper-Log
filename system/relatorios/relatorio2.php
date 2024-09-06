<!DOCTYPE html>
<html lang="pt-BR">

<?php
    require_once "../includes/funcoes.php";
    require_once "../includes/login.php";
    require_once "../includes/banco.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/style_sys.css">
    <link rel="stylesheet" href="../estilos/administrativo.css">

    <title>Helper Log - Produtividade por veículo</title>

</head>
<body>

    <?php 
        include "../pages/topo_sys.php";

        $id = $_POST['id'] ?? null;
        $datai = $_POST['datai'] ?? null;
        $dataf = $_POST['dataf'] ?? null;
    ?>

    <div class="content">

        <div class="content col-12 titulo-listagem">
            <p>Produtividade por veículo</p>
        </div>
        
        <?php 
            
            if (!is_admin()) {
                echo msg_erro('Área restrita. Você não é administrador!');
            }
            else {
                echo "
                    <div class='container col-12 listagem'>
                        <table class='listagem'> 
                ";

                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

                        $q = "SELECT c.id_veiculo, c.data_viagem, c.valor, c.custo, c.situacao_viagem, c.km_rodado, v.idv, v.placa1, v.placa2  
                        FROM contas_receber c
                        LEFT JOIN veiculos v ON v.idv = c.id_veiculo
                        WHERE id_veiculo = '$id' AND data_viagem >= '$datai' AND data_viagem <= '$dataf' AND situacao_viagem = 'Finalizada'";
                       
                        echo "
                            <tr>
                                <th>ID veículo</th>
                                <th>Placa Cavalo</th>
                                <th>Plca Carreta</th>
                                <th>Data viagem</th>
                                <th>Valor frete</th>
                                <th>Custo</th>
                                <th>Km rodado</th>
                                <th>Situação</th>
                            </tr>
                        ";

                        $busca = $banco->query("$q");

                        if (!$busca) {
                            echo "<tr><td>Infelizmente a busca deu errado";
                        }
                        else {
                            if ($busca->num_rows == 0) {
                                echo "<tr><td>Nenhum registro encontrado";
                            }
                            else {
                                $soma_valor = 0;
                                $soma_custo = 0;
                                $soma_km = 0;

                                while ($reg = $busca->fetch_object()) {

                                    $id = $reg->id_veiculo;
                                    echo "<tr><td>$id";
                                    echo "<td>$reg->placa1";
                                    echo "<td>$reg->placa2";
                                    $dataFormatada = new DateTime($reg->data_viagem);
                                    $data_viagem = $dataFormatada->format('d-m-Y');
                                    echo "<td>$data_viagem";
                                    $valor = $reg->valor;
                                    $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                    echo "<td>" . numfmt_format_currency($padrao, $valor, 'BRL') . " ";
                                    $custo = $reg->custo;
                                    $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                    echo "<td>" . numfmt_format_currency($padrao, $custo, 'BRL') . " ";
                                    $km_rodado = $reg->km_rodado;
                                    echo "<td>" . number_format(($km_rodado), 0, ',', '.') ;
                                    echo "<td>$reg->situacao_viagem";

                                    $soma_valor += floatval($valor);
                                    $soma_custo += floatval($custo);
                                    $soma_km += floatval($km_rodado);
                                }
                                echo "<tr><td class='total'><td class='total'><td class='total'><td class='total'>Total:";
                                echo "<td class='total'>" . numfmt_format_currency($padrao, $soma_valor, 'BRL') . "";
                                echo "<td class='total'>" . numfmt_format_currency($padrao, $soma_custo, 'BRL') . "";
                                echo "<td class='total'>" . number_format(($soma_km), 0, ',', '.') ;
                            }
                        }
                echo "        
                                
                        </table>
                    </div>
                ";

            }
        ?>

        <?php 
            include "../pages/footer_sys.php";
        ?>

    </div>

    
</body>
</html>