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
    <title>Helper Log - Alterar veículos</title>

</head>
<body>
    <div>
        <?php 
            
            $id = $_POST['id'] ?? null;
            $descricao = $_POST['veiculo'] ?? null;
            $placa1 = $_POST['placa1'] ?? null;
            $placa2 = $_POST['placa2'] ?? null;
            $ano_fab = $_POST['ano'] ?? null;
            $modelo = $_POST['modelo'] ?? null;
            $id_motorista = $_POST['idmotorista'] ?? null;
            $kilometragem = $_POST['kmatual'] ?? null;
            $troca_oleo = $_POST['troca-oleo'] ?? null;
            $ptroca_oleo = $_POST['ptroca-oleo'] ?? null;
            $troca_bronzina = $_POST['troca-bronzina'] ?? null;
            $ptroca_bronzina = $_POST['ptroca-bronzina'] ?? null;
            $pneu1 = $_POST['pneu1'] ?? null;
            $pneu2 = $_POST['pneu2'] ?? null;
            $pneu3 = $_POST['pneu3'] ?? null;
            $pneu4 = $_POST['pneu4'] ?? null;
            $pneu5 = $_POST['pneu5'] ?? null;
            $pneu6 = $_POST['pneu6'] ?? null;
            $pneu7 = $_POST['pneu7'] ?? null;
            $pneu8 = $_POST['pneu8'] ?? null;
            $pneu9 = $_POST['pneu9'] ?? null;
            $pneu10 = $_POST['pneu10'] ?? null;
            $pneu11 = $_POST['pneu11'] ?? null;
            $pneu12 = $_POST['pneu12'] ?? null;
            $pneu13 = $_POST['pneu13'] ?? null;
            $pneu14 = $_POST['pneu14'] ?? null;
            $pneu15 = $_POST['pneu15'] ?? null;
            $pneu16 = $_POST['pneu16'] ?? null;
            $pneu17 = $_POST['pneu17'] ?? null;
            $pneu18 = $_POST['pneu18'] ?? null;
            $pneu19 = $_POST['pneu19'] ?? null;
            $pneu20 = $_POST['pneu20'] ?? null;
            $pneu21 = $_POST['pneu21'] ?? null;
            $pneu22 = $_POST['pneu22'] ?? null;

            

            $alerta_oleo = ($ptroca_oleo - $kilometragem);
            if ($alerta_oleo > 1000) {
                $alerta_troca_oleo = 'OK';
            }
            elseif ($alerta_oleo < 1000 &&  $alerta_oleo > 0) {
                $alerta_troca_oleo = 'Trocar';
            }
            else {
                $alerta_troca_oleo = 'Trocar com urgência';
            }

            $alerta_bronzina = ($ptroca_bronzina - $kilometragem);
            if ($alerta_bronzina > 1000) {
                $alerta_troca_bronzina = 'OK';
            }
            elseif ($alerta_bronzina < 1000 && $alerta_bronzina > 0) {
                $alerta_troca_bronzina = 'Trocar';
            }
            else {
                $alerta_troca_bronzina = 'Trocar com urgência';
            }
            
            
            $q = "UPDATE veiculos SET 
            placa2 = '$placa2', 
            ano_fab = '$ano_fab', 
            modelo = '$modelo',
            kilometragem = '$kilometragem',
            troca_oleo = '$troca_oleo',
            p_troca_oleo = '$ptroca_oleo',
            alerta_troca_oleo = '$alerta_troca_oleo',
            troca_bronzina = '$troca_bronzina',
            p_troca_bronzina = '$ptroca_bronzina',
            alerta_troca_bronzina = '$alerta_troca_bronzina',
            pneu1 = '$pneu1',
            pneu2 = '$pneu2',
            pneu3 = '$pneu3',
            pneu4 = '$pneu4',
            pneu5 = '$pneu5',
            pneu6 = '$pneu6',
            pneu7 = '$pneu7',
            pneu8 = '$pneu8',
            pneu9 = '$pneu9',
            pneu10 = '$pneu10',
            pneu11 = '$pneu11',
            pneu12 = '$pneu12',
            pneu13 = '$pneu13',
            pneu14 = '$pneu14',
            pneu15 = '$pneu15',
            pneu16 = '$pneu16',
            pneu17 = '$pneu17',
            pneu18 = '$pneu18',
            pneu19 = '$pneu19',
            pneu20 = '$pneu20',
            pneu21 = '$pneu21',
            pneu22 = '$pneu22'
            WHERE idv = '$id' ";
            
            $q2 = "UPDATE contas_receber SET situacao_viagem = 'Iniciada', km_inicial = '$kilometragem', viagem_inicio = CURRENT_TIMESTAMP WHERE id_veiculo = '$id' ";
                            
            try {
                if ($banco->query($q) && $banco->query($q2)) {
                    echo msg_sucesso("Viagem iniciada com sucesso!");

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
                echo "<p>Não foi possível iniciar a viagem. Tente novamente!.</p>";
                echo $e->getMessage();
            }
          
        ?>
    </div>
</body>