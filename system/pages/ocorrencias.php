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

    <title>Helper Log - Ocorrências</title>

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
            <p>Ocorrências</p>
        </div>
        
        <div class="row content col-12 menu-sub">
            <div class='menu-item-sub col-1'>
                <a href="ocorrencia_new_form.php">
                    <div class='menu-icon-sub'>
                        <i class="bi bi-suitcase-lg-fill"></i>
                    </div>
                    <div class='menu-title-sub'>
                        <p>Nova Ocorrência</p>
                    </div>
                </a>
            </div>
            <div class="container col filtros">
                <form action="ocorrencias.php" method="get" id="busca">
                    <div class="row ">
                        <div class="col-1 filtros-a">
                            <span for="tipo">Tipo: </span>
                        </div>
                        <div class="col-2 filtros-a">
                            <select class="form-select" id="filtro1" name="filtro1">
                                <option value=""></option>
                                <option value="Abastecimento">Abastecimento</option>
                                <option value="Manutenção">Manutenção</option>
                                <option value="Pedágio">Pedágio</option>
                                <option value="Outras">Outras</option>
                            </select>
                        </div>

                        <div class="col-1 filtros-a">
                            <span for="vencimento">Data: </span>
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
                                <option value="Conferir">Conferir</option>
                                <option value="Conferida">Conferida</option>
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

                        $q = "SELECT o.id, o.data_criacao, o.tipo, o.descricao, o.valor, o.anexo, o.id_viagem, o.id_veiculo, o.id_motorista, o.id_user, o.observacao, o.situacao, v.idv, v.placa1, v.placa2, m.idm, m.nome 
                        FROM ocorrencias o 
                        LEFT JOIN veiculos v ON v.idv = o.id_veiculo
                        LEFT JOIN motoristas m ON m.idm = o.id_motorista ";

                        if (!empty($filtro2)) {
                            $q .= "WHERE situacao = '$filtro2' ";
                            if (!empty($datai)) {
                                $q .= "and data_criacao >= '$datai' and data_criacao <= '$dataf' ";
                            }
                            else {
                                $q .= "and data_criacao <= '$dataf' ";
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
                                $q .= "and data_criacao >= '$datai' and data_criacao <= '$dataf' ";
                            }
                            else {
                                $q .= "and data_criacao <= '$dataf' ";
                                if (!empty($filtro1)) {
                                    $q .= "and tipo = '$filtro1'";
                                }
                                
                            }
                            
                        }

                        if (empty($filtro1) && empty($filtro2) && empty($datai) && empty($dataf)) {
                            $q = "SELECT o.id, o.data_criacao, o.tipo, o.descricao, o.valor, o.anexo, o.id_viagem, o.id_veiculo, o.id_motorista, o.id_user, o.observacao, o.situacao, v.idv, v.placa1, v.placa2, m.idm, m.nome 
                            FROM ocorrencias o 
                            LEFT JOIN veiculos v ON v.idv = o.id_veiculo
                            LEFT JOIN motoristas m ON m.idm = o.id_motorista ";
                        }                            
                        
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
                                <th>Observação</th>
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
                                    echo "<td>$reg->observacao";

                                    echo "<td class='bt-opcoes'> 
                                        <a href='$reg->anexo'>
                                            <i class='bi bi-paperclip'></i>
                                        </a>   |   ";
                                    echo "
                                        <a href='ocorrencia_edit_form.php?id=$id'>
                                            <i class='bi bi-pencil'></i>
                                        </a>   |   ";
                                    echo "
                                        <a href='ocorrencia_conferir.php?id=$id'>
                                            <i class='bi bi-list-check'></i>
                                        </a>   |   ";
                                    echo " 
                                        <a href='ocorrencia_cancelar_conf.php?id=$id'>
                                            <i class='bi bi-trash'></i>
                                        </a>";
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