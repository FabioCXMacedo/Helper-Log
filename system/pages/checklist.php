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
    <title>Helper Log - Checklist</title>

</head>
<body>
    <?php 
        include "topo_sys.php";
    ?>
    <div class="content checklist">
        <h2>Favor preencher o Checklist</h2>
        <form>
            <div class="row mb-4 g-4">
                <div class="col-12 check-form">
                    <label for="veiculo" class="form-label">Veículo</label>
                    <input type="text" class="form-control" id="veiculo">
                </div>
                <div class="col-6 check-form">
                    <label for="placa1" class="form-label">Placa Cavalo</label>
                    <input type="text" class="form-control" id="placa1">
                </div>
                <div class="col-6 check-form">
                    <label for="placa2" class="form-label">Placa Carreta</label>
                    <input type="text" class="form-control" id="placa2">
                </div>
                <div class="col-12 check-form">
                    <label for="itinerario" class="form-label">Itinerário</label>
                    <input type="text" class="form-control" id="itinerario">
                </div>
                <div class="col-6 check-form">
                    <label for="datap" class="form-label">Data da partida</label>
                    <input type="date" class="form-control" id="datap">
                </div>
                <div class="col-6 check-form">
                    <label for="datac" class="form-label">Data da Chegada</label>
                    <input type="date" class="form-control" id="datac">
                </div>
                <div class="col-6 check-form">
                    <label for="kmatual" class="form-label">Kilometragem atual</label>
                    <input type="number" class="form-control" id="kmatual">
                </div>
                <div class="col-6 check-form">
                    <label for="kmfinal" class="form-label">Kilometragem Final</label>
                    <input type="number" class="form-control" id="kmfinal">
                </div>
                <div class="col-4 check-form">
                    <label for="pneu1" class="form-label">Pneu 1</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu2" class="form-label">Pneu 2</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu3" class="form-label">Pneu 3</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu4" class="form-label">Pneu 4</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu5" class="form-label">Pneu 5</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu6" class="form-label">Pneu 6</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu7" class="form-label">Pneu 7</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu8" class="form-label">Pneu 8</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu9" class="form-label">Pneu 9</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu10" class="form-label">Pneu 10</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu11" class="form-label">Pneu 11</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu12" class="form-label">Pneu 12</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu13" class="form-label">Pneu 13</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu14" class="form-label">Pneu 14</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu15" class="form-label">Pneu 15</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu16" class="form-label">Pneu 16</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu17" class="form-label">Pneu 17</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu18" class="form-label">Pneu 18</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu19" class="form-label">Pneu 19</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu20" class="form-label">Pneu 20</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu21" class="form-label">Pneu 21</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>
                <div class="col-4 check-form">
                    <label for="pneu22" class="form-label">Pneu 22</label>
                    <select class="form-select">
                        <option value="">Ótimo</option>
                        <option value="">Bom</option>
                        <option value="">Ruim</option>
                        <option value="">Calibrar</option>
                        <option value="">Trocar</option>
                    </select>
                </div>

            </div>
            <button class="btn btn-outline-primary">Cadastrar</button>
        </form>
    </div>

    <?php 
        include "footer_sys.php";
    ?>
</body>
</html>