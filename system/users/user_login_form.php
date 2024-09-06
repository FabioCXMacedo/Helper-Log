<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../estilos/style_sys.css">
    <link rel="stylesheet" href="../estilos/login.css">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <title>Login</title>
</head>
<body>
    <header class="content row col topo">
        <div class="col-6 logo">
            <a href="../../index.php"><img src="../images/Logo-sys.png" alt="Logo" class="img-fluid"></a>
        </div>
    </header>

    <div class="home">
        <div class="col-sm-9 col-md-6 col-lg-4 form-login">
            <div class="col form">
                <p><h2>Seja bem vindo!</h2></p>
                <p><h5>Faça o Login para acessar o sistema</h5></p>    
                
                <form action="user_login.php" method="post">
                    <div class="col form">
                        <input type="text" name="usuario" id="usuario" placeholder="Usuário" class="form-control" size="10" maxlength="10">
                    </div>
                    <div class="col form">
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" size="8" maxlength="8">
                    </div>
                    <div class="col form">
                        <input type="submit" value="Entrar" class="btn btn-outline-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>