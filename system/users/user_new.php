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
        <title>Novo Usuário</title>
    </head>

    <body>
        <div class="content" id="corpo">
            
            <?php 
                if (!is_admin()) {
                    echo msg_erro('Área restrita. Você não é administrador!');
                }
                else {
                    if (!isset($_POST['usuario'])) {
                        require "user_new_form.php";
                    }
                    else {
                        $id = $_POST['id'] ?? null;
                        $usuario = $_POST['usuario'] ?? null;
                        $nome = $_POST['nome'] ?? null;
                        $senha1 = $_POST['senha1'] ?? null;
                        $senha2 = $_POST['senha2'] ?? null;
                        $tipo = $_POST['tipo'] ?? null;

                        if ($senha1 === $senha2) {
                            if (empty($usuario) || empty($nome) || empty($senha1) || empty($senha2) || empty($tipo)) {
                                echo msg_erro("Todos os dados são obrigatórios!");
                            }
                            else {
                                $senha = gerarHash($senha1);
                                $q = "INSERT INTO usuarios (id_usuario, usuario, nome, senha, tipo, situacao) VALUES ('$id', '$usuario', '$nome', '$senha', '$tipo', 'Ativo')";
                                
                                try {
                                    if ($banco->query($q)) {
                                        echo msg_sucesso("Usuário $nome cadastrado com sucesso!");
                                    }
                                }
                                catch (Exception $e) {
                                    echo "<div class='container erro'>Não foi possível criar o usuário $usuario. Talvez o login já esteja sendo usado.</div>";
                                }
                            }
                        }
                        else {
                            echo msg_erro("Senhas não conferem. Repita o procedimento.");
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

    </body>

</html>