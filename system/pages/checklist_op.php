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

    <link rel="stylesheet" href="../estilos/style_sys.css">
    <link rel="stylesheet" href="../estilos/checklist.css">
    <link rel="stylesheet" href="../estilos/operacional.css">
    <title>Helper Log - Checklist</title>

</head>
<body>
    <?php 
        include "topo_sys_op.php";


        if (isset($_GET['id'])) {
                $id = $_GET['id'];
                
                $q = "SELECT v.idv, v.descricao, v.placa1, v.placa2, v.ano_fab, v.modelo, v.kilometragem, v.troca_oleo, v.p_troca_oleo, v.troca_bronzina, v.p_troca_bronzina, v.pneu1, v.pneu2, v.pneu3, v.pneu4, v.pneu5, v.pneu6, v.pneu7, v.pneu8, v.pneu9, v.pneu10, v.pneu11, v.pneu12, v.pneu13, v.pneu14, v.pneu15, v.pneu16, v.pneu17, v.pneu18, v.pneu19, v.pneu20, v.pneu21, v.pneu22, c.id_veiculo, c.id 
                FROM veiculos v
                LEFT JOIN contas_receber c ON c.id_veiculo = v.idv
                WHERE id = '$id' ";

                $busca = $banco->query($q);
                $reg = $busca->fetch_object();
            }
            else {
                echo "Registro não encontrado.";
            }
            echo "
                <div class='content col-12 titulo-listagem'>
                    <p>Favor preencher o Checklist para iniciar a viagem</p>
                </div>

                <div class='container checklist-adm'>
                    
                    <form action='veiculo_edit_op.php?id=$id' method='post'>
                        <div class='row mb-4 g-4 col-12'>
                            <div class='col-3 check-form'>
                                <label for='veiculo' class='form-label'>Veículo</label>
                                <input type='number' class='form-control' id='id' name='id' value='$reg->idv' readonly>
                            </div>
                            <div class='col-9 check-form'>
                                <label for='descricao' class='form-label'>Descricao</label>
                                <input type='text' class='form-control' id='descricao' name='descricao' value='$reg->descricao' readonly>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='placa1' class='form-label'>Placa Cavalo</label>
                                <input type='text' class='form-control' id='placa1' name='placa1' value='$reg->placa1' readonly>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='placa2' class='form-label'>Placa Carreta</label>
                                <input type='text' class='form-control' id='placa2' name='placa2' value='$reg->placa2' readonly>
                            </div>
                            <div class='col-12 check-form'>
                                <label for='kmatual' class='form-label'>Km atual</label>
                                <input type='number' class='form-control' id='kmatual' name='kmatual' value='$reg->kilometragem' required>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu1' class='form-label'>Pneu 1</label>
                                <select class='form-select' id='pneu1' name='pneu1'>
                                    <option value='$reg->pneu1'>$reg->pneu1</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu2' class='form-label'>Pneu 2</label>
                                <select class='form-select' id='pneu2' name='pneu2'>
                                    <option value='$reg->pneu2'>$reg->pneu2</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu3' class='form-label'>Pneu 3</label>
                                <select class='form-select' id='pneu3' name='pneu3'>
                                    <option value='$reg->pneu3'>$reg->pneu3</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu4' class='form-label'>Pneu 4</label>
                                <select class='form-select' id='pneu4' name='pneu4'>
                                    <option value='$reg->pneu4'>$reg->pneu4</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu5' class='form-label'>Pneu 5</label>
                                <select class='form-select' id='pneu5' name='pneu5'>
                                    <option value='$reg->pneu5'>$reg->pneu5</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu6' class='form-label'>Pneu 6</label>
                                <select class='form-select' id='pneu6' name='pneu6'>
                                    <option value='$reg->pneu6'>$reg->pneu6</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu7' class='form-label'>Pneu 7</label>
                                <select class='form-select' id='pneu7' name='pneu7'>
                                    <option value='$reg->pneu7'>$reg->pneu7</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu8' class='form-label'>Pneu 8</label>
                                <select class='form-select' id='pneu8' name='pneu8'>
                                    <option value='$reg->pneu8'>$reg->pneu8</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu9' class='form-label'>Pneu 9</label>
                                <select class='form-select' id='pneu9' name='pneu9'>
                                    <option value='$reg->pneu9'>$reg->pneu9</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu10' class='form-label'>Pneu 10</label>
                                <select class='form-select' id='pneu10' name='pneu10'>
                                    <option value='$reg->pneu10'>$reg->pneu10</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu11' class='form-label'>Pneu 11</label>
                                <select class='form-select' id='pneu11' name='pneu11'>
                                    <option value='$reg->pneu11'>$reg->pneu11</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu12' class='form-label'>Pneu 12</label>
                                <select class='form-select' id='pneu12' name='pneu12'>
                                    <option value='$reg->pneu12'>$reg->pneu12</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu13' class='form-label'>Pneu 13</label>
                                <select class='form-select' id='pneu13' name='pneu13'>
                                    <option value='$reg->pneu13'>$reg->pneu13</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu14' class='form-label'>Pneu 14</label>
                                <select class='form-select' id='pneu14' name='pneu14'>
                                    <option value='$reg->pneu14'>$reg->pneu14</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu15' class='form-label'>Pneu 15</label>
                                <select class='form-select' id='pneu15' name='pneu15'>
                                    <option value='$reg->pneu15'>$reg->pneu15</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu16' class='form-label'>Pneu 16</label>
                                <select class='form-select' id='pneu16' name='pneu16'>
                                    <option value='$reg->pneu16'>$reg->pneu16</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu17' class='form-label'>Pneu 17</label>
                                <select class='form-select' id='pneu17' name='pneu17'>
                                    <option value='$reg->pneu17'>$reg->pneu17</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu18' class='form-label'>Pneu 18</label>
                                <select class='form-select' id='pneu18' name='pneu18'>
                                    <option value='$reg->pneu18'>$reg->pneu18</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu19' class='form-label'>Pneu 19</label>
                                <select class='form-select' id='pneu19' name='pneu19'>
                                    <option value='$reg->pneu19'>$reg->pneu19</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu20' class='form-label'>Pneu 20</label>
                                <select class='form-select' id='pneu20' name='pneu20'>
                                    <option value='$reg->pneu20'>$reg->pneu20</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu21' class='form-label'>Pneu 21</label>
                                <select class='form-select' id='pneu21' name='pneu21'>
                                    <option value='$reg->pneu21'>$reg->pneu21</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>
                            <div class='col-6 check-form'>
                                <label for='pneu22' class='form-label'>Pneu 22</label>
                                <select class='form-select' id='pneu22' name='pneu22'>
                                    <option value='$reg->pneu22'>$reg->pneu22</option>
                                    <option value='Ótimo'>Ótimo</option>
                                    <option value='Bom'>Bom</option>
                                    <option value='Ruim'>Ruim</option>
                                    <option value='Calibrar'>Calibrar</option>
                                    <option value='Trocar'>Trocar</option>
                                </select>
                            </div>

                        </div>
                        <input type='submit' value='Iniciar Viagem' class='btn btn-outline-primary'>
            
                    </form>
                </div>
            ";
        

        include "footer_sys.php";
    ?>
</body>
</html>