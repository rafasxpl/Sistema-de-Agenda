<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerEventos.php";
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/config.php";

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $informacoesEvento = ControllerEventos::resgatarDadosEventos($id, false)[0];

    function updateInformacoesEvento($dados, $id) {
        ControllerEventos::atualizarInformacoesEvento([
                "tituloEvento"    =>  $dados['atualizarTitulo']        ?? null,
                "descricaoEvento" =>  $dados['atualizarDescricao']     ?? null,
                "dataFimEvento"   =>  $dados['atualizarDataConclusao'] ?? null,
                "horaFimEvento"   =>  $dados['atualizarHoraConclusao'] ?? null
            ],
            $id
        );  
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['atualizarTitulo']) || isset($_POST['atualizarDescricao']) || isset($_POST['atualizarDataConclusao']) || isset($_POST['atualizarHoraConclusao']) || isset($_POST['atualizarStatus'])) {
            updateInformacoesEvento($_POST, $id);
        }
    }
?>
<section class="w-100 d-flex flex-column align-items-center">
    <header class="w-75 my-3 d-flex align-items-center gap-3">
        <span class="fs-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </span>
        <h1 class="align-self-center fs-2 my-0 text-white">Editar Evento</h1>
    </header>
    <form class="w-75 d-flex flex-column align-items-center gap-5" action="" method="POST">
        <div class="d-flex justify-content-center align-items-center gap-5 w-100">
            <div class="w-50">
                <div>
                    <label for="tituloEvento" class="d-block form-label">Título</label>
                    <input class="form-control" type="text" name="atualizarTitulo" id="tituloEvento" placeholder="Seu título" value="<?= htmlspecialchars($informacoesEvento['tituloEvento']) ?>">
                </div>
                <div>
                    <label for="descricaoEvento" class="d-block form-label mt-2">Descrição</label>
                    <textarea class="form-control" rows="2" name="atualizarDescricao" id="descricaoEvento"><?= htmlspecialchars($informacoesEvento['descricaoEvento']) ?></textarea>
                </div>
            </div>
            <div class="w-50">
                <div>
                    <div class="d-flex flex-column gap-3">
                        <div class="w-100">
                            <label for="dataConclusao" class="d-block form-label mt-2">Data de Conclusão</label>
                            <input class="form-control" type="date" name="atualizarDataConclusao" id="dataConclusao" value="<?= htmlspecialchars($informacoesEvento['dataFimEvento']) ?>">
                        </div>
                        <div class="w-100">
                            <label for="horaConclusaoEvento" class="d-block form-label mt-2">Hora de Conclusão</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <input class="form-control" type="time" name="atualizarHoraConclusao" id="horaConclusaoEvento" value="<?= htmlspecialchars($informacoesEvento['horaFimEvento']) ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 mx-auto d-flex justify-content-center">
            <button class="btn btn-success w-100" type="submit">Atualizar</button>
        </div>
    </form>
</section>