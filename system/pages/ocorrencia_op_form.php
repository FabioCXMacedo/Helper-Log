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
    <title>Helper Log - Ocorrências</title>

</head>
<body>
    <?php 
        include "topo_sys_op.php";
    ?>

    <div class="content checklist">
        <form action="ocorrencia_new.php" method="post" enctype="multipart/form-data">
        <div class='row mb-4 g-4'>
            <div class='col-6 check-form'>
                <label for='tipo' class='form-label' >Tipo</label>
                <select class="form-select" id="tipo" name="tipo">
                    <option value="Abastecimento">Abastecimento</option>
                    <option value="Manutenção">Manutenção</option>
                    <option value="Pedágio">Pedágio</option>
                    <option value="Outras">Outras</option>
                </select>
            </div>
            <div class='col-12 check-form'>
                <label for='descricao' class='form-label'>Descrição</label>
                <input type='text' class='form-control' id='descricao' name='descricao' required>
            </div>
            <div class='col-6 check-form'>
                <label for='valor' class='form-label'>Valor</label>
                <input type='number' class='form-control' id='valor' name='valor'>
            </div>
            <div class='col-6 check-form'>
                <label for='id_viagem' class='form-label'>ID da viagem</label>
                <input type='number' class='form-control' id='id_viagem' name='id_viagem'>
            </div>
            <div class='col-6 check-form'>
                <label for='veiculo' class='form-label'>ID veículo</label>
                <input type='number' class='form-control' id='veiculo' name='veiculo'>
            </div>
            <div class='col-6 check-form'>
                <label for='motorista' class='form-label'>ID motorista</label>
                <input type='number' class='form-control' id='motorista' name='motorista'>
            </div>
            <div class='col-12 check-form'>
                <label for='observacao' class='form-label'>Observação</label>
                <input type='text' class='form-control' id='observacao' name='observacao'>
            </div>
            <div class='col-12 check-form'>
                <label for='anexo' class='form-label'>Anexar Comprovante</label>
                <input type='file' class='form-control' id='anexo' name='imagem' accept="image/*">
            </div>
        </div>
                
            <input type="submit" value="Cadastrar" class="btn btn-outline-primary">
        </form>
    </div>

</body>
</html>