<!DOCTYPE html>

<?php 
    require_once "../includes/banco.php";
    require_once "../includes/login.php";
    require_once "../includes/funcoes.php";
?>

<html lang="pt_br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link rel="stylesheet" href="../estilos/style_sys.css">
        <link rel="stylesheet" href="../estilos/administrativo.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">

        <title>Alterar dados do usuário</title>
    </head>

    <body>
        <div id="corpo">
            <?php
                if(!is_admin()) {
                    echo msg_erro("Acesso negado! Você não é Administrador do sistema!");
                }
                else {
                    if(!isset($_POST['usuario'])) {
                        include "user_edit_form.php";
                    }
                    else {
                        $id = $_POST['id'] ?? null;
                        $usuario = $_POST['usuario'] ?? null;
                        $nome = $_POST['nome'] ?? null;
                        $tipo = $_POST['tipo'] ?? null;
                        $senha1 = $_POST['senha1'] ?? null;
                        $senha2 = $_POST['senha2'] ?? null;

                        $q = "UPDATE usuarios SET tipo = '$tipo', id_usuario = '$id', nome = '$nome' ";

                        if (empty($senha1) || is_null($senha1)) {
                            echo msg_aviso("Senha antiga foi mantida.");
                        }
                        else {
                            if ($senha1 === $senha2) {
                                $senha = gerarHash($senha1);
                                $q .= ", senha = '$senha' ";
                            }
                            else {
                                echo msg_erro("Senhas não conferem. A senha anterior será mantida.");
                            }
                        }

                        $q .= " WHERE usuario = '$usuario'";

                        if ($banco->query($q)) {
                            echo msg_sucesso("Usuário alterado com sucesso!");
                        }
                        else {
                            echo msg_erro("Não foi possível alterar os dados.");
                        }
                    }
                } 
                echo "
                    <div class='botao-voltar'>
                        <a href='users.php'>
                            <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                        </a>
                    </div>
                ";
            ?>
        </div>

        <?php 
            require_once "../pages/footer_sys.php";
        ?>
    </body>

</html>