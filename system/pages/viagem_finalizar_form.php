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
    <link rel="stylesheet" href="../estilos/operacional.css">

    <title>Helper Log - Viagens</title>

</head>
<body>
        
    <?php 
        include "topo_sys_op.php";

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo $id;
            echo "
                <div class='content col-12 titulo-listagem'>
                    <p>Cadastro de veículos</p>
                </div>
            
                <div class='container'>
                    <form action='viagem_finalizar.php' method='post'>
                        <div class='row mb-4 g-4'>
                            <div class='col-4 check-form'>
                                <label for='id' class='form-label'>ID da viagem</label>
                                <input type='number' class='form-control' id='id' name='id' value='$id' readonly>
                            </div>
                            <div class='col-8 check-form'>
                                <label for='km_final' class='form-label'>Informe a Kilometragem final</label>
                                <input type='number' class='form-control' id='km_final' name='km_final' required>
                            </div>
                        </div>
                        
                        <input type='submit' value='Finalizar Viagem' class='btn btn-outline-primary'>
                        
                    </form>
                </div> 
            ";   
            include "footer_sys.php";
        }
    ?>

</body>
</html>