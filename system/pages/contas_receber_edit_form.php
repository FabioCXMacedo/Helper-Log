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
    <link rel="stylesheet" href="../estilos/checklist.css">
    <link rel="stylesheet" href="../estilos/administrativo.css">
    <title>Helper Log - Contas à Receber</title>

</head>
<body>
    <?php 
        include "topo_sys.php";

        if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
            }
        else {

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                
                $q = "SELECT c.id, c.data_lancamento, c.data_viagem, c.descricao, c.distancia, c.tipo, c.id_veiculo, c.id_motorista, c.cliente, c.fornecedor, c.valor, c.custo, c.vencimento, c.data_recebimento, c.valor_receb, c.tipo_receb, c.saldo, c.juros_multa, c.situacao, c.descontos, m.idm, m.nome, v.idv, v.placa1, v.placa2
                FROM contas_receber c
                LEFT JOIN veiculos v ON v.idv = c.id_veiculo
                LEFT JOIN motoristas m ON m.idm = c.id_motorista  
                WHERE c.id='$id' ";

                $busca = $banco->query($q);
                $reg = $busca->fetch_object();
            }
            else {
                echo "Registro não encontrado.";
            }
            echo "
                <div class='content checklist'>
                    <form action='contas_receber_edit.php?id=$id>' method='post'>
                        <div class='row mb-4 g-4'>
                            <div class='col-6 check-form'>
                                <label for='descricao' class='form-label'>Itinerário</label>
                                <input type='text' class='form-control' id='descricao' name='descricao' value='$reg->descricao' required>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='distancia' class='form-label'>Distância</label>
                                <input type='number' class='form-control' id='distancia' name='distancia' value='$reg->distancia' required>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='data_viagem' class='form-label'>Data da viagem</label>
                                <input type='date' class='form-control' id='data_viagem' name='data_viagem' value='$reg->data_viagem' required>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='tipo' class='form-label' >Tipo</label>
                                <select class='form-select' id='tipo' name='tipo' value=' $reg->tipo' required>
                                    <option value='Frete próprio'>Frete próprio</option>
                                    <option value='Frete terceiro'>Frete terceiro</option>
                                </select>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='motorista' class='form-label'>ID Motorista</label>
                                <input type='number' class='form-control' id='motorista' name='motorista' value='$reg->idm'>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='veiculo' class='form-label'>ID veiculo</label>
                                <input type='number' class='form-control' id='veiculo' name='veiculo' value='$reg->idv'>
                            </div>
                            <div class='col-4 check-form'>
                                <label for='cliente' class='form-label'>Cliente</label>
                                <input type='text' class='form-control' id='cliente' name='cliente' value='$reg->cliente'>
                            </div>
                            <div class='col-4 check-form'>
                                <label for='fornecedor' class='form-label'>Fornecedor</label>
                                <input type='text' class='form-control' id='fornecedor' name='fornecedor' value='$reg->fornecedor'>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='valor1' class='form-label'>Valor</label>
                                <input type='number ' class='form-control' id='valor1' name='valor1' value='$reg->valor' required>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='custo' class='form-label'>Custo</label>
                                <input type='number ' class='form-control' id='custo' name='custo' value='$reg->custo'>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='data2' class='form-label'>Data de Vencimento</label>
                                <input type='date' class='form-control' id='data2' name='data2' value='$reg->vencimento' required>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='tipo-pagamento' class='form-label'>Forma de Pagamento</label>
                                <input type='text' class='form-control' id='tipo_pagamento' name='tipo_pagamento' value='$reg->tipo_receb' required>
                            </div>
                            
                        </div>
                        <a href='contas_receber.php'><input type='button' value='Voltar' class='btn btn-outline-primary'></a>
                        <input type='submit' value='Alterar' class='btn btn-outline-primary'>
                    </form>
                </div>
            ";
        }
    ?>
</body>
</html>