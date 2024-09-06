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
    <title>Helper Log - Contas à Pagar</title>

</head>
<body>
    <div>
        <?php 
            if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
            }
            else {
                
                    $descricao = $_POST['descricao'] ?? null;
                    $tipo = $_POST['tipo'] ?? null;
                    $veiculo = $_POST['veiculo'] ?? null;
                    $motorista = $_POST['motorista'] ?? null;
                    $fornecedor = $_POST['fornecedor'] ?? null;
                    $valor1 = $_POST['valor1'] ?? null;
                    $tipo_pagamento = $_POST['tipo_pagamento'] ?? null;
                    $data2 = $_POST['data2'] ?? null;
                    

                    $q = "INSERT INTO contas_pagar (descricao, tipo_despesa, veiculo, motorista, fornecedor, valor, tipo_pagamento, vencimento) VALUES ('$descricao', '$tipo', '$veiculo', '$motorista', '$fornecedor', '$valor1', '$tipo_pagamento','$data2')";
                                    
                    try {
                        if ($banco->query($q)) {
                            echo msg_sucesso("Conta cadastrada com sucesso!");
                            echo "
                                <div class='container'>
                                    <a href='contas_pagar.php'>
                                        <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                                    </a>
                                </div>
                            ";
                        }
                    }
                    catch (Exception $e) {
                        echo "<p>Não foi possível cadastrar a conta. Tente novamente!.</p>";
                    }
                }
            
          
        ?>
    </div>
</body>