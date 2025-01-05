<?php 
    require_once "/opt/lampp/htdocs/Sistema-de-Agenda/MVC/controllers/ControllerTarefas.php";
    
    $dadosTarefas = ControllerTarefas::resgatarDadosTarefas(null);

    if(isset($_POST['checked']) ?? "" && isset($_POST['id'])) {
        $status = $_POST['checked'];
        $idCheckBox = $_POST['id'];
        ControllerTarefas::concluirTarefa($status ,$idCheckBox);
    }
?>
<section class="containerTarefas w-75 h-100 d-flex flex-column align-items-center mx-auto">
    <form class="w-100 my-3 d-flex justify-content-center column-gap-3" action="index.php?page=buscarTarefas" method="POST" class="formBuscaTarefas">
        <input class="w-75 form-control p-1" type="text" placeholder="Buscar Tarefa" name="chaveBusca">
        <button class="w-auto btn btn-primary px-3 py-2" id="buscarTarefa" type="submit">Buscar</button>
        <button class="adicionarTarefasButton btn btn-success   ">
            <a class="text-decoration-none text-white" href="index.php?page=adicionarTarefas">Adicionar Tarefa</a>
        </button>
    </form>
    <div class="exibirTarefas w-100">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr class="table-row">
                    <th class="table-cell align-middle text-center">Status</th>
                    <th class="table-cell align-middle text-center">Tarefa</th>
                    <th class="table-cell align-middle text-center">Descrição</th>
                    <th class="table-cell align-middle text-center">Data de conclusão</th>
                    <th class="table-cell align-middle text-center">Hora de conclusão</th>
                    <th class="table-cell align-middle text-center" colspan="2">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dadosTarefas as $content):?>
                    <tr class="table-row">
                        <th class="table-cell align-middle text-center">
                            <input id="<?= $content['idTarefa'] ?>" class="checkBoxTarefa form-check-input" type="checkbox" name="status" <?= $content['statusTarefa'] === 0 ? '' : 'checked' ?>>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['tituloTarefa'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['descricaoTarefa'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['dataConclusaoTarefa'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <?= $content['horaConclusaoTarefa'] ?>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <a class="btn btn-primary" href="index.php?page=editarTarefa&id=<?= $content['idTarefa']?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </th>
                        <th class="table-cell align-middle text-center">
                            <button class="excluirTarefasButton btn btn-danger" data-id="<?= $content['idTarefa'] ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="paginasContatos d-flex justify-content-around align-items-center gap-4 bg-light-subtle p-3 w-75">
    <?php 
        $quantidadeRegistroTarefas  = ControllerTarefas::resgatarQuantidadeTarefas();
        $intervaloPaginas           = ControllerTarefas::getLimiteTarefasPagina();
        $paginaAtual                = ControllerTarefas::getPaginaAtual();
        $quantidadePaginas          = ControllerTarefas::getQuantidadePaginas();

        $blocoAtual = ceil($paginaAtual / $intervaloPaginas); 
        $paginaInicio = (($blocoAtual - 1) * $intervaloPaginas) + 1; 
        $paginaFim = min($paginaInicio + $intervaloPaginas - 1, $quantidadePaginas); 

        if ($blocoAtual > 1): 
            $paginaAnterior = $paginaInicio - 1;
        ?>
            <a class="paginaTarefa text-decoration-none text-primary fs-6" href="index.php?page=tarefas&idPaginaTarefa=1">« Primeira Página</a>
            <a class="paginaTarefa text-decoration-none text-primary fs-6" href="index.php?page=tarefas&idPaginaTarefa=<?= $paginaAnterior ?>">« Anterior</a>
        <?php endif; ?>

        <?php for ($i = $paginaInicio; $i <= $paginaFim; $i++): ?>
            <a class="paginaTarefa text-decoration-none text-primary <?= $i == $paginaAtual ? 'paginaAtiva' : '' ?>" 
            href="index.php?page=tarefas&idPaginaTarefa=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($paginaFim < $quantidadePaginas): 
            $paginaProxima = $paginaFim + 1;
        ?>
            <a class="paginaTarefa text-decoration-none text-primary" href="index.php?page=tarefas&idPaginaTarefa=<?= $paginaProxima ?>">Próximo »</a>
            <a class="paginaTarefa text-decoration-none text-primary" href="index.php?page=tarefas&idPaginaTarefa=<?= $quantidadePaginas ?>">UltimaPagina »</a>
        <?php endif; ?>
</div>  
</section>
