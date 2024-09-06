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
    <title>Helper Log - Desvincular Motorista</title>

</head>
<body>
    <?php 

        if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
            }
        else {

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                
                $q = "UPDATE dirigir SET id_veiculo = NULL
                WHERE id_motorista = '$id'";

                try {
                    if ($banco->query($q)) {
                            echo msg_sucesso("Desvinculado com sucesso!");
                            echo "
                                <div class='container'>
                                    <a href='motoristas.php'>
                                        <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                                        </a>
                                </div>
                            ";
                        }
                }
                catch (Exception $e) {
                    echo "<p>Não foi possível desvincular o veículo. Tente novamente! " . $e->getMessage() . "</p>";
                    echo $id;
                    
                    echo "
                    <div class='container'>
                    <a href='motoristas.php'>
                    <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                    </a>
                    </div>
                    ";
                }
            }
        }

    ?>
</body>
</html>