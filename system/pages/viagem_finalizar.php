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
    <title>Helper Log - Viagens</title>

</head>
<body>
    <div>
        <?php 
           
            $id = $_POST['id'] ?? null;
            $km_final = $_POST['km_final'] ?? null;
            
            $q = "SELECT km_inicial FROM contas_receber
                WHERE id=$id";

            

            $busca = $banco->query("$q");

                if (!$busca) {
                    echo "<tr><td>Infelizmente a busca deu errado";
                }
                else {
                    if ($busca->num_rows == 0) {
                        echo "<tr><td>Nenhum registro encontrado";
                    }
                    else {
                        while ($reg = $busca->fetch_object()) {
                            $km_inicial = $reg->km_inicial;
                        }
                    }
                }
            
            $km_rodado = $km_final - $km_inicial;
            
            $q2 = "UPDATE contas_receber SET situacao_viagem = 'Finalizada', km_final = '$km_final', km_rodado = '$km_rodado', viagem_fim = CURRENT_TIMESTAMP WHERE id = '$id'";


            try {
                if ($banco->query($q) && $banco->query($q2)) {
                    echo msg_sucesso("Viagem finalizada com sucesso!");
                    echo "
                        <div class='container'>
                            <a href='viagens_op.php'>
                                <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                            </a>
                        </div>
                    ";
                }
            }
            catch (Exception $e) {
                echo "<p>Não foi possível finalizar a viagem. Tente novamente! " . $e->getMessage() . "</p>";
                echo "
                    <div class='container'>
                        <a href='viagens_op.php'>
                            <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                        </a>
                    </div>
                ";
                
            }
            
        ?>
    </div>
</body>
</html>