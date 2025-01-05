<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerTarefas.php";
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/config.php";

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $informacoesTarefa = ControllerTarefas::resgatarDadosTarefas($id)[0];

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
<section class="w-100 h-70 d-flex justify-content-center  bg-secondary">
    <form class="d-flex flex-column align-items-center gap-4 w-50 mt-3" action="" method="POST">
        <div class="w-75">
            <label class="form-label" for="atualizarTitulo">Título</label>
            <input class="form-control" type="text" id="atualizarTitulo" name="atualizarTitulo" placeholder="Título da tarefa" value="<?= $informacoesTarefa['tituloTarefa'] ?>">
        </div>
        <div class="w-75">
            <label class="form-label" for="atualizarDescricao">Descrição</label>
            <textarea class="form-control" id="atualizarDescricao" name="atualizarDescricao" placeholder="Descrição da tarefa"><?= $informacoesTarefa['descricaoTarefa'] ?></textarea>
        </div>
        <div class="w-75">
            <label class="form-label" for="atualizarDataConclusao">Data de Conclusão</label>
            <input class="form-control" type="date" id="atualizarDataConclusao" name="atualizarDataConclusao" value="<?= $informacoesTarefa['dataConclusaoTarefa'] ?>">
        </div>
        <div class="w-75">
            <label class="form-label" for="atualizarHoraConclusao">Hora de Conclusão</label>
            <input class="form-control" type="time" id="atualizarHoraConclusao" name="atualizarHoraConclusao" value="<?= $informacoesTarefa['horaConclusaoTarefa'] ?>">
        </div>
        <div class="w-75">
            <label class="form-label" for="atualizarStatus">Status</label>
            <select class="form-control" id="atualizarStatus" name="atualizarStatus">
                <option value="0" <?= $informacoesTarefa['statusTarefa'] === 0 ? 'selected' : '' ?>>Pendente</option>
                <option value="1" <?= $informacoesTarefa['statusTarefa'] === 1 ? 'selected' : '' ?>>Concluída</option>
            </select>
        </div>
        <div class="w-75">
            <input class="btn btn-success w-100" type="submit" name="submit" value="Atualizar">
        </div>
    </form>
</section>
