<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerTarefas.php";
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/config.php";

    $idTarefa = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $informacaoTarefa = ControllerTarefas::resgatarDadosTarefas($idTarefa, false)[0];

   
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
                    <input class="form-control" type="text" name="atualizarTituloTarefa" id="tituloTarefa" placelholder="Seu título" value="<?= $informacaoTarefa['tituloTarefa'] ?>">
                </div>
                <div>
                    <label for="descricaoTarefa" class="d-block form-label mt-2">Descrição</label>
                    <textarea class="form-control" rows="5" name="atualizarDescricaoTarefa" id="descricaoTarefa">
                        <?= $informacaoTarefa['descricaoTarefa'] ?>
                    </textarea>
                </div>
            </div>
            <div class="w-50">
                <div>
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataConclusao" class="d-block form-label mt-2" for="">Data de Conclusão</label>
                            <input class="form-control" type="date" name="atualizarDataConclusaoTarefa" id="dataConclusao" value="<?= $informacaoTarefa['dataConclusaoTarefa'] ?>">
                        </div>
                        <div class="w-50">
                            <label for="horaConclusaoTarefa" class="d-block form-label mt-2" for="">Hora de Conclusão</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="atualizarHoraConclusaoTarefa" id="horaConclusaoTarefa" value="<?= $informacaoTarefa['horaConclusaoTarefa'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataConclusao" class="d-block form-label mt-2">Data de Lembrete</label>
                            <input class="form-control" type="date" name="atualizarDataLembreteTarefa" id="dataConclusao" value="<?= $informacaoTarefa['dataConclusaoTarefa'] ?>">
                        </div>
                        <div class="w-50">
                            <label for="horaConclusaoTarefa" class="d-block form-label mt-2">Hora do Lembrete</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="atualizarHoraLembreteTarefa" id="horaConclusaoTarefa" value="<?= $informacaoTarefa['horaConclusaoTarefa'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="recorrenciaTarefa" class="d-block form-label mt-2" for="">Recorrência</label>
                    <select class="form-select" name="atualizarRecorrenciaTarefa" id="recorrenciaTarefa">
                        <option value="0" <?= $informacaoTarefa['recorrenciaTarefa'] === 0 ? 'selected' : null ?>>Não recorrente</option>
                        <option value="1" <?= $informacaoTarefa['recorrenciaTarefa'] === 1 ? 'selected' : null ?>>Diariamente</option>
                        <option value="2" <?= $informacaoTarefa['recorrenciaTarefa'] === 2 ? 'selected' : null ?>>Semanalmente</option>
                        <option value="3" <?= $informacaoTarefa['recorrenciaTarefa'] === 3 ? 'selected' : null ?>>Mensalmente</option>
                        <option value="4" <?= $informacaoTarefa['recorrenciaTarefa'] === 4 ? 'selected' : null ?>>Anualmente</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="w-100 mx-auto d-flex justify-content-center">
            <button class="btn btn-success w-100" type="submit">Adicionar</button>
        </div>
    </form>
    <?php 
        var_dump($informacaoTarefa)
    ?>
</section>