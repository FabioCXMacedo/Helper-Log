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
        <p>Vincular veículos</p>
    </div>


    <?php
        if (!is_admin()) {
            echo msg_erro('Área restrita. Você não é administrador!');
        }
        elseif (isset($_GET['id'])) {
            $id = $_GET['id'];

            include "../pages/topo_sys.php";

            $q = "SELECT m.idm, m.cpf, m.nome, d.id_motorista, d.id_veiculo, v.idv, v.placa1 
            FROM motoristas m 
            LEFT JOIN dirigir d ON m.idm = d.id_motorista
            LEFT JOIN veiculos v ON v.idv = d.id_veiculo
            WHERE idm = '$id'
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
                    while ($reg = $busca->fetch_object()) {
                        echo "
                        <div class='row col-12'>
                            <form action='motorista_vincular_vincular.php' method='post'>
                                <div class='container col-1 pergunta-veiculo'>
                                    <label for='id' class='form-label'>ID</label>
                                    <input type='text' class='form-control' id='id' name='id' value='$reg->idm' readonly>
                                </div>
                                <div class='container col-5 pergunta-veiculo'>
                                    <label for='id' class='form-label'>Motorista</label>
                                    <input type='text' class='form-control' id='nome' name='nome' value='$reg->nome' readonly>
                                </div>
                                <div class='container col-4 resposta-veiculo'>
                                    <label for='id2' class='form-label'>Digite o ID do veículo para vincular</label>
                                    <input type='text' class='form-control' id='id2' name='id2' required>
                                </div>
                                
                                    <input type='submit' value='Vincular' class='btn btn-outline-primary botao-veiculo'>
                                 
                            </form>
                        </div>

                        ";
            
                    }

                }
            }

            $sv = "SELECT v.idv, v.descricao, v.placa1, v.placa2, d.id_motorista, d.id_veiculo, m.nome, m.idm 
            FROM veiculos v
            LEFT JOIN dirigir d ON v.idv = d.id_veiculo
            LEFT JOIN motoristas m ON m.idm = d.id_motorista
            ORDER BY v.descricao ";

            $busca = $banco->query("$sv");

            if (!$busca) {
                echo "<tr><td>Infelizmente a busca deu errado";
            }
            else {
                if ($busca->num_rows == 0) {
                    echo "<tr><td>Nenhum registro encontrado";
                }
                else {
                    echo "
                    <div class='container col-12 listagem'>
                        <table class='listagem'>
                    ";
                    echo "
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Placa Cavalo</th>
                            <th>Placa Carreta</th>
                            <th>ID Motorista</th>
                            <th>Motorista Atual</th>
                        </tr>
                    ";
                    while ($reg = $busca->fetch_object()) {

                        echo "<tr><td>$reg->idv";
                        echo "<td>$reg->descricao";
                        echo "<td>$reg->placa1";              
                        echo "<td>$reg->placa2";
                        echo "<td>$reg->id_motorista";
                        echo "<td>$reg->nome";
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