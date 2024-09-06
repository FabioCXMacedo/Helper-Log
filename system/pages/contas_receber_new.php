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
                
                    $descricao = $_POST['descricao'] ?? null;
                    $distancia = $_POST['distancia'] ?? null;
                    $data_viagem = $_POST['data_viagem'] ?? null;
                    $tipo = $_POST['tipo'] ?? null;
                    $veiculo = $_POST['veiculo'] ?? null;
                    $motorista = $_POST['motorista'] ?? null;
                    $cliente = $_POST['cliente'] ?? null;
                    $fornecedor = $_POST['fornecedor'] ?? null;
                    $valor1 = $_POST['valor1'] ?? null;
                    $vencimento = $_POST['data2'] ?? null;
                    $tipo_pagamento = $_POST['tipo_pagamento'] ?? null;
                    

                    $q = "INSERT INTO contas_receber (descricao, distancia, data_viagem, tipo, id_veiculo, id_motorista, cliente, fornecedor, valor, vencimento, tipo_receb, situacao, situacao_viagem) VALUES ('$descricao', '$distancia', '$data_viagem', '$tipo', '$veiculo', '$motorista', '$cliente', '$fornecedor', '$valor1', '$vencimento', '$tipo_pagamento', 'À receber', 'Programada')";
                                    
                    try {
                        if ($banco->query($q)) {
                            echo msg_sucesso("Conta cadastrada com sucesso!");
                            echo "
                                <div class='container'>
                                    <a href='viagens.php'>
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