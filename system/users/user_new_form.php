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
    <title>Helper Log - Cadastrar novo usuário</title>

</head>
<body>
    <?php 
        include "../pages/topo_sys.php";
    ?>

    <div class="content checklist">
        <form action="user_new.php" method="post">
            <div class="col-3 check-form">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" name="id">
            </div>
            <div class="col-3 check-form">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="col-4 check-form">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-4 check-form">
                <label for="tipo" class="form-label" >Tipo</label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="Administrador">Administrador</option>
                    <option value="Estrategico">Estratégico</option>
                    <option value="Operacional">Operacional</option>
                </select>
            </div>
            <div class="col-3 check-form">
                <input type="password" name="senha1" id="senha1" class="form-control" placeholder="Senha" size="8" maxlength="8">
            </div>
            <div class="col-3 check-form">
                <input type="password" name="senha2" id="senha2" class="form-control" placeholder="Confirme a Senha" size="8" maxlength="8">
            </div>
            <div class="col-1 check-form">
                <input type="submit" value="Salvar" class="btn btn-outline-primary">
            </div>

        </form>
    </div>

    <?php 
        include "../pages/footer_sys.php";
    ?>
</body>
</html>