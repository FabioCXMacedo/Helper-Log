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
    <title>Helper Log - Cadastro de motoristas</title>

</head>
<body>
    <?php 
        include "topo_sys.php";
    ?>
    <div class='content col-12 titulo-listagem'>
        <p>Cadastrar motorista</p>
    </div>
    <div class="container checklist-adm">
        <form action="motorista_new.php" method="post">
            <div class="row mb-4 g-4">
                <div class="col-4 check-form">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>
                <div class="col-8 check-form">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="col-3 check-form">
                    <label for="telefone1" class="form-label">Telefone 1</label>
                    <input type="text" class="form-control" id="telefone1" name="telefone1" required>
                </div>
                <div class="col-3 check-form">
                    <label for="telefone2" class="form-label">Telefone 2</label>
                    <input type="text" class="form-control" id="telefone2" name="telefone2">
                </div>
                <div class="col-3 check-form">
                    <label for="hab_categoria" class="form-label">Categoria da Habilitação</label>
                    <input type="text" class="form-control" id="hab_categoria" name="hab_categoria" required>
                </div>
                <div class="col-3 check-form">
                    <label for="hab_vencimento" class="form-label">Vencimento da Habilitação</label>
                    <input type="date" class="form-control" id="hab_vencimento" name="hab_vencimento" required>
                </div>
            </div>
            <input type="submit" value="Cadastrar" class="btn btn-outline-primary">
        </form>
    </div>

</body>
</html>