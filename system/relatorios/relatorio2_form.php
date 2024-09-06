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
    <link rel="stylesheet" href="../estilos/relatorios.css">
    <title>Helper Log - Produtividade por veículo</title>

</head>
<body>
    <?php 
        include "../pages/topo_sys.php";
    ?>

    <div class="content checklist">
        <form action="relatorio2.php" method="post">
            <div class='row mb-4 g-4'>
                <div class='col-3 check-form'>
                    <label for='id' class='form-label'>Informe o ID  da veículo</label>
                    <input type='number' class='form-control' id='id' name='id' required>
                </div>
                <div class='col-3 check-form'>
                    <label for='datai' class='form-label'>Informe a data inicial</label>
                    <input type='date' class='form-control' id='datai' name='datai' required>
                </div>
                <div class='col-3 check-form'>
                    <label for='dataf' class='form-label'>Informe a data final</label>
                    <input type='date' class='form-control' id='dataf' name='dataf' required>
                </div>
            </div>

            <input type="submit" value="Gerar" class="btn btn-outline-primary">

        </form>
    </div>

</body>
</html>