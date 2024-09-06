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

    <title>Helper Log - Custos por viagem</title>

</head>
<body>

    <?php 
        include "../pages/topo_sys.php";

        $id = $_POST['id'] ?? null;
    ?>

    <div class="content">

        <div class="content col-12 titulo-listagem">
            <p>Custos por viagem</p>
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

                        $q = "SELECT o.id, o.data_criacao, o.tipo, o.descricao, o.valor, o.id_viagem, o.id_veiculo, o.id_motorista, o.id_user, o.observacao, o.situacao, v.idv, v.placa1, v.placa2, m.idm, m.nome 
                        FROM ocorrencias o 
                        LEFT JOIN veiculos v ON v.idv = o.id_veiculo
                        LEFT JOIN motoristas m ON m.idm = o.id_motorista
                        WHERE o.id_viagem = '$id' AND o.situacao <> 'Cancelada'";
                       
                        echo "
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Viagem</th>
                                <th>Veículo</th>
                                <th>Motorista</th>
                                <th>Usuário</th>
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

                                while ($reg = $busca->fetch_object()) {

                                    $id = $reg->id;
                                    echo "<tr><td>$id";
                                    $dataFormatada = new DateTime($reg->data_criacao);
                                    $data_criacao = $dataFormatada->format('d-m-Y');
                                    echo "<td>$data_criacao";
                                    echo "<td>$reg->tipo";
                                    echo "<td>$reg->descricao";
                                    $valor = $reg->valor;
                                    $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                    echo "<td>" . numfmt_format_currency($padrao, $valor, 'BRL') . " ";
                                    echo "<td>$reg->id_viagem";
                                    if (empty($reg->placa2)) {
                                        echo "<td>$reg->placa1";
                                    }
                                    else {
                                        echo "<td>$reg->placa2";
                                    }
                                    echo "<td>$reg->nome";
                                    echo "<td>$reg->id_user";
                                    echo "<td>$reg->situacao";

                                    $soma_valor += floatval($valor);
                                }
                                echo "<tr><td class='total'><td class='total'><td class='total'><td class='total'>Total:";
                                echo "<td class='total'>" . numfmt_format_currency($padrao, $soma_valor, 'BRL') . "";
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