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
            
            if (!is_logado()) {
                echo msg_erro("Faça login para acessar o sistema!");
                echo voltar();
            }
            else {
                include "topo_sys_op.php";

                $user = $_SESSION['id'];

                echo "
                    <div class='content col-12 titulo-listagem'>
                        <p>Viagens</p>
                    </div>

                    <div class='container col-12 listagem'>
                        <table class='listagem'> 
                ";
                
                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

                        $q = "SELECT c.id, c.data_viagem, c.descricao, c.distancia, c.tipo, c.id_veiculo, c.id_motorista, c.cliente, c.fornecedor, c.valor, c.custo, c.situacao_viagem, m.idm, m.nome, v.idv, v.placa1, v.placa2, u.id_usuario 
                        FROM contas_receber c 
                        LEFT JOIN veiculos v ON v.idv = c.id_veiculo
                        LEFT JOIN motoristas m ON m.idm = c.id_motorista
                        LEFT JOIN usuarios u ON u.id_usuario = c.id_motorista
                        WHERE c.id_motorista = '$user' 
                        AND situacao_viagem = 'Programada' OR situacao_viagem = 'Iniciada'";

                        
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

                                    echo "
                                        <tr><th class = 'title'>ID Viagem</th>
                                    ";
                                    $id = $reg->id;
                                    echo "
                                        <tr><td class = 'dados'>$id
                                    ";
                                    
                                    echo "
                                        <th class = 'title'>Data</th>
                                    ";
                                    $dataFormatada = new DateTime($reg->data_viagem);
                                    $data_viagem = $dataFormatada->format('d-m-Y');
                                    echo "
                                        <tr><td class = 'dados'>$data_viagem
                                    ";

                                    echo "
                                        <tr><th class = 'title'>Itinerário</th>
                                        <tr><td class = 'dados'>$reg->descricao
                                    ";

                                    echo "
                                        <tr><th class = 'title'>Distância</th>
                                        <tr><td class = 'dados'>$reg->distancia
                                    ";
                                            
                                    echo "
                                        <tr><th class = 'title'>Cliente</th>
                                        <tr><td class = 'dados'>$reg->cliente
                                    ";

                                    echo "
                                        <tr><th class = 'title'>Situação</th>
                                        <tr><td class = 'dados'>$reg->situacao_viagem
                                    ";        
                                    
                                    if ($reg->situacao_viagem == 'Programada') {
                                        echo "
                                            <tr>
                                            <td class = 'button'>
                                            <a href='checklist_op.php?id=$id'>
                                            <input type='button' value='Iniciar Viagem'>
                                            </a>
                                        ";
                                    }
                                    elseif ($reg->situacao_viagem == 'Iniciada') {
                                        echo "
                                            <tr>
                                            <td class = 'button'>
                                            <a href='viagem_finalizar_form.php?id=$id'>
                                            <input type='button' value='Finalizar Viagem'>
                                            </a>
                                        ";
                                    }
                                    echo "<tr><td>";
                                }
                            }
                        }
                echo "        
                                
                        </table>
                    </div>
                ";

            }
        ?>

        <?php 
            include "footer_sys.php";
        ?>

            

    
</body>
</html>