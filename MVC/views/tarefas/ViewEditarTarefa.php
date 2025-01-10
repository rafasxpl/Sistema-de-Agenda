<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/tarefas/ControllerTarefas.php";

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $informacoesTarefa = ControllerTarefas::resgatarDadosTarefas($id, false)[0];

    function updateInformacoesTarefa($dados, $id) {
        ControllerTarefas::atualizarInformacoesTarefa([
                "tituloTarefa"          =>  $dados['atualizarTitulo']        ?? null,
                "descricaoTarefa"       =>  $dados['atualizarDescricao']     ?? null,
                "dataConclusaoTarefa"   =>  $dados['atualizarDataConclusao'] ?? null,
                "horaConclusaoTarefa"   =>  $dados['atualizarHoraConclusao'] ?? null,
                "statusTarefa"          =>  $dados['atualizarStatus']        ?? null,
            ],
            $id
        );  
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['atualizarTitulo']) || isset($_POST['atualizarDescricao']) || isset($_POST['atualizarDataConclusao']) || isset($_POST['atualizarHoraConclusao']) || isset($_POST['atualizarStatus'])) {
            updateInformacoesTarefa($_POST, $id);
        }
    }
?>
<section class="w-100 d-flex flex-column align-items-center">
    <header class="w-75 my-3 d-flex align-items-center gap-3">
        <span class="fs-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </span>
        <h1 class="align-self-center fs-2 my-0 text-white">Editar Tarefa</h1>
    </header>
    <form class="w-75 d-flex flex-column align-items-center gap-5" action="" method="POST">
        <div class="d-flex justify-content-center align-items-center gap-5 w-100">
            <div class="w-50">
                <div>
                    <label for="tituloTarefa" class="d-block form-label">Título</label>
                    <input class="form-control" type="text" name="atualizarTitulo" id="tituloTarefa" placeholder="Seu título" value="<?= htmlspecialchars($informacoesTarefa['tituloTarefa']) ?>">
                </div>
                <div>
                    <label for="descricaoTarefa" class="d-block form-label mt-2">Descrição</label>
                    <textarea class="form-control" rows="5" name="atualizarDescricao" id="descricaoTarefa"><?= htmlspecialchars($informacoesTarefa['descricaoTarefa']) ?></textarea>
                </div>
            </div>
            <div class="w-50">
                <div>
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataConclusao" class="d-block form-label mt-2">Data de Conclusão</label>
                            <input class="form-control" type="date" name="atualizarDataConclusao" id="dataConclusao" value="<?= htmlspecialchars($informacoesTarefa['dataConclusaoTarefa']) ?>">
                        </div>
                        <div class="w-50">
                            <label for="horaConclusaoTarefa" class="d-block form-label mt-2">Hora de Conclusão</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="atualizarHoraConclusao" id="horaConclusaoTarefa" value="<?= htmlspecialchars($informacoesTarefa['horaConclusaoTarefa']) ?>">
                            </div>
                        </div>
                    </div>  
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataLembrete" class="d-block form-label mt-2">Data de Lembrete</label>
                            <input class="form-control" type="date" name="atualizarDataLembrete" id="dataLembrete" value="<?= htmlspecialchars($informacoesTarefa['dataLembreteTarefa']) ?>">
                        </div>
                        <div class="w-50">
                            <label for="horaLembreteTarefa" class="d-block form-label mt-2">Hora do Lembrete</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="atualizarHoraLembrete" id="horaLembreteTarefa" value="<?= htmlspecialchars($informacoesTarefa['horaLembreteTarefa']) ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="recorrenciaTarefa" class="d-block form-label mt-2">Recorrência</label>
                    <select class="form-select" name="atualizarRecorrencia" id="recorrenciaTarefa">
                        <option value="0" <?= $informacoesTarefa['recorrenciaTarefa'] == 0 ? 'selected' : null ?>>Não recorrente</option>
                        <option value="1" <?= $informacoesTarefa['recorrenciaTarefa'] == 1 ? 'selected' : null ?>>Diariamente</option>
                        <option value="2" <?= $informacoesTarefa['recorrenciaTarefa'] == 2 ? 'selected' : null ?>>Semanalmente</option>
                        <option value="3" <?= $informacoesTarefa['recorrenciaTarefa'] == 3 ? 'selected' : null ?>>Mensalmente</option>
                        <option value="4" <?= $informacoesTarefa['recorrenciaTarefa'] == 4 ? 'selected' : null ?>>Anualmente</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="w-100 mx-auto d-flex justify-content-center">
            <button class="btn btn-success w-100" type="submit">Atualizar</button>
        </div>
    </form>
</section>