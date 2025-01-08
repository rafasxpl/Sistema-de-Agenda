<?php
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/eventos/ControllerEventos.php";
    date_default_timezone_set('America/Sao_Paulo');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dataInicioEvento           = date_create($_POST['dataLembreteEvento'] ?? null);
        $dataInicioEventoFormatada  = date_format($dataInicioEvento, 'Y-m-d');
        $dataFimEvento              = date_create($_POST['dataFimEvento'] ?? null);
        $dataFimEventoFormatada     = date_format($dataFimEvento, 'Y-m-d');

        ControllerEventos::criarEvento([
            "tituloEvento"        => $_POST['tituloEvento']        ?? '',
            "descricaoEvento"     => $_POST['descricaoEvento']     ?? '',
            "dataInicioEvento"    => $dataInicioEventoFormatada    ?? '',
            "horaInicioEvento"    => $_POST['horaInicioEvento']  ?? '',
            "dataFimEvento"       => $dataFimEventoFormatada       ?? '',
            "horaFimEvento"       => $_POST['horaFimEvento'] ?? '',
            "statusEvento"        => 0
        ]);
    }
?>
<section class="w-100 d-flex flex-column align-items-center">
    <header class="w-75 my-3 d-flex align-items-center gap-3">
        <span class="fs-2">
            <i class="fa-solid fa-plus"></i>
        </span>
        <h1 class="align-self-center fs-2 my-0 text-white">Adicionar Eventos</h1>
    </header>
    <form class="w-100 d-flex flex-column align-items-center gap-3" action="" method="POST">
        <div class="d-flex flex-column justify-content-center align-items-center gap-5 w-100">
            <div class="w-75">
                <div>
                    <label for="tituloEvento" class="d-block form-label">Título</label>
                    <input class="form-control" type="text" name="tituloEvento" id="tituloEvento" placeholder="Seu título">
                </div>
                <div>
                    <label for="descricaoEvento" class="d-block form-label mt-2">Descrição</label>
                    <textarea class="form-control" rows="4" name="descricaoEvento" id="descricaoEvento"></textarea>
                </div>
            </div>
            <div class="w-75">
                <div>
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataInicioEvento" class="d-block form-label mt-2" for="">Data de Início</label>
                            <input class="form-control" type="date" name="dataInicioEvento" id="dataInicioEvento">
                        </div>
                        <div class="w-50">
                            <label for="horaInicioEvento" class="d-block form-label mt-2">Hora de Início</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="horaInicioEvento" id="horaInicioEvento" value="<?= date("H:i:s") ?>">
                            </div>
                        </div>
                    </div>  
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataFimEvento" class="d-block form-label mt-2">Data de Término</label>
                            <input class="form-control" type="date" name="dataFimEvento" id="dataFimEvento">
                        </div>
                        <div class="w-50">
                            <label for="horaFimEvento" class="d-block form-label mt-2">Hora do Término</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="horaFimEvento" id="horaFimEvento" value="<?= date("H:i:s") ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-75 mx-auto d-flex justify-content-center">
            <button class="btn btn-success w-100" type="submit">Adicionar</button>
        </div>
    </form>
</section>