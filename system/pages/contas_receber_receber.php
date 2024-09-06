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
    <title>Helper Log - Contas à Receber</title>

</head>
<body>
    <div>
        <?php 
            if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
            }
            else {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $juros_multa = $_POST['juros_multa'] ?? null;
                    $descontos = $_POST['descontos'] ?? null;
                    $valor_recebido = $_POST['valor_recebido'] ?? null;
                    $tipo_pagamento = $_POST['tipo_pagamento'] ?? null;
                    $valor1 = $_POST['valor1'] ?? null;

                    if ($descontos <= 0 && $valor_recebido < $valor1) {
                        $q = "UPDATE contas_receber SET tipo = '$tipo_pagamento', valor_receb = '$valor_recebido', situacao = 'Recebido Parcial', data_recebimento = current_timestamp() WHERE id = '$id'";
                    }
                    else {
                        $q = "UPDATE contas_receber SET tipo = '$tipo_pagamento', juros_multa = '$juros_multa', descontos = '$descontos', valor_receb = '$valor_recebido', situacao = 'Recebido', data_recebimento = current_timestamp() WHERE id = '$id'";
                    }
                    
                    try {
                        if ($banco->query($q)) {
                            echo msg_sucesso("Conta recebida com sucesso!");
                            echo "
                                <div class='container'>
                                    <a href='contas_receber.php'>
                                        <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                                    </a>
                                </div>
                            ";
                        }
                    }
                    catch (Exception $e) {
                        echo "<p>Não foi possível receber a conta. Tente novamente! " . $e->getMessage() . "</p>";
                        echo "
                            <div class='container'>
                                <a href='contas_receber.php'>
                                    <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                                </a>
                            </div>
                        ";
                        echo " | $descricao ";
                        echo " | $tipo ";
                        echo " | $fornecedor ";
                        echo " | $valor1 ";
                        echo " | $tipo_pagamento ";
                        echo " | $data2 ";
                        echo " | $id ";
                    }
                }
                else {
                    echo "Registro não encontrado.";
                    echo $id;
                }
            }
            
          
        ?>
    </div>
</body>