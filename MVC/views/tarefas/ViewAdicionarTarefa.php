<?php
    require_once __DIR__ . "../../../controllers/tarefas/ControllerTarefas.php";
    date_default_timezone_set('America/Sao_Paulo');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dataConclusaoTarefa = date_create($_POST['dataConclusaoTarefa'] ?? null);
        $dataConclusaoTarefaFormatada  = date_format($dataConclusaoTarefa, 'Y-m-d');

        $dataLembreteTarefa = date_create($_POST['dataLembreteTarefa'] ?? null);
        $dataLembreteTarefaFormatada  = date_format($dataLembreteTarefa, 'Y-m-d');

        $sla = ControllerTarefas::criarTarefa([
            "tituloTarefa"        => htmlspecialchars($_POST['tituloTarefa'])        ?? '',
            "descricaoTarefa"     => htmlspecialchars($_POST['descricaoTarefa'])     ?? '',
            "dataConclusaoTarefa" => $dataConclusaoTarefaFormatada ?? '',
            "horaConclusaoTarefa" => $_POST['horaConclusaoTarefa'] ?? '',
            "dataLembreteTarefa"  => $dataLembreteTarefaFormatada  ?? '',
            "horaLembreteTarefa"  => $_POST['horaLembreteTarefa']  ?? '',
            "recorrenciaTarefa"   => $_POST['recorrenciaTarefa']   ?? '',
            "statusTarefa"        => 0
        ]);
    }
?>
<section class="w-100 d-flex flex-column align-items-center">
    <header class="w-75 my-3 d-flex align-items-center gap-3">
        <span class="fs-2">
            <i class="fa-solid fa-plus"></i>
        </span>
        <h1 class="align-self-center fs-2 my-0 text-white">Adicionar Tarefa</h1>
    </header>
    <form class="w-75 d-flex flex-column align-items-center gap-5" action="" method="POST">
        <div class="d-flex justify-content-center align-items-center gap-5 w-100">
            <div class="w-50">
                <div>
                    <label for="tituloTarefa" class="d-block form-label">Título</label>
                    <input class="form-control" type="text" name="tituloTarefa" id="tituloTarefa" placelholder="Seu título">
                </div>
                <div>
                    <label for="descricaoTarefa" class="d-block form-label mt-2">Descrição</label>
                    <textarea class="form-control" rows="5" name="descricaoTarefa" id="descricaoTarefa"></textarea>
                </div>
            </div>
            <div class="w-50">
                <div>
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataConclusao" class="d-block form-label mt-2" for="">Data de Conclusão</label>
                            <input class="form-control" type="date" name="dataConclusaoTarefa" id="dataConclusao">
                        </div>
                        <div class="w-50">
                            <label for="horaConclusaoTarefa" class="d-block form-label mt-2">Hora de Conclusão</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="horaConclusaoTarefa" id="horaConclusaoTarefa" value="<?= date("H:i:s") ?>">
                            </div>
                        </div>
                    </div>  
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataConclusao" class="d-block form-label mt-2">Data de Lembrete</label>
                            <input class="form-control" type="date" name="dataLembreteTarefa" id="dataConclusao">
                        </div>
                        <div class="w-50">
                            <label for="horaConclusaoTarefa" class="d-block form-label mt-2">Hora do Lembrete</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="horaLembreteTarefa" id="horaConclusaoTarefa" value="<?= date("H:i:s") ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="recorrenciaTarefa" class="d-block form-label mt-2" for="">Recorrência</label>
                    <select class="form-select" name="recorrenciaTarefa" id="recorrenciaTarefa">
                        <option value="0">Não recorrente</option>
                        <option value="1">Diariamente</option>
                        <option value="2">Semanalmente</option>
                        <option value="3">Mensalmente</option>
                        <option value="3">Anualmente</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="w-100 mx-auto d-flex justify-content-center">
            <button class="btn btn-success w-100" type="submit">Adicionar</button>
        </div>
    </form>
</section>