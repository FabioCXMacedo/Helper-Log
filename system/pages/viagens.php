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

    <title>Helper Log - Viagens</title>

</head>
<body>

    <?php 
        include "topo_sys.php";

        $filtro1 = $_GET['filtro1'] ?? "";
        $filtro2 = $_GET['filtro2'] ?? ""; 
        $datai = $_GET['datai'] ?? "";
        $dataf = $_GET['dataf'] ?? "";
    ?>
    <div class="content">

        <div class="content col-12 titulo-listagem">
            <p>Viagens</p>
        </div>
        
        <div class="row content col-12 menu-sub">
            <div class='menu-item-sub col-1'>
                <a href="contas_receber_new_form.php">
                    <div class='menu-icon-sub'>
                        <i class="bi bi-suitcase-lg-fill"></i>
                    </div>
                    <div class='menu-title-sub'>
                        <p>Nova Viagem</p>
                    </div>
                </a>
            </div>
            <div class="container col filtros">
                <form action="viagens.php" method="get" id="busca">
                    <div class="row ">
                        <div class="col-1 filtros-a">
                            <span for="tipo">Tipo: </span>
                        </div>
                        <div class="col-2 filtros-a">
                            <select class="form-select" id="filtro1" name="filtro1">
                                <option value=""></option>
                                <option value="Frete próprio">Frete próprio</option>
                                <option value="Frete terceiro">Frete terceiro</option>
                            </select>
                        </div>

                        <div class="col-1 filtros-a">
                            <span for="vencimento">Vencimento: </span>
                        </div>
                        <div class="col-2 filtros-a">
                            <label for="datai">Data Inicial: </label>
                            <input type="date" class="form-control" name="datai" id="datai">
                        </div>
                        <div class="col-2 filtros-a">
                            <label for="dataf">Data Final: </label>
                            <input type="date" class="form-control" name="dataf" id="dataf" required>
                        </div>

                        <div class="col-1 filtros-a">
                            <span for="status">Status: </span>
                        </div>
                        <div class="col-2 filtros-a">
                            <select class="form-select" id="filtro2" name="filtro2">
                                <option value=""></option>
                                <option value="Programada">Programada</option>
                                <option value="Iniciada">Iniciada</option>
                                <option value="Finalizada">Finalizada</option>
                                <option value="Cancelada">Cancelada</option>
                            </select>
                        </div>
                        <div class="col-1">
                            <input type="submit" value="Filtrar" class="btn btn-outline-primary">
                        </div> 
                        
                    </div>
                    
                </form>
            </div>
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

                        $q = "SELECT c.id, c.data_viagem, c.descricao, c.distancia, c.tipo, c.id_veiculo, c.id_motorista, c.cliente, c.fornecedor, c.valor, c.custo, c.situacao_viagem, m.idm, m.nome, v.idv, v.placa1, v.placa2 
                        FROM contas_receber c 
                        LEFT JOIN veiculos v ON v.idv = c.id_veiculo
                        LEFT JOIN motoristas m ON m.idm = c.id_motorista ";

                        if (!empty($filtro2)) {
                            $q .= "WHERE situacao_viagem = '$filtro2' ";
                            if (!empty($datai)) {
                                $q .= "and data_viagem >= '$datai' and data_viagem <= '$dataf' ";
                            }
                            else {
                                $q .= "and data_viagem <= '$dataf' ";
                                if (!empty($filtro1)) {
                                    $q .= "and tipo = '$filtro1'";
                                }
                                else {
                                    $q .= "and tipo is not null";
                                }
                            }
                        }
                        else {
                            $q .= "WHERE situacao is not null ";
                            if (!empty($datai)) {
                                $q .= "and data_viagem >= '$datai' and data_viagem <= '$dataf' ";
                            }
                            else {
                                $q .= "and data_viagem <= '$dataf' ";
                                if (!empty($filtro1)) {
                                    $q .= "and tipo = '$filtro1'";
                                }
                                else {
                                    $q = "SELECT c.id, c.data_viagem, c.descricao, c.distancia, c.tipo, c.id_veiculo, c.id_motorista, c.cliente, c.fornecedor, c.valor, c.custo, c.situacao_viagem, m.idm, m.nome, v.idv, v.placa1, v.placa2 
                                    FROM contas_receber c 
                                    LEFT JOIN veiculos v ON v.idv = c.id_veiculo
                                    LEFT JOIN motoristas m ON m.idm = c.id_motorista ";
                                }
                            }
                            
                        }
                            
                        
                        echo "
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Itinerário</th>
                                <th>Distância</th>
                                <th>Tipo</th>
                                <th>Cliente</th>
                                <th>Fornecedor</th>
                                <th>Valor</th>
                                <th>Motorista</th>
                                <th>Placa</th>
                                <th>Custo</th>
                                <th>Status</th>
                                <th class='opcoes'>Opções</th>
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
                                while ($reg = $busca->fetch_object()) {

                                    $id = $reg->id;
                                    echo "<tr><td>$id";
                                    $dataFormatada = new DateTime($reg->data_viagem);
                                    $data_viagem = $dataFormatada->format('d-m-Y');
                                    echo "<td>$data_viagem";
                                    echo "<td>$reg->descricao";
                                    echo "<td>$reg->distancia";
                                    echo "<td>$reg->tipo";
                                    echo "<td>$reg->cliente";
                                    echo "<td>$reg->fornecedor";
                                    $valor = $reg->valor;
                                    $custo = $reg->custo;
                                    $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                    echo "<td>" . numfmt_format_currency($padrao, $valor, 'BRL') . " ";
                                    echo "<td>$reg->nome";

                                    if (empty($reg->placa2)) {
                                        echo "<td>$reg->placa1";
                                    }
                                    else {
                                        echo "<td>$reg->placa2";
                                    }
                                    echo "<td>" . numfmt_format_currency($padrao, $custo, 'BRL') . " ";
                                    echo "<td>$reg->situacao_viagem";
                                    echo "<td class='bt-opcoes'> <a href='contas_receber_edit_form.php?id=$id'><abbr title='Alterar'><i class='bi bi-pencil'></i></abbr></a>   |   ";
                                    echo " <a href='contas_receber_cancelar_conf.php?id=$id'><abbr title='Cancelar'><i class='bi bi-trash'></i></abbr></a>";
                                }
                            }
                        }
                echo "        
                                
                        </table>
                    </div>
                ";

            }
        ?>

        <?php 
            include "footer_sys.php";
        ?>

    </div>

    
</body>
</html>