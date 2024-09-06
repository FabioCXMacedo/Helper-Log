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

    <title>Helper Log - Veículos</title>

</head>
<body>
    <div class="content col-12 titulo-listagem">
        <p>Veículos</p>
    </div>


    <?php
        if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
        }
        else {
            echo "
                <div class='row content col-12'>
                    
                <div class='menu-item-sub col-1'>
                    <a href='veiculo_new_form.php'>
                        <div class='menu-icon-sub'>
                            <i class='bi bi-truck'></i>
                        </div>
                        <div class='menu-title-sub'>
                            <p>Novo Veículo</p>
                        </div>
                    </a>
                </div>
                   
                    <div class='container col-12 listagem'>
                        <table class='listagem'>
            ";

            include "../pages/topo_sys.php";

            $q = "SELECT v.idv, v.descricao, v.placa1, v.placa2, v.ano_fab, v.modelo, v.kilometragem, v.alerta_troca_oleo, v.alerta_troca_bronzina, d.id_motorista, d.id_veiculo, m.idm, m.nome 
            FROM veiculos v 
            LEFT JOIN dirigir d ON v.idv = d.id_veiculo
            LEFT JOIN motoristas m ON m.idm = d.id_motorista
            ORDER BY v.descricao ";
     

            $busca = $banco->query("$q");
            
            if (!$busca) {
                echo "<tr><td>Infelizmente a busca deu errado";
            }
            else {
                if ($busca->num_rows == 0) {
                    echo "<tr><td>Nenhum registro encontrado";
                }
                else {
                    echo "
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Placa Cavalo</th>
                            <th>Placa Carreta</th>
                            <th>Ano Fab</th>
                            <th>Modelo</th>
                            <th>ID Motorista</th>
                            <th>Motorista</th>
                            <th>Kilometragem</th>
                            <th>Status Óleo</th>
                            <th>Status Bronzina</th>
                            <th class='opcoes'>Alterar</th>
                        </tr>
                    ";
                    while ($reg = $busca->fetch_object()) {
                        $id = $reg->idv;
                        echo "<tr><td>$reg->idv";
                        echo "<td>$reg->descricao";
                        echo "<td>$reg->placa1";              
                        echo "<td>$reg->placa2";
                        echo "<td>$reg->ano_fab";
                        echo "<td>$reg->modelo";
                        echo "<td>$reg->id_motorista";
                        echo "<td>$reg->nome";
                        echo "<td>" . number_format(($reg->kilometragem), 0, ',', '.') ;
                        
                        $alerta_troca_oleo = $reg->alerta_troca_oleo;
                        if ($alerta_troca_oleo == "Trocar com urgência") {
                            echo "<td class='vencida'>$alerta_troca_oleo";
                        }
                        else {
                            echo "<td>$alerta_troca_oleo";
                        }
                        
                        $alerta_troca_bronzina = $reg->alerta_troca_bronzina;
                        if ($alerta_troca_bronzina == "Trocar com urgência") {
                            echo "<td class='vencida'>$alerta_troca_bronzina";
                        }
                        else {
                            echo "<td>$alerta_troca_bronzina";
                        }
                
                        echo "<td class='bt-opcoes-y'><a href='veiculo_edit_form.php?id=$id'><i class='bi bi-pencil'></i></a>";               
                    }
                    echo "            
                            </table>
                        </div>
                    </div>
                    ";
                }
            }
        }
            
        include "../pages/footer_sys.php";
    ?>


</body>
</html>