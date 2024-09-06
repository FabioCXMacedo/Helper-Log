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
    ?>

    <div class="content checklist">
        <form action="contas_receber_new.php" method="post">
        <div class='row mb-4 g-4'>
            <div class='col-6 check-form'>
                <label for='descricao' class='form-label'>Itinerário</label>
                <input type='text' class='form-control' id='descricao' name='descricao' required>
            </div>
            <div class='col-2 check-form'>
                <label for='distancia' class='form-label'>Distância</label>
                <input type='number' class='form-control' id='distancia' name='distancia' required>
            </div>
            <div class='col-2 check-form'>
                <label for='data_viagem' class='form-label'>Data da viagem</label>
                <input type='date' class='form-control' id='data_viagem' name='data_viagem' required>
            </div>
            <div class='col-2 check-form'>
                <label for='tipo' class='form-label' >Tipo</label>
                <select class='form-select' id='tipo' name='tipo' required>
                    <option value='Frete próprio'>Frete próprio</option>
                    <option value='Frete terceiro'>Frete terceiro</option>
                </select>
            </div>
            <div class='col-1 check-form'>
                <label for='veiculo' class='form-label'>ID veículo</label>
                <input type='number' class='form-control' id='veiculo' name='veiculo'>
            </div>
            <div class='col-1 check-form'>
                <label for='motorista' class='form-label'>ID motorista</label>
                <input type='number' class='form-control' id='motorista' name='motorista'>
            </div>
            <div class='col-5 check-form'>
                <label for='cliente' class='form-label'>Cliente</label>
                <input type='text' class='form-control' id='cliente' name='cliente'>
            </div>
            <div class='col-5 check-form'>
                <label for='fornecedor' class='form-label'>Fornecedor</label>
                <input type='text' class='form-control' id='fornecedor' name='fornecedor'>
            </div>
            <div class='col-3 check-form'>
                <label for='valor1' class='form-label'>Valor</label>
                <input type='number ' class='form-control' id='valor1' name='valor1' required>
            </div>
            <div class='col-3 check-form'>
                <label for='data2' class='form-label'>Data de Vencimento</label>
                <input type='date' class='form-control' id='data2' name='data2' required>
            </div>
            <div class='col-4 check-form'>
                <label for='tipo-pagamento' class='form-label'>Forma de Pagamento</label>
                <input type='text' class='form-control' id='tipo_pagamento' name='tipo_pagamento' required>
            </div>
        </div>
                
            <input type="submit" value="Cadastrar" class="btn btn-outline-primary">
        </form>
    </div>

</body>
</html>