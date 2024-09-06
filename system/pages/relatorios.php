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

    <link rel="stylesheet" href="../estilos/relatorios.css">
    <link rel="stylesheet" href="../estilos/administrativo.css">
    <link rel="stylesheet" href="../estilos/style_sys.css">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <title>Helper Log - Relatórios</title>

</head>
<body>
    <?php
     
        if (!is_logado()) {
            echo msg_erro("Faça login para acessar o sistema!");
            echo voltar();
        }
        else {
            if (!is_admin()) {
                echo msg_erro('Área restrita. Você não é administrador!');
            }
            else {
            
                include "topo_sys.php";

                echo "
                    <div class='content col-12 titulo-listagem'>
                        <p>Relatórios</p>
                    </div>
                    <div class='container relatorios'>
                        <div class='row col-12'>
                            <div class='col-4'>
                                <a href='../relatorios/relatorio1_form.php'>
                                    <input type='submit' value='Custos por viagem' class='botao-relatorio'>
                                </a>
                            </div>
                            <div class='col-4'>
                                <a href='../relatorios/relatorio2_form.php'>
                                    <input type='submit' value='Produtividade por veículo' class='botao-relatorio'>
                                </a>
                            </div>
                        </div>
                    </div>
                ";
                include "footer_sys.php";
            }
        }

    ?>


</body>

</html>