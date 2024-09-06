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
    <title>Helper Log - Ocorrências</title>

</head>
<body>
    <div>
        <?php 
            if (!is_logado()) {
            echo msg_erro('Área restrita. Faça login para acessar o sistema!');
            echo voltar();
            }
            else {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $tipo = $_POST['tipo'] ?? null;
                    $descricao = $_POST['descricao'] ?? null;
                    $valor = $_POST['valor'] ?? null;
                    $id_viagem = $_POST['id_viagem'] ?? null;
                    $veiculo = $_POST['veiculo'] ?? null;
                    $motorista = $_POST['motorista'] ?? null;
                    $observacao = $_POST['observacao'] ?? null;
                    $usuario = $_SESSION['id'] ?? null;
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $uploadDir = '../images/anexos/';
                        $uploadFile = $uploadDir . basename($_FILES['imagem']['name']);

                        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
                            $caminhoImagem = '../images/anexos/' . $_FILES['imagem']['name'];

                            // Diretório de destino para salvar a imagem redimensionada
                            $destino = '../images/anexos/redimensionadas/';

                            // Nome do arquivo de origem
                            $nomeArquivo = $_FILES['imagem']['name'];

                            // Caminho completo do arquivo de destino
                            $caminhoDestino = $destino . $nomeArquivo;

                            // Redimensionar a imagem para um tamanho específico (exemplo: 300x300 pixels)
                            $larguraDesejada = 300;
                            $alturaDesejada = 300;

                            list($larguraOriginal, $alturaOriginal, $tipoMime) = getimagesize($caminhoImagem);

                            $ratioOriginal = $larguraOriginal / $alturaOriginal;
                            $ratioDesejado = $larguraDesejada / $alturaDesejada;

                            if ($ratioOriginal > $ratioDesejado) {
                                $novaLargura = $larguraDesejada;
                                $novaAltura = $larguraDesejada / $ratioOriginal;
                            } else {
                                $novaAltura = $alturaDesejada;
                                $novaLargura = $alturaDesejada * $ratioOriginal;
                            }

                            $imagemRedimensionada = imagecreatetruecolor($novaLargura, $novaAltura);

                            // Criar imagem original baseada no tipo MIME
                            switch ($tipoMime) {
                                case IMAGETYPE_JPEG:
                                    $imagemOriginal = imagecreatefromjpeg($caminhoImagem);
                                    break;
                                case IMAGETYPE_PNG:
                                    $imagemOriginal = imagecreatefrompng($caminhoImagem);
                                    break;
                                case IMAGETYPE_GIF:
                                    $imagemOriginal = imagecreatefromgif($caminhoImagem);
                                    break;
                                // Adicione outros formatos suportados conforme necessário
                                default:
                                    die(msg_erro("Formato de imagem não suportado."));
                            }

                            imagecopyresampled($imagemRedimensionada, $imagemOriginal, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraOriginal, $alturaOriginal);

                            // Salvar a imagem redimensionada
                            imagejpeg($imagemRedimensionada, $caminhoDestino); // Substitua 'jpeg' pelo formato desejado

                            // Limpar a memória
                            imagedestroy($imagemOriginal);
                            imagedestroy($imagemRedimensionada);

                            // Excluir o arquivo original
                            unlink($caminhoImagem);

                            echo msg_sucesso("Upload e redimensionamento bem-sucedidos!");
                        } else {
                            echo msg_erro("Erro ao fazer o upload do arquivo.");
                        }
                    } else {
                        echo msg_erro("Por favor, faça o upload de uma imagem.");
                    }
                   

                    if (!empty($caminhoDestino)) {
                        $q = "UPDATE ocorrencias SET tipo = '$tipo', descricao ='$descricao', valor = '$valor', id_viagem = '$id_viagem', id_veiculo = '$veiculo', id_motorista = '$motorista', id_user = '$usuario', observacao = '$observacao', anexo = '$caminhoDestino' WHERE id = '$id'";

                        try {
                            if ($banco->query($q)) {
                                echo msg_sucesso("Ocorrência cadastrada com sucesso!");
                                if (is_admin()) {
                                    echo "
                                        <div class='container'>
                                            <a href='ocorrencias.php'>
                                                <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                                            </a>
                                        </div>
                                    ";
                                }
                                else {
                                    echo "
                                        <div class='container'>
                                            <a href='ocorrencia_op.php'>
                                                <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                                            </a>
                                        </div>
                                    ";
                                }
                            }
                        }
                        catch (Exception $e) {
                            echo msg_erro("<p>Não foi possível cadastrar a ocorrência. Tente novamente!.</p>");
                        }
                    }
                    else {
                        $caminhoDestino = null;

                        $q = "UPDATE ocorrencias SET tipo = '$tipo', descricao ='$descricao', valor = '$valor', id_viagem = '$id_viagem', id_veiculo = '$veiculo', id_motorista = '$motorista', id_user = '$usuario', observacao = '$observacao' WHERE id = '$id'";

                        try {
                            if ($banco->query($q)) {
                                echo msg_sucesso("Ocorrência alterada com sucesso!");
                                echo "
                                    <div class='container'>
                                        <a href='ocorrencias.php'>
                                            <input type='submit' value='Voltar' class='btn btn-outline-primary'>
                                        </a>
                                    </div>
                                ";
                            }
                        }
                        catch (Exception $e) {
                            echo msg_erro("<p>Não foi possível alterar a ocorrência. Tente novamente!." . $e->getMessage() . "</p> .");
                            echo $tipo . " | ";
                            echo $descricao . " | ";
                            echo $valor . " | ";
                            echo $id_viagem . " | ";
                            echo $veiculo . " | ";
                            echo $motorista . " | ";
                            echo $observacao . " | ";
                            echo $usuario . " | ";
                            echo $caminhoDestino . " | ";
                        }
                    }
                                    
                }
            }
          
        ?>
    </div>
</body>