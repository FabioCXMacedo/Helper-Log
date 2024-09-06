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

    <title>Helper Log - Motoristas</title>

</head>
<body>
    <div class="content col-12 titulo-listagem">
        <p>Motoristas</p>
    </div>


    <?php
        if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
        }
        else {
            echo "
                <div class='row content col-12'>
                    
                <div class='menu-item-sub col-1'>
                    <a href='motorista_new_form.php'>
                        <div class='menu-icon-sub'>
                            <i class='bi bi-person-add'></i>
                        </div>
                        <div class='menu-title-sub'>
                            <p>Novo Motorista</p>
                        </div>
                    </a>
                </div>
                   
                    <div class='container col-12 listagem'>
                        <table class='listagem'>
            ";

            include "../pages/topo_sys.php";

            $q = "SELECT m.idm, m.cpf, m.nome, m.telefone1, m.telefone2, m.hab_categoria, m.hab_vencimento, m.observacao, d.id_motorista, d.id_veiculo, v.idv, v.placa1 
            FROM motoristas m 
            LEFT JOIN dirigir d ON m.idm = d.id_motorista
            LEFT JOIN veiculos v ON v.idv = d.id_veiculo
            ORDER BY m.nome";
            
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
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>Telefone 1</th>
                            <th>Telefone 2</th>
                            <th>Habilitação</th>
                            <th>Hab. vencto.</th>
                            <th>ID Veículo</th>
                            <th>Veículo</th>
                            <th class='opcoes'>Alterar</th>
                            <th class='opcoes'>Vincular</th>
                            <th class='opcoes'>Desvincular</th>
                        </tr>
                    ";
                    while ($reg = $busca->fetch_object()) {
                        $id = $reg->idm;
                        echo "<tr><td>$reg->idm";
                        echo "<td>$reg->cpf";
                        echo "<td>$reg->nome";              
                        echo "<td>$reg->telefone1";
                        echo "<td>$reg->telefone2";
                        echo "<td>$reg->hab_categoria";
                        $dataFormatada = new DateTime($reg->hab_vencimento);
                        $hab_vencimento = $dataFormatada->format('d-m-Y');
                        echo "<td>$hab_vencimento";
                        echo "<td>$reg->id_veiculo";
                        echo "<td>$reg->placa1";                
                        echo "<td class='bt-opcoes-y'><a href='motorista_edit_form.php?id=$id'><i class='bi bi-pencil'></i></a>";
                        echo "<td class='bt-opcoes-y'><a href='motorista_vincular.php?id=$id'><i class='bi bi-truck'></i></a>";
                        echo "<td class='bt-opcoes-y'><a href='motorista_desvincular.php?id=$id'><i class='bi bi-person-x-fill'></i></a>";               
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