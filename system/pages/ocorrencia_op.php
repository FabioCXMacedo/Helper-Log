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

    <title>Helper Log - Ocorrências</title>

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
                <div class='content col-12 menu-sub'>
                    <div class='menu-item-sub col-12'>
                        <a href='ocorrencia_op_form.php'>
                            <div class='menu-icon-sub'>
                                <i class='bi bi-suitcase-lg-fill'></i>
                            </div>
                            <div class='menu-title-sub'>
                                <p>Nova Ocorrência</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class='container col-12 listagem'>
                    <table class='listagem'>
            
            ";
    

            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

            $q = "SELECT o.id, o.data_criacao, o.tipo, o.descricao, o.valor, o.anexo, o.id_viagem, o.id_veiculo, o.id_motorista, o.id_user, o.observacao, o.situacao, v.idv, v.placa1, v.placa2, m.idm, m.nome 
            FROM ocorrencias o 
            LEFT JOIN veiculos v ON v.idv = o.id_veiculo
            LEFT JOIN motoristas m ON m.idm = o.id_motorista 
            WHERE o.id_user = '$user' and o.situacao = 'Conferir'";
    
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
                            <th class = 'title'>Data</th>
                        ";
                        $dataFormatada = new DateTime($reg->data_criacao);
                        $data_criacao = $dataFormatada->format('d-m-Y');
                        echo "
                            <tr><td class = 'dados'>$data_criacao
                        ";

                        echo "
                            <tr><th class = 'title'>Tipo</th>
                            <tr><td class = 'dados'>$reg->tipo
                        ";

                        echo "
                            <tr><th class = 'title'>Descrição</th>
                            <tr><td class = 'dados'>$reg->descricao
                        ";
                                
                        echo "
                            <tr><th class = 'title'>Valor</th>
                            <tr><td class = 'dados'>$reg->valor
                        ";

                        echo "
                            <tr><th class = 'title'>ID Viagem</th>
                            <tr><td class = 'dados'>$reg->id_viagem
                        ";
                        
                        echo "
                            <tr><th class = 'title'>Veículo</th>
                            <tr><td class = 'dados'>$reg->placa1
                        "; 

                        echo "
                            <tr><th class = 'title'>Situação</th>
                            <tr><td class = 'dados'>$reg->situacao
                        ";
                        
                        echo "
                            <tr>
                            <td class = 'botao-title'>
                            <a href='$reg->anexo'>
                            Visualisar a Foto em anexo
                            </a>
                        ";

                        echo "
                            <tr>
                            <td class = 'botao-title'>
                            <a href='ocorrencia_op_edit_form.php?id=$reg->id'>
                            Alterar ocorrência
                            </a>
                        ";

                    }
                }
            }
            echo "        
                        
                </table>
            </div>
            ";

        }
        include "footer_sys.php";
    ?>
   
</body>
</html>