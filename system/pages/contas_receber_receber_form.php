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
                
                $q = "select id, data_lancamento, vencimento, tipo, descricao, cliente, tipo_receb, valor, valor_receb, juros_multa, descontos, data_recebimento, situacao from contas_receber WHERE id=$id";

                $busca = $banco->query($q);
                $reg = $busca->fetch_object();

                $saldo = $reg->valor - $reg->valor_receb;
            }
            else {
                echo "Registro não encontrado.";
            }
            echo "
                <div class='content checklist'>
                    <form action='contas_receber_receber.php?id=$id>' method='post'>
                        <div class='row mb-4 g-4'>
                            <div class='col-4 check-form'>
                                <label for='descricao' class='form-label'>Itinerário</label>
                                <input type='text' class='form-control' id='descricao' name='descricao' value='$reg->descricao' readonly>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='tipo' class='form-label' >Tipo</label>
                                <input type='text' class='form-control' id='tipo' name='tipo' value=' $reg->tipo' readonly>
                            </div>
                            <div class='col-3 check-form'>
                                <label for='cliente' class='form-label'>Cliente</label>
                                <input type='text' class='form-control' id='cliente' name='cliente' value='$reg->cliente' readonly>
                            </div>
                            <div class='col-3 check-form'>
                                <label for='fornecedor' class='form-label'>Fornecedor</label>
                                <input type='text' class='form-control' id='fornecedor' name='fornecedor' value='$reg->fornecedor' readonly>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='data2' class='form-label'>Data de Vencimento</label>
                                <input type='date' class='form-control' id='data2' name='data2' value='$reg->vencimento' readonly>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='valor1' class='form-label'>Valor</label>
                                <input type='number ' class='form-control' id='valor1' name='valor1' value='$reg->valor' readonly>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='juros_multa' class='form-label'>Juros/Multa</label>
                                <input type='number ' class='form-control' id='juros_multa' name='juros_multa'>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='descontos' class='form-label'>Descontos</label>
                                <input type='number ' class='form-control' id='descontos' name='descontos'>
                            </div>
                            <div class='col-4 check-form'>
                                <label for='tipo-pagamento' class='form-label'>Forma de Pagamento</label>
                                <input type='text' class='form-control' id='tipo_pagamento' name='tipo_pagamento' value='$reg->tipo_receb' required>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='valor_recebido' class='form-label'>Valor recebido</label>
                                <input type='number' class='form-control' id='valor_recebido' name='valor_recebido' value='$reg->valor_receb' required>
                            </div>
                            <div class='col-2 check-form'>
                                <label for='saldo' class='form-label'>Saldo à receber</label>
                                <input type='number' class='form-control' id='saldo' name='saldo' value='$saldo'>
                            </div>
                            
                        </div>
                        <a href='contas_receber.php'><input type='button' value='Voltar' class='btn btn-outline-primary'></a>
                        <input type='submit' value='Receber' class='btn btn-outline-primary'>
                    </form>
                </div>
            ";
        }
    ?>
</body>
</html>