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
    <link rel="stylesheet" href="../estilos/administrativo.css">
    <title>Helper Log - Cadastro de veículos</title>

</head>
<body>
    <?php 
        include "topo_sys.php";
    ?>
    <div class='content col-12 titulo-listagem'>
        <p>Cadastro de veículos</p>
    </div>
    <div class="container checklist-adm">
        <form action="veiculo_new.php" method="post">
            <div class="row mb-4 g-4">
                <div class="col-6 check-form">
                    <label for="veiculo" class="form-label">Veículo - Descrição</label>
                    <input type="text" class="form-control" id="veiculo" name="veiculo">
                </div>
                <div class="col-3 check-form">
                    <label for="placa1" class="form-label">Placa Cavalo</label>
                    <input type="text" class="form-control" id="placa1" name="placa1">
                </div>
                <div class="col-3 check-form">
                    <label for="placa2" class="form-label">Placa Carreta</label>
                    <input type="text" class="form-control" id="placa2" name="placa2">
                </div>
                <div class="col-2 check-form">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="number" class="form-control" id="ano" name="ano">
                </div>
                <div class="col-2 check-form">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="number" class="form-control" id="modelo" name="modelo">
                </div>
                <div class="col-4 check-form">
                    <label for="kmatual" class="form-label">Km atual</label>
                    <input type="number" class="form-control" id="kmatual" name="kmatual">
                </div>
                <div class="col-3 check-form">
                    <label for="troca-oleo" class="form-label">Última troca de óleo (Km)</label>
                    <input type="number" class="form-control" id="troca-oleo" name="troca-oleo">
                </div>
                <div class="col-3 check-form">
                    <label for="ptroca-oleo" class="form-label">Próxima troca de óleo (Km)</label>
                    <input type="number" class="form-control" id="ptroca-oleo" name="ptroca-oleo">
                </div>
                <div class="col-3 check-form">
                    <label for="troca-bronzina" class="form-label">Última troca de bronzina (Km)</label>
                    <input type="number" class="form-control" id="troca-bronzina" name="troca-bronzina">
                </div>
                <div class="col-3 check-form">
                    <label for="ptroca-bronzina" class="form-label">Próxima troca de Bronzina (Km)</label>
                    <input type="number" class="form-control" id="ptroca-bronzina" name="ptroca-bronzina">
                </div>
                <div class="col-2 check-form">
                    <label for="pneu1" class="form-label">Pneu 1</label>
                    <select class="form-select" id="pneu1" name="pneu1">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu2" class="form-label">Pneu 2</label>
                    <select class="form-select" id="pneu2" name="pneu2">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu3" class="form-label">Pneu 3</label>
                    <select class="form-select" id="pneu3" name="pneu3">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu4" class="form-label">Pneu 4</label>
                    <select class="form-select" id="pneu4" name="pneu4">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu5" class="form-label">Pneu 5</label>
                    <select class="form-select" id="pneu5" name="pneu5">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu6" class="form-label">Pneu 6</label>
                    <select class="form-select" id="pneu6" name="pneu6">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu7" class="form-label">Pneu 7</label>
                    <select class="form-select" id="pneu7" name="pneu7">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu8" class="form-label">Pneu 8</label>
                    <select class="form-select" id="pneu8" name="pneu8">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu9" class="form-label">Pneu 9</label>
                    <select class="form-select" id="pneu9" name="pneu9">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu10" class="form-label">Pneu 10</label>
                    <select class="form-select" id="pneu10" name="pneu10">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu11" class="form-label">Pneu 11</label>
                    <select class="form-select" id="pneu11" name="pneu11">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu12" class="form-label">Pneu 12</label>
                    <select class="form-select" id="pneu12" name="pneu12">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu13" class="form-label">Pneu 13</label>
                    <select class="form-select" id="pneu13" name="pneu13">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu14" class="form-label">Pneu 14</label>
                    <select class="form-select" id="pneu14" name="pneu14">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu15" class="form-label">Pneu 15</label>
                    <select class="form-select" id="pneu15" name="pneu15">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu16" class="form-label">Pneu 16</label>
                    <select class="form-select" id="pneu16" name="pneu16">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu17" class="form-label">Pneu 17</label>
                    <select class="form-select" id="pneu17" name="pneu17">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu18" class="form-label">Pneu 18</label>
                    <select class="form-select" id="pneu18" name="pneu18">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu19" class="form-label">Pneu 19</label>
                    <select class="form-select" id="pneu19" name="pneu19">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu20" class="form-label">Pneu 20</label>
                    <select class="form-select" id="pneu20" name="pneu20">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu21" class="form-label">Pneu 21</label>
                    <select class="form-select" id="pneu21" name="pneu21">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>
                <div class="col-2 check-form">
                    <label for="pneu22" class="form-label">Pneu 22</label>
                    <select class="form-select" id="pneu22" name="pneu22">
                        <option value="Ótimo">Ótimo</option>
                        <option value="Bom">Bom</option>
                        <option value="Ruim">Ruim</option>
                        <option value="Calibrar">Calibrar</option>
                        <option value="Trocar">Trocar</option>
                    </select>
                </div>

            </div>
            <input type="submit" value="Cadastrar" class="btn btn-outline-primary">
            
        </form>
    </div>
</body>