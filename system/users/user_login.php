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
        <link rel="stylesheet" href="../estilos/checklist.css">

        <title>Login</title>
        
    </head>

    <body>
        <div id="corpo">
            <?php
                
                $usuario = $_POST['usuario'] ?? null;
                $senha = $_POST['senha'] ?? null;

                if (is_null($usuario) || is_null($senha)) {
                    require "user_login_form.php";
                }
                else {
                    $q = "SELECT id_usuario, usuario, nome, senha, tipo, situacao FROM usuarios WHERE usuario = '$usuario' LIMIT 1";
                    $busca = $banco->query($q);

                    if(!$busca) {
                        echo msg_erro('Falha ao acessar o banco!');
                    }
                    else {
                        if ($busca->num_rows > 0) {
                            $reg = $busca->fetch_object();
                            if (testarHash($senha, $reg->senha)) {
                                $_SESSION['user'] = $reg->usuario;
                                $_SESSION['nome'] = $reg->nome;
                                $_SESSION['tipo'] = $reg->tipo;
                                $_SESSION['id'] = $reg->id_usuario;
                                
                                if ($reg->situacao == 'Inativo') {
                                    echo msg_erro('Usuário Inativo! Consulte o Administrador do sistema!');
                                }
                                else {
                                    if ($_SESSION['tipo'] == 'Administrador' || $_SESSION['tipo'] == 'Estrategico') {
                                        header("Location: ../pages/administrativo.php");
                                    }
                                    else {
                                        header("Location: ../pages/operacional.php");
                                    }
                                }
                            }
                            else {
                                echo msg_erro('Senha inválida!');
                            }
                        }
                        else {
                            echo msg_erro('Usuário não existe');
                        }
                    }
                }
                echo voltar();
            ?>
        </div>
    </body>
    
</html>