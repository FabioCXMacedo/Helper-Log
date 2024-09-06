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
    <link rel="stylesheet" href="../estilos/administrativo.css">

    <title>Helper Log - Usuários</title>

</head>
<body>
    <div class="content col-12 titulo-listagem">
        <p>Usuários</p>
    </div>


    <?php
        if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
        }
        else {
            echo "
                <div class='row content col-12'>
                    
                    <div class='menu-item-sub col-1'>
                        <a href='user_new_form.php'>
                            <div class='menu-icon-sub'>
                                <i class='bi bi-person-add'> </i>
                            </div>
                            <div class='menu-title-sub'>
                                <p>Novo Usuário</p>
                            </div>
                        </a>
                    </div>
                   
                    <div class='container col-12 listagem'>
                        <table class='listagem'>
            ";

            include "../pages/topo_sys.php";

            $q = "SELECT id_usuario, usuario, nome, senha, tipo, situacao FROM usuarios ORDER BY nome ";
            $busca = $banco->query("$q");

            

            if (!$busca) {
                echo "<tr><td>Infelizmente a busca deu errado";
            }
            else {
                if ($busca->num_rows == 0) {
                    echo "<tr><td>Nenhum registro encontrado";
                }
                else {
                    echo "
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Situação</th>
                            <th class='opcoes'>Alterar</th>
                            <th class='opcoes'>Inativar</th>
                            <th class='opcoes'>Ativar</th>
                        </tr>
                    ";
                    while ($reg = $busca->fetch_object()) {
                        echo "<tr><td>$reg->id_usuario";
                        $usuario = $reg->usuario;
                        echo "<td>$reg->usuario";
                        echo "<td>$reg->nome";              
                        echo "<td>$reg->tipo";
                        echo "<td>$reg->situacao";                
                        echo "<td class='bt-opcoes-y'><a href='user_edit_form.php?usuario=$usuario'><i class='bi bi-pencil'></i></a>";               
                        echo "<td class='bt-opcoes-r'><a href='user_inativar_conf.php?usuario=$usuario'><i class='bi bi-person-fill-x'></i></a>";
                        echo "<td class='bt-opcoes-g'><a href='user_ativar.php?usuario=$usuario'><i class='bi bi-person-fill-check'></i></a>";               
                    }
                    echo "            
                            </table>
                        </div>
                    </div>
                    ";
                }
            }
        }

        include "../pages/footer_sys.php";
    ?>


</body>
</html>