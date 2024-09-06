<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="pt-BR">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/popup.css">

    <title>Confirmação</title>
</head>
<body>

    <?php 
        if (isset($_GET['usuario'])) {
            $usuario = $_GET['usuario'];
        }
        else {
            echo "Não foi possível cancelar!";
        }

    ?>

    <div class="popup">
        <h2>Inativar Usuário</h2>
        <p>Tem certeza de que deseja Inativar o usuário <strong>"<?php echo $usuario ?>"</strong>?</p>
        <a href="users.php"><button>Voltar</button></a>
        <a href="user_inativar.php?usuario=<?php echo $usuario ?>">
            <button>Confirmar</button>
        </a>
    </div>

</body>
</html>