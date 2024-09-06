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

    <title>Helper Log - Contas à Pagar</title>

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
            <p>Contas à Pagar</p>
        </div>
        
        <div class="row content col-12 menu-sub">
            <div class="container col-1">
                <a href="contas_pagar_new_form.php">
                    <div class='menu-item-sub'>
                        <div class='menu-icon-sub'>
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                        <div class='menu-title-sub'>
                            <p>Nova Conta</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="container col filtros">
                <form action="contas_pagar.php" method="get" id="busca">
                    <div class="row ">
                        <div class="col-1 filtros-a">
                            <span for="tipo">Tipo: </span>
                        </div>
                        <div class="col-2 filtros-a">
                            <select class="form-select" id="filtro1" name="filtro1">
                                <option value=""></option>
                                <option value="Administrativa">Administrativa</option>
                                <option value="Manutenção">Manutenção</option>
                                <option value="Salários">Salários</option>
                                <option value="Investimentos">Investimentos</option>
                                <option value="Combustível">Combustível</option>
                                <option value="Pedágio">Pedágio</option>
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
                                <option value="Pago">Pago</option>
                                <option value="À pagar">À pagar</option>
                                <option value="Vencida">Vencida</option>
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
                        $q = "UPDATE contas_pagar SET situacao = 'Vencida'
                        WHERE situacao = 'À pagar' and vencimento < CURDATE()";
                        try {
                            if ($banco->query($q)) {
                                echo "";
                            }
                        }
                        catch (Exception $e) {
                            echo "";
                        }

                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

                        $q = "SELECT id, data_lancamento, vencimento, tipo_despesa, descricao, fornecedor, tipo_pagamento, valor, valor_pago, juros_multa, descontos, data_pagamento, veiculo, motorista, situacao, observacao 
                        FROM contas_pagar ";
                        
                                           
                        if (!empty($filtro2)) {
                            $q .= "WHERE situacao = '$filtro2' ";
                            if (!empty($datai)) {
                                $q .= "and vencimento >= '$datai' and vencimento <= '$dataf' ";
                            }
                            else {
                                $q .= "and vencimento <= '$dataf' ";
                                if (!empty($filtro1)) {
                                    $q .= "and tipo_despesa = '$filtro1'";
                                }
                                else {
                                    $q .= "and tipo_despesa is not null";
                                }
                            }
                        }
                        else {
                            $q .= "WHERE situacao is not null ";
                            if (!empty($datai)) {
                                $q .= "and vencimento >= '$datai' and vencimento <= '$dataf' ";
                            }
                            else {
                                $q .= "and vencimento <= '$dataf' ";
                                if (!empty($filtro1)) {
                                    $q .= "and tipo_despesa = '$filtro1'";
                                }
                                else {
                                    $q = "SELECT id, data_lancamento, vencimento, tipo_despesa, descricao, fornecedor, tipo_pagamento, valor, valor_pago, juros_multa, descontos, data_pagamento, veiculo, motorista, situacao, observacao 
                                    FROM contas_pagar ";
                                }
                            }
                            
                        }
                            
                        
                        echo "
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th>Fornecedor</th>
                                <th>Valor</th>
                                <th>Vencto.</th>
                                <th>Juros</th>
                                <th>Desc.</th>
                                <th>Valor Pago</th>
                                <th>Forma Pagto</th>
                                <th>Data Pagto.</th>
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
                                $soma_valor = 0;
                                $soma_juros = 0;
                                $soma_desc = 0;
                                $soma_pago = 0;
                                $descontos = 0;
                                while ($reg = $busca->fetch_object()) {

                                    $id = $reg->id;
                                    $dataFormatada = new DateTime($reg->data_lancamento);
                                    $data_lanc = $dataFormatada->format('d-m-Y');
                                    echo "<tr><td>$data_lanc";
                                    echo "<td>$reg->descricao";
                                    echo "<td>$reg->tipo_despesa";
                                    echo "<td>$reg->fornecedor";
                                    $valor = $reg->valor;
                                    $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);
                                    echo "<td>" . numfmt_format_currency($padrao, $valor, 'BRL') . " ";
                                    $dataFormatada = new DateTime($reg->vencimento);
                                    $vencimento = $dataFormatada->format('d-m-Y');
                                    echo "<td>$vencimento";

                                    $valor_pago = $reg->valor_pago;
                                    
                                    if ($valor_pago > $valor) {
                                        $juros_multa = $valor_pago - $valor;
                                        echo "<td>" . numfmt_format_currency($padrao, $juros_multa, 'BRL') . " ";
                                    }
                                    else {
                                        $juros_multa = 0;
                                        echo "<td>" . numfmt_format_currency($padrao, $juros_multa, 'BRL') . " ";
                                    }
                                    
                                    if ($valor_pago < $valor && $valor_pago <> 0) {
                                        $descontos = $valor - $valor_pago;
                                        echo "<td>" . numfmt_format_currency($padrao, $descontos, 'BRL') . " ";
                                    }
                                    else {
                                        $descontos = 0;
                                        echo "<td>" . numfmt_format_currency($padrao, $descontos, 'BRL') . " ";
                                    }
                    
                                    echo "<td>" . numfmt_format_currency($padrao, $valor_pago, 'BRL') . " ";
                                    
                                    echo "<td>$reg->tipo_pagamento";

                                    if ($reg->data_pagamento == null) {
                                        echo "<td>$reg->data_pagamento";
                                    }
                                    else {
                                        $ajuda = $reg->data_pagamento;
                                        $data = DateTime::createFromFormat('Y-m-d', $ajuda);
                                        $data_pagamento = $data->format('d-m-Y');
                                        echo "<td>$data_pagamento";
                                    }
                                    
                                    $status_p = $reg->situacao;

                                    if ($status_p == "Vencida") {
                                        echo "<td class='vencida'>$status_p";
                                    }
                                    else {
                                        echo "<td>$status_p";
                                    }

                                    
                                    if (is_admin()) {
                                    echo "<td class='bt-opcoes'> <a href='contas_pagar_edit_form.php?id=$id'><abbr title='Alterar'><i class='bi bi-pencil'></i></abbr></a>   |   ";
                                    echo " <a href='contas_pagar_cancelar_conf.php?id=$id'><abbr title='Cancelar'><i class='bi bi-trash'></i></abbr></a>  |   ";
                                    echo " <a href='contas_pagar_pagar_form.php?id=$id'> <abbr title='Pagar'><i class='bi bi-credit-card'></i></abbr></a>";
                                    }
                                    else if (is_operacional()) {
                                        echo "<td><i class='bi bi-eyeglasses'></i>";
                                    }

                                    $soma_valor += floatval($valor);
                                    $soma_juros += floatval($juros_multa);
                                    $soma_desc += floatval($descontos);
                                    $soma_pago += floatval($valor_pago);
                                }
                                echo "<tr><td class='total'><td class='total'><td class='total'><td class='total'>Total:";
                                echo "<td class='total'>" . numfmt_format_currency($padrao, $soma_valor, 'BRL') . "";
                                echo "<td class='total'>";
                                echo "<td class='total'>" . numfmt_format_currency($padrao, $soma_juros, 'BRL') . "";
                                echo "<td class='total'>" . numfmt_format_currency($padrao, $soma_desc, 'BRL') . "";
                                echo "<td class='total'>" . numfmt_format_currency($padrao, $soma_pago, 'BRL') . "";
                                
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