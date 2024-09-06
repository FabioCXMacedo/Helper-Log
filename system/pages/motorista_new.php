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
    <title>Helper Log - Cadastro de motoristas</title>

</head>
<body>
    <div>
        <?php 
            if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
            }
            else {
                
                    $cpf = $_POST['cpf'] ?? null;
                    $nome = $_POST['nome'] ?? null;
                    $telefone1 = $_POST['telefone1'] ?? null;
                    $telefone2 = $_POST['telefone2'] ?? null;
                    $hab_categoria = $_POST['hab_categoria'] ?? null;
                    $hab_vencimento = $_POST['hab_vencimento'] ?? null;

                    $q = "INSERT INTO motoristas (cpf, nome, telefone1, telefone2, hab_categoria, hab_vencimento) VALUES ('$cpf', '$nome', '$telefone1', '$telefone2', '$hab_categoria', '$hab_vencimento') ";

                    $s = "SELECT max(idm) as max_id FROM motoristas";
                    $busca = $banco->query($s);

                    while ($reg = $busca->fetch_object()) {
                        $id_motorista = ($reg->max_id) + 1;
                    }

                    $t = "INSERT INTO dirigir (id_motorista) VALUES ('$id_motorista')";
                    
                    try {
                        if ($banco->query($q) && $banco->query($s) && $banco->query($t)) {
                            echo msg_sucesso("Motorista cadastrado com sucesso!");
 
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
                        echo "<p>Não foi possível cadastrar a conta. Tente novamente!.</p>";
                        echo $e->getMessage();
                        echo $cpf, $nome, $telefone1, $telefone2, $hab_categoria, $hab_vencimento, $id_motorista;
                    }

                }
            
          
        ?>
    </div>
</body>